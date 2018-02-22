### sr-theme (http://sr-theme.com) 
# Changelog

## 1.2.2 (2018-02-04)
* Bower Updates
	- jQuery 3.3.1
	- what-input 5.0.4


## 1.2.1 (2017-10-25)
* Bower Updates
	- foundation-sites 6.4.3
	- what-input 4.1.6

## 1.2.0 (2017-06-13)
* Small Bugfixes & has_thumbnail() request for loop- files
* Update YahnisElsts PUC 4.1
* Bower Updates
	- fontfaceobserver 2.0.13
	- foundation-sites 6.4.1
	- what-input 4.1.3


## 1.1.11 (2017-05-18)
* Freemius entfernt
* Language updates
* Added Theme Support for Post Formats: ‚aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' with basic styles
* Comments styles updated
* Button font-family as inherit style
* wp_link_pages added & tag styles updated
* Twitter embedded styles

## 1.1.10 (2017-04-06)
* Test: Freemius Theme Analytics
* Language updates
* Bower Updates
	- fontfaceobserver 2.0.9
	- foundation-sites 6.3.1
	- what-input 4.0.6
	- jQuery 3.2.1

## 1.1.9 (2017-02-09)
* Updated Off-Canvas templates for Foundation 6.3
* Compress some .png files
* jQuery 3.1.1

## 1.1.8 (2017-01-20)
* Changed update functionality to YahnisElsts PUC (https://github.com/YahnisElsts/plugin-update-checker)
* Added sr-theme-child.zip into /library

## 1.1.7 (2017-01-17)
* Foundation 6.3 adjustments
    - flex-video -> responsive-embed
    - settings.scss
    - New module 'card'
    - More details: https://github.com/zurb/foundation-sites/releases/tag/v6.3.0
* Library functions moved to child-theme
* Screenshot dimensions updated to 1200x900
* word-wrap: break-word; for headlines, p and .main-content

## 1.1.6 (2017-01-10)
* Bower Updates
	- fontfaceobserver 2.0.7
	- foundation-sites 6.3.0
	- jQuery 2.2.4
	- what-input 4.0.4
* Added browserconfig.xml with tile.png for Windows 8 Metro interface
* Removed custom font files and fontfaceobserver script in favour of a general system font stack (https://css-tricks.com/snippets/css/system-font-stack/)
### BREAKING: Update your child-theme 
    * Enqueue the fontfaceobserver.js into the child theme **functions.php** :
    * wp_enqueue_script( 'fontfaceobserver', get_template_directory_uri() . '/library/vendor/fontfaceobserver/fontfaceobserver.js', array( ), '2.0.7', false );

## 1.1.5 (2016-09-26)
* Removed word-wrap() mixin from headlines an main content -> use in child where needed
* German languages updates

## 1.1.4 (2016-08-09)
* Removed \<div> \#content in all templates
* Added \<section> with .main-content in header.php
* Removed old theme-update-checker

## 1.1.3 (2016-08-09)
* Update checker with folder renaming issue with github zip-files

## 1.1.2 (2016-08-09)
* Json file from theme url -> Better control of download link

## 1.1.1 (2016-08-09)
* Changelog url and json file from github project 

## 1.1.0 (2016-08-09)
* Automatic Updater from GitHub project
* Commit CHANGELOG.md
* Commit README.md
* Initial commit

## 1.0.0 - 1.0.3 (2016-03-24)
* Manual version with small updates
