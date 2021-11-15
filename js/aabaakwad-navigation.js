jQuery(function($){
	
	//console.log('DOM ready');
	
	const $sun = $('.js--header-sun');
	const $currentNav = $('.nav-menu > .current-menu-item > a');
	const $allNavItems = $('.menu-item>a');
	const $header = $('.header');
	const $logo = $('.custom-logo');
	const logoSrc = $logo.attr('src');
	
	var sunOffset, currentNavOffset, positionDiff, sunTimer, logoOffset, sunWidth;
	
	if ( logoSrc.indexOf('-blue') === -1 && !$currentNav.length ) {
		//console.log('swapping logo');
		insertPos = logoSrc.indexOf('.png');
		const newSrc = [logoSrc.slice(0, insertPos), '-blue', logoSrc.slice(insertPos)].join('');
		//console.log(newSrc);
		$logo.attr('src', newSrc);
	}
	
	//wait for images to load
	$(window).on('load', function() {
		//console.log('window loaded');
		//wait for google font to load
		document.fonts.ready.then(function() {
			//console.log('fonts loaded');
			if ($currentNav.length) {
				//console.log('current nav');
				sunWidth = $currentNav.width() + 100;
				sunOffset = $sun.offset().left + $sun.width() / 2;
				sunScale =  sunWidth / $sun.width();

				currentNavOffset = $currentNav.offset().left + $currentNav.width() / 2;
				positionDiff = currentNavOffset - sunOffset;
			} else {
				console.log('not current nav');
				sunWidth = $logo.width() + 125;
				sunOffset = $sun.offset().left + $sun.width() / 2;
				sunScale =  sunWidth / $sun.width();

				logoOffset = $logo.offset().left + $logo.width() / 2;
				positionDiff = logoOffset - sunOffset;
			}

			//console.log(currentNavOffset);
			$header.addClass('header--blue');

			$sun.css({
				'left': positionDiff + 'px',
				'transform': 'translateY(0) scale(' + sunScale + ')'
			});

			//$allNavItems.hover(mouseIn, mouseOut);
		 });
	 });
	 
//	 function mouseIn(e) {
//		 console.log(e);
//		 clearTimeout(sunTimer);
//		 var elmDiff = $(this).offset().left + $(this).width() / 2;
//		 var newPosDiff = sunOffset - elmDiff;
//		 
//		 $sun.css('transform', 'translateX(-' + newPosDiff + 'px)');
//	 }
//	 
//	 function mouseOut(e) {
//		 console.log(e);
//		 sunTimer = setTimeout(function() {
//			 $sun.css('transform', 'translateX(0)');
//		 }, 500);
//	 }
	
}(jQuery));
