jQuery(function($){
	
	// init Isotope
	var $grid = $('.js--isotope-grid').isotope({
		itemSelector: '.isotope-grid-item',
		percentPosition: true,
		layoutMode: 'fitRows'
	});
	
	//$grid.isotope({ filter: '.day-1' });
	
	var $filterBtns = $('.js--filter-btn');
	
	//console.log($filterBtns.eq(0).attr('data-filter'));
	
	//Set isotop to only show items from first category
	$grid.isotope({ filter: $filterBtns.eq(0).attr('data-filter') });
	$filterBtns.eq(0).addClass('active');
	
	// filter items on button click
	$('.js--filter-btns-cont').on( 'click', 'button', function() {
		console.log($(this).attr('data-filter'));
		
		$filterBtns.removeClass('active');
		$(this).addClass('active');
		var filterValue = $(this).attr('data-filter');
		$grid.isotope({ filter: filterValue });
	});
	
}(jQuery));
