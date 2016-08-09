<?php
/**
 * Theme Update Checker Library 1.2
 * http://w-shadow.com/
 * 
 * Copyright 2012 Janis Elsts
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 */

if ( !class_exists('ThemeUpdateChecker') ):
	
/**
 * A custom theme update checker. 
 * 
 * @author Janis Elsts
 * @copyright 2012
 * @version 1.2
 * @access public
 */
class ThemeUpdateChecker {
	public $theme = '';              //The theme associated with this update checker instance.
	public $metadataUrl = '';        //The URL of the theme's metadata file.
	public $enableAutomaticChecking = true; //Enable/disable automatic update checks.
	
	protected $optionName = '';      //Where to store update info.
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'tuc_request_update_';
	                                 
	/**
	 * Class constructor.
	 *
	 * @param string $theme Theme slug, e.g. "twentyten".
	 * @param string $metadataUrl The URL of the theme metadata file.
	 * @param boolean $enableAutomaticChecking Enable/disable automatic update checking. If set to FALSE, you'll need to explicitly call checkForUpdates() to, err, check for updates.
	 */
	public function __construct($theme, $metadataUrl, $enableAutomaticChecking = true){
		$this->metadataUrl = $metadataUrl;
		$this->enableAutomaticChecking = $enableAutomaticChecking;
		$this->theme = $theme;
		$this->optionName = 'external_theme_updates-'.$this->theme;
		
		$this->installHooks();
	}
	
	/**
	 * Install the hooks required to run periodic update checks and inject update info 
	 * into WP data structures.
	 * 
	 * @return void
	 */
	public function installHooks(){
		//Check for updates when WordPress does. We can detect when that happens by tracking
		//updates to the "update_themes" transient, which only happen in wp_update_themes().
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}
		
		//Insert our update info into the update list maintained by WP.
		add_filter('site_transient_update_themes', array($this,'injectUpdate')); 
		
		//Delete our update info when WP deletes its own.
		//This usually happens when a theme is installed, removed or upgraded.
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));

		add_filter('upgrader_source_selection', array($this, 'fixDirectoryName'), 10, 3);
	}
	
	/**
	 * Retrieve update info from the configured metadata URL.
	 * 
	 * Returns either an instance of ThemeUpdate, or NULL if there is 
	 * no newer version available or if there's an error.
	 * 
	 * @uses wp_remote_get()
	 * 
	 * @param array $queryArgs Additional query arguments to append to the request. Optional.
	 * @return ThemeUpdate 
	 */
	public function requestUpdate($queryArgs = array()){
		//Query args to append to the URL. Themes can add their own by using a filter callback (see addQueryArgFilter()).
		$queryArgs['installed_version'] = $this->getInstalledVersion(); 
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);
		
		//Various options for the wp_remote_get() call. Themes can filter these, too.
		$options = array(
			'timeout' => 10, //seconds
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);
		
		$url = $this->metadataUrl; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}
		
		//Send the request.
		$result = wp_remote_get($url, $options);
		
		//Try to parse the response
		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = ThemeUpdate::fromJson($body);
			//The update should be newer than the currently installed version.
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}
		
		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}
	
	/**
	 * Get the currently installed version of our theme.
	 * 
	 * @return string Version number.
	 */
	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}

		/** @noinspection PhpDeprecationInspection get_themes() used for compatibility with WP 3.3 and below. */
		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}
	
	/**
	 * Check for theme updates. 
	 * 
	 * @return void
	 */
	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}
		
		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state); //Save before checking in case something goes wrong 
		
		$update = $this->requestUpdate();
		$state->update = ($update instanceof ThemeUpdate) ? $update->toJson() : $update;
		update_option($this->optionName, $state);
	}
	
	/**
	 * Run the automatic update check, but no more than once per page load.
	 * This is a callback for WP hooks. Do not call it directly.  
	 * 
	 * @param mixed $value
	 * @return mixed
	 */
	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}
	
	/**
	 * Insert the latest update (if any) into the update list maintained by WP.
	 * 
	 * @param StdClass $updates Update list.
	 * @return array Modified update list.
	 */
	public function injectUpdate($updates){
		$state = get_option($this->optionName);
		
		//Is there an update to insert?
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$update = $state->update;
			if ( is_string($state->update) ) {
				$update = ThemeUpdate::fromJson($state->update);
			}
			$updates->response[$this->theme] = $update->toWpFormat();
		}
		
		return $updates;
	}

	/**
	 * Rename the update directory to match the existing theme directory.
	 *
	 * When WordPress installs a theme or plugin update, it expects that the ZIP file will contain
	 * exactly one directory, and that the directory name will be the same as the directory where
	 * the theme/plugin is currently installed.
	 *
	 * GitHub and other repositories provide ZIP downloads, but they often use directory names like
	 * "project-branch" or "project-tag-hash". We need to change the name to the actual theme folder.
	 *
	 * @param string $source
	 * @param string $remoteSource
	 * @param WP_Upgrader $upgrader
	 * @return string|WP_Error
	 */
	function fixDirectoryName($source, $remoteSource, $upgrader) {
		global $wp_filesystem; /** @var WP_Filesystem_Base $wp_filesystem */

		//Basic sanity checks.
		if ( !isset($source, $remoteSource, $upgrader, $upgrader->skin, $wp_filesystem) ) {
			return $source;
		}

		//Figure out which theme is being upgraded.
		$themeDirectoryName = null;
		$skin = $upgrader->skin;
		if ( $skin instanceof Theme_Upgrader_Skin ) {
			if ( isset($skin->theme) && is_string($skin->theme) && ($skin->theme !== '') ) {
				$themeDirectoryName = $skin->theme;
			}
		} elseif ( $upgrader->skin instanceof Bulk_Theme_Upgrader_Skin ) {
			if ( isset($skin->theme_info) && ($skin->theme_info instanceof WP_Theme) ) {
				$themeDirectoryName = $skin->theme_info->get_stylesheet();
			}
		}

		//If WordPress is upgrading something other than a theme (e.g. a plugin),
		//or if it's not *our* theme, leave everything as is.
		if ( empty($themeDirectoryName) || ($themeDirectoryName !== $this->theme) ) {
			return $source;
		}

		//Rename the source to match the existing theme directory.
		$correctedSource = trailingslashit($remoteSource) . $themeDirectoryName . '/';
		if ( $source !== $correctedSource ) {
			$upgrader->skin->feedback(sprintf(
				'Renaming %s to %s&#8230;',
				'<span class="code">' . basename($source) . '</span>',
				'<span class="code">' . $themeDirectoryName . '</span>'
			));

			if ( $wp_filesystem->move($source, $correctedSource, true) ) {
				$upgrader->skin->feedback('Theme directory successfully renamed.');
				return $correctedSource;
			} else {
				return new WP_Error(
					'tuc-rename-failed',
					'Unable to rename the update to match the existing theme directory.'
				);
			}

		}

		return $source;
	}
	
	/**
	 * Delete any stored book-keeping data.
	 * 
	 * @return void
	 */
	public function deleteStoredData(){
		delete_option($this->optionName);
	} 
	
	/**
	 * Register a callback for filtering query arguments. 
	 * 
	 * The callback function should take one argument - an associative array of query arguments.
	 * It should return a modified array of query arguments.
	 * 
	 * @param callable $callback
	 * @return void
	 */
	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}
	
	/**
	 * Register a callback for filtering arguments passed to wp_remote_get().
	 * 
	 * The callback function should take one argument - an associative array of arguments -
	 * and return a modified array or arguments. See the WP documentation on wp_remote_get()
	 * for details on what arguments are available and how they work. 
	 * 
	 * @param callable $callback
	 * @return void
	 */
	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}
	
	/**
	 * Register a callback for filtering the theme info retrieved from the external API.
	 * 
	 * The callback function should take two arguments. If a theme update was retrieved 
	 * successfully, the first argument passed will be an instance of  ThemeUpdate. Otherwise, 
	 * it will be NULL. The second argument will be the corresponding return value of 
	 * wp_remote_get (see WP docs for details).
	 *  
	 * The callback function should return a new or modified instance of ThemeUpdate or NULL.
	 * 
	 * @param callable $callback
	 * @return void
	 */
	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}
	
endif;

if ( !class_exists('ThemeUpdate') ):

/**
 * A simple container class for holding information about an available update.
 * 
 * @author Janis Elsts
 * @copyright 2012
 * @version 1.1
 * @access public
 */
class ThemeUpdate {
	public $version;      //Version number.
	public $details_url;  //The URL where the user can learn more about this version. 
	public $download_url; //The download URL for this version of the theme. Optional.
	
	/**
	 * Create a new instance of ThemeUpdate from its JSON-encoded representation.
	 * 
	 * @param string $json Valid JSON string representing a theme information object. 
	 * @return ThemeUpdate New instance of ThemeUpdate, or NULL on error.
	 */
	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}
		
		//Very, very basic validation.
		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}
		
		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
		}
		
		return $update;
	}

	/**
	 * Serialize update information as JSON.
	 *
	 * @return string
	 */
	public function toJson() {
		return json_encode($this);
	}
	
	/**
	 * Transform the update into the format expected by the WordPress core.
	 * 
	 * @return array
	 */
	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);
		
		if ( !empty($this->download_url) ){
			$update['package'] = $this->download_url;
		}
		
		return $update;
	}
}
	
endif;
