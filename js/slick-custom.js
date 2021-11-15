jQuery(function($){
	
	$(document).ready(function(){
		$('.js--homepage-carousel').slick({
			infinite: true,
			slidesToShow: 1,
			autoplay: false,
			arrows: true,
			prevArrow: '<button class="carousel__arrow carousel__arrow--prev" aria-label="carousel previous slide"></button>',
			nextArrow: '<button class="carousel__arrow carousel__arrow--next" aria-label="carousel next slide"></button>'
		});
	});
	
}(jQuery));
