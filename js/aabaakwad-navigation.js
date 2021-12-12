jQuery(function($){
	
	//console.log('DOM ready');
	
	const $sun = $('.js--header-sun');
	const $currentNav = $('.nav__list > .current-menu-item > a');
	const $allNavItems = $('.menu-item>a');
	const $header = $('.header');
	const $logo = $('.custom-logo');
	const logoSrc = $logo.attr('src');
	
	var prevWidth = $(window).width();
	
	//$(window).on('resize', sunRise);
	
	const sunRiseTimer = setInterval(function() {
		//if window hasn't been resized
		if ( $(window).width() !== prevWidth ) {
			prevWidth = $(window).width();
			sunRise();
		}
	}, 500);
	
	function sunRise() {
		
		var sunOffset, currentNavOffset, positionDiff, logoOffset, sunWidth, newPos;
		
		//change the logo color if sun is rising behind it
		if ( logoSrc.indexOf('-blue') === -1 && (!$currentNav.length || $(window).width() <= 1200) ) {
			//console.log('swapping logo');
			insertPos = logoSrc.indexOf('.png');
			const newSrc = [logoSrc.slice(0, insertPos), '-blue', logoSrc.slice(insertPos)].join('');
			//console.log(newSrc);
			$logo.attr('src', newSrc);
		} else {
			$logo.attr('src', logoSrc);
		}

		//console.log('currentNav length = ' + $currentNav.length);
		if ($currentNav.length && $(window).width() > 1200) {
			//console.log('behind nav');
			sunWidth = $currentNav.width() + 100;
			sunOffset = ( $sun.offset().left + $sun.width() ) / 2;
			sunScale =  sunWidth / $sun.width();

			currentNavOffset = $currentNav.offset().left + $currentNav.width() / 2;
			//console.log('navOffset = ' + currentNavOffset);
			//console.log('sunOffset = ' + sunOffset);
			newPos = ( currentNavOffset  - (sunWidth / 2) );
		} else {
			//console.log('behind sun');
			sunWidth = $logo.width() + 125;
			sunOffset = $sun.offset().left + $sun.width() / 2;
			sunScale =  sunWidth / $sun.width();
			
			logoOffset = $logo.offset().left + $logo.width() / 2;
			newPos = logoOffset - (sunWidth / 2);
		}

		//console.log(currentNavOffset);
		$header.addClass('header--blue');
		//console.log(positionDiff);
		$sun.css({
			'left': newPos + 'px',
			'transform': 'translate(0, 0) scale(' + sunScale + ')'
		});
	
	}
	
	//wait for images to load
	$(window).on('load', function() {
		//console.log('window loaded');
		//wait for google font to load
		document.fonts.ready.then(function() {
			//console.log('fonts loaded');
			sunRise();
		});
	});

	//Mobile nav
	const $navBtn = $('.js--nav-btn');
	const $navMenu = $('.js--nav');
	
	$navBtn.on('click', function() {
		$navMenu.toggleClass('nav--visible');
		$navBtn.toggleClass('nav-toggle--open');
	});
	
}(jQuery));
