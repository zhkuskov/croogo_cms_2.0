<?php
    $this->Musicplayer = $this->Helpers->load('Musicplayer.Musicplayer');
    $response = $this->requestAction(array('plugin' => 'musicplayer', 'controller' => 'musicplayers', 'action' => 'get_musicplayer'), array('pass' => array('id' => $id)));
    $musicplayer = $response['Musicplayer'];
   
    if($musicplayer['type'] == "Audioplayer (Stream)") {
        $playlist = $response['Playlist'];
        $tracks = $playlist['Track'];
        echo $this->Musicplayer->tracks($tracks, $id);
    
    
?>
<div id="<?php echo "jquery_jplayer_1"; ?>"></div>
<?php
 $this->Musicplayer->initialize($id);
    } else if($musicplayer['type'] == "Spotify Player") {
        echo $this->Musicplayer->renderSpotifyPlayer($musicplayer['player_url'], array('size' => 'large', 'theme' => 'white', 'view' => 'list', 'width' => 640, 'height' => 720));
    }
?>
