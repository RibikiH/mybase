/**
 * auto load js for this area
 */

if ('undefined' == $.type(PublicController)) {
	var PublicController = {};
}
if (!$.isPlainObject(PublicController)) {
	PublicController = {};
}

$(function() {

	$('header .nav-menu').hover(function() {
		$(this).find('ul').removeClass('hidden');
	}, function() {
		$(this).find('ul').addClass('hidden');
	});

	$('#lightSlider').lightSlider({
		item: 1,
		slideMargin: 10,
		adaptiveHeight: true,
		controls: false,
	});

	$('img.lazy').lazy({
		afterLoad: function (image) {
			$height = image.height();
			$width = image.width();
			$container = image.closest('div');

			if ($container.hasClass('lazyBlock')) {
				if ($width > $height) {
					image.css({
						'height': '100%',
						'left': '-33%'
					});
				} else if ($width < $height) {
					image.css({
						'width': '100%',
						'top': '-33%'
					});
				} else {
					image.css('width', '100%');
				}
			}
		}
	});

	var postSlider = $('#postSlider').lightSlider({
		item: 1,
		controls: false,
	});

	$('.hot-news .control-slider .next').click(function(e) {
		e.preventDefault();
		postSlider.goToNextSlide();
	});
	$('.hot-news .control-slider .back').click(function(e) {
		e.preventDefault();
		postSlider.goToPrevSlide();
	});
});