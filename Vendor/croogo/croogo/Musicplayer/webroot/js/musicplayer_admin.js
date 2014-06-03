(function (_obj) {
    
        _obj.musicplayer = {
	
	debug 		: false,
	osName 		: null,
	
	init : function () {

		try {
			
			if(uiCore.mobileCheck()) {
                            protocol = "m3u8a";
			}
			else {
                            protocol = "rtmpa";
			}
                        
                        // play sound on click
                        $('.playLink').click(function (e) {
                                e.preventDefault();
                                if ($(this).children().hasClass('icon-play')) {
                                        $('.playLink .icon').removeClass('icon-pause').addClass('icon-play');
                                }
                                if ($(this).children().hasClass('icon-play')) {
                                        if(protocol == "rtmpa") {
                                            $('#jquery_jplayer').jPlayer("setMedia", { rtmpa: $(this).attr('href') }).jPlayer('play');
                                        } else {
                                            $('#jquery_jplayer').jPlayer("setMedia", { m3u8a: $(this).attr('href') }).jPlayer('play');
                                        }
                                        $(this).children().removeClass('icon-play').addClass('icon-pause');
                                }
                                else {
                                        $('#jquery_jplayer').jPlayer('clearMedia');
                                        $(this).children().removeClass('icon-pause').addClass('icon-play');
                                }
                                return false; 			
                        });
                        
		} catch (e) {
			alert("Bitte beutzten Sie einen anderen Browser.");
                }
        }       
    };	
})(uiCore);

jQuery(function () {
	uiCore.musicplayer.init();
});
