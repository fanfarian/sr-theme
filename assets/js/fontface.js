/* https://github.com/bramstein/fontfaceobserver
 *
 * Fontobserver for Demo-Fonts specified in /assets/scss/_font.scss
*/

/* ----------------------------------------------------------------------------------------------------- */
/* FontFaceObserver
/* ----------------------------------------------------------------------------------------------------- */

;(function( doc ) {
	
	var docEl = doc.documentElement;
	
	// IE9+
	if( !( 'geolocation' in navigator ) || sessionStorage.fontStageOne && sessionStorage.fontStageTwo ) {
		docEl.className += " fonts-loaded fonts-all-loaded";
//		console.log('Font already loaded');
		return;
	}
	else{

//		console.log('Font loading 1 start');

		var light 			= new FontFaceObserver( "Lato", {	weight: 300, style: 'normal' });				// Light
		var lightItalic 	= new FontFaceObserver( "Lato", {	weight: 300, style: 'italic' });				// Light Italic
		var regular 		= new FontFaceObserver( "Lato", {	weight: 400, style: 'normal' });				// Regular
		var regularItalic 	= new FontFaceObserver( "Lato", {	weight: 400, style: 'italic' });				// Regular Italic
		var medium 			= new FontFaceObserver( "Lato", {	weight: 500, style: 'normal' });				// Medium/Semibold
		var mediumItalic 	= new FontFaceObserver( "Lato", {	weight: 500, style: 'italic' });				// Medium/Semibold Italic
		var bold 			= new FontFaceObserver( "Lato", {	weight: 700, style: 'normal' });				// Bold
		var boldItalic 		= new FontFaceObserver( "Lato", {	weight: 700, style: 'italic' });				// Bold Italic
	
	
		regular.load().then(function () {
			docEl.className += " fonts-loaded";
			sessionStorage.fontStageOne = true;

//			console.log('Font loading 2 start');
	
			Promise.all([
				regularItalic.load(),
				bold.load(),
				boldItalic.load()
			]).then(function () {
				docEl.className += " fonts-all-loaded";
				sessionStorage.fontStageTwo = true;

//				console.log('Font loading complete');				
			});	
		});
	}

})( document );
