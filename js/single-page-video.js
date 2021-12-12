jQuery(function($){
	
	console.log('single-page-video.js running');
	
	const videoThumb = $('.js--video-thumbnail');
	
	if (videoThumb) {
		videoThumb.on('click mousemove', function() {
			console.log('videoThumb event');
			$(this).fadeOut();
		});
	}
	
}(jQuery));