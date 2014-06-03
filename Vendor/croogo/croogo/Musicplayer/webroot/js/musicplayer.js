(function (_obj) {
    
        _obj.musicplayer = {
	
	debug 		: false,
	osName 		: null,
	
	init : function () {

		try {
			
			if(uiCore.mobileCheck()) {
				
				// play sound on click
				$('.playLink').click(function () {
					if ($(this).children().hasClass('play')) {
						$('.icon').removeClass('pause').addClass('play');
					}
					if ($(this).children().hasClass('play')) {
						$('#jquery_jplayer_'+$(this).parents('.tracklist').attr('data-musicplayer')).jPlayer("setMedia", { m3u8a: $(this).attr('href') }).jPlayer('play');
						$(this).children().removeClass('play').addClass('pause');
					}
					else {
						$('#jquery_jplayer_'+$(this).parents('.tracklist').attr('data-musicplayer')).jPlayer('pause');
						$(this).children().removeClass('pause').addClass('play');
					}
					return false; 			
				});
			}
			else {
				// play sound on click
				$('.playLink').click(function (e) {
                                        e.preventDefault();
					if ($(this).children().hasClass('play')) {
						$('.icon').removeClass('pause').addClass('play');
					}
					if ($(this).children().hasClass('play')) {
						$('#jquery_jplayer_'+$(this).parents('.tracklist').attr('data-musicplayer')).jPlayer("setMedia", { rtmpa: $(this).attr('href') }).jPlayer('play');
						$(this).children().removeClass('play').addClass('pause');
					}
					else {
						$('#jquery_jplayer_'+$(this).parents('.tracklist').attr('data-musicplayer')).jPlayer('clearMedia');
						$(this).children().removeClass('pause').addClass('play');
					}
					return false; 			
				});
			}
		} catch (e) {
			alert("Bitte beutzten Sie einen anderen Browser.");
                }
        }       
    };	
})(uiCore);

jQuery(function () {
	uiCore.musicplayer.init();
});
