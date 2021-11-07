jQuery(function($){
	
	console.log('nav script running');
	
	var $sun = $('.js--header-sun');
	var $currentNav = $('.current-menu-item>a');
	var $allNavItems = $('.menu-item>a');
	var $logo = $('.custom-logo');
	var $header = $('.header');
	
	var sunOffset, currentNavOffset, positionDiff, sunTimer, logoOffset, sunWidth;
	
	//wait for google font to load
	document.fonts.load('1rem "Montserrat Alternates"').then(() => { 
		
		
		if ($currentNav.length) {
			console.log('current nav');
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
	 
	 function mouseIn(e) {
		 console.log(e);
		 clearTimeout(sunTimer);
		 var elmDiff = $(this).offset().left + $(this).width() / 2;
		 var newPosDiff = sunOffset - elmDiff;
		 
		 $sun.css('transform', 'translateX(-' + newPosDiff + 'px)');
	 }
	 
	 function mouseOut(e) {
		 console.log(e);
		 sunTimer = setTimeout(function() {
			 $sun.css('transform', 'translateX(0)');
		 }, 500);
	 }
	
}(jQuery));
