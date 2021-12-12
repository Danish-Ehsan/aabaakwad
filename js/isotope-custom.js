jQuery(function($){
	
	// init Isotope
	const $grid = $('.js--isotope-grid').isotope({
		itemSelector: '.isotope-grid-item',
		percentPosition: true,
		layoutMode: 'fitRows'
	});
	
	//$grid.isotope({ filter: '.day-1' });
	
	const $filterBtns = $('.js--filter-btn');
	
	//console.log($filterBtns.eq(0).attr('data-filter'));
	
	//Set isotop to only show items from first category


	//console.log(window.location.href);
	const currentURL = window.location.href;
	const slugIndex = currentURL.indexOf('#');
	const slug = slugIndex != -1 ? currentURL.slice(slugIndex + 1) : '';
	
	console.log(slug);
	
	if (slug) {
		$grid.isotope({ filter: '.' + slug });
		$filterBtns.filter('[data-filter=".' + slug + '"]').eq(0).addClass('active');
	} else {
		$grid.isotope({ filter: $filterBtns.eq(0).attr('data-filter') });
		$filterBtns.eq(0).addClass('active');
	}
	//console.log(slug);
	
	
	
	// filter items on button click
	$('.js--filter-btns-cont').on( 'click', 'button', function() {
		console.log($(this).attr('data-filter'));
		
		$filterBtns.removeClass('active');
		$(this).addClass('active');
		var filterValue = $(this).attr('data-filter');
		$grid.isotope({ filter: filterValue });
	});
	
}(jQuery));
