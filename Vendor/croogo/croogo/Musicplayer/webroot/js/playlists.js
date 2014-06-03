var Playlists = {};


/**
 * functions to execute when document is ready
 *
 * only for NodesController
 *
 * @return void
 */
Playlists.documentReady = function() {
    Playlists.initAddTracks();
    Playlists.initRemoveTracks();
}

Playlists.initAddTracks = function() {
    $('#tracks a.add-track').click(function(e) {
        $.get($(this).attr('href'), function(data) {
            $('#tracks .track:last').after(data);
            $('#tracks .remove-track').unbind();
            Playlists.initRemoveTracks();
        });
        e.preventDefault();
    })
}

/**
 * remove meta field
 *
 * @return void
 */
Playlists.initRemoveTracks = function() {
	$('#tracks .track .remove-track').click(function(e) {
		var trackToRemove = $(this);
		if (trackToRemove.attr('data-new-track') != 1) {
			if (!confirm('Remove this track?')) {
				return false;
			}
			$.getJSON(trackToRemove.attr('href') + '.json', function(data) {
				if (data.success) {
					trackToRemove.parents('.track').remove();
				} else {
					// error
				}
			});
		} else {
			trackToRemove.parents('.track').remove();
		}
		e.preventDefault();
		return false;
	});
}

/**
 * document ready
 *
 * @return void
 */
$(document).ready(function() {
	if (Croogo.params.controller == 'playlists') {
		Playlists.documentReady();
	}
});