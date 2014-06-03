/**
 * Videos
 *
 * for VideosController
 */
var Videos = {};

Videos.documentReady = function() {
}

/**
 * Create slugs based on title field
 *
 * @return void
 */
Videos.slug = function() {
	$("#VideoTitle").slug({
		slug:'slug',
		hide: false
	});
}

/**
 * document ready
 *
 * @return void
 */
$(document).ready(function() {
	if (Croogo.params.controller == 'videos') {
		Videos.documentReady();
		if (Croogo.params.action == 'admin_add') {
			Videos.slug();
		}
	}
});
