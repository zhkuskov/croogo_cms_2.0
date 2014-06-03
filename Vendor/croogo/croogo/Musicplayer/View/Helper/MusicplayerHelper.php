<?php

/**
 * MusicplayerHelper
 *
 * @author Björn Wahle <bjoern.wahle@sonymusicexternal.com>
 */
class MusicplayerHelper extends AppHelper {
 
/**
 * Helpers
 */
	public $helpers = array(
		'Html',
		'Form',
                'Croogo',
                'Js',
                'Layout'
	); 
        
        public function assets($options = array()) {
            echo $this->Html->script('/cache_js/js-libs', $options);
            echo $this->Html->css('/cache_css/css-all', $options);
	}
        
        /**
         * Renders a Spotify player for a given Spotify URL (Playlist / Album / Track)
         * Available options:
         *  - 'size' => small or large (large is default)
         *  - 'width' => width of the iframe
         *  - 'height' => height of the iframe
         * 
         * 
         * When size == large : 
         *  - 'theme' => black or white (black is default)
         *  - 'view' => list or coverart
         * 
         * 
         * For height and weight please read following information:
         *  <strong>Player min/max sizes</strong>
         *
         *  You specify the height and width of the player by setting the height and width properties of the iframe.
         *  Player size
         *                      Height   Width
         *  Minimum size	80px	250px
         *  Maximum size	720px	640px
         * 
         * <strong>What kind of player is rendered?</strong>
         * 
         * The large player will be rendered if the given height is 80 pixels greater than the given width. Otherwise the small player will be rendered.
         * 
         * @param String $playlistURL
         * @param Array $options
         * @return String HTML for the Spotify 
         */
        public function renderSpotifyPlayer($playlistURL, $options = array()) {
            $def_options = array(
                'size' => 'small',
                'theme' => 'black',
                'view'  => 'list'
            );
            $options = Set::merge($def_options, $options);
            
            if($options['size'] == "large") {
                if(empty($options['height'])) {
                    $options['height'] = 380;
                }
                if(empty($options['width'])) {
                    $options['width'] = 300;
                }
                $playerHtml = sprintf('<iframe src="https://embed.spotify.com/?uri=%s&theme=%s&view=%s" width="%s" height="%s" frameborder="0" allowtransparency="true"></iframe>', $playlistURL, $options['theme'], $options['view'], $options['width'], $options['height']);
            } else if($options['size'] == "small") {
                if(empty($options['height'])) {
                    $options['height'] = 80;
                }
                if(empty($options['width'])) {
                    $options['width'] = 300;
                }
                $playerHtml = sprintf('<iframe src="https://embed.spotify.com/?uri=%s" width="%s" height="%s" frameborder="0" allowtransparency="true"></iframe>', $playlistURL, $options['width'], $options['height']);
            }
            return $playerHtml;
        }
   
        public function tracks($tracks,$id, $options = array()) {
            $html = "";
            foreach($tracks as $track) {
                $html .= $this->Html->tag('li', $this->track($track, $options));
            }
            $html = $this->Html->tag('div', $this->Html->tag('ul', $html), array('class' => 'tracklist', 'data-musicplayer' => $id));
            return $html;
        }
        
        public function track($track, $options = array()) {
            $icon = "<span class='icon play'></span>";
            //$link = "<a class='playLink' href='".$track['streaming_link_desktop']."'>".$icon."</a>";
            $link = $this->Html->tag('a', $icon, array('class' => 'playLink', 'href' => $track['streaming_link_desktop']));
            $track = $link.$this->Html->tag('span', $track['name'], array('class' => 'track-title'));
         
            return $track;
        }
        
        public function initialize($id, $options = array()) {
            
            $config = json_encode(array(
             		'solution' => 'html, flash',
			'swfPath' => $this->webroot.'musicplayer/swf/Jplayer.swf',
			'volume' => 100,
			'supplied' => 'rtmpa',
			'wmode' => 'window',
			'preload'=> 'auto'   
            ));
            $js = sprintf('$("%s").jPlayer(%s);',
			'#jquery_jplayer_'. $id,
			$config
            );
            $this->Js->buffer($js);
            echo $this->assets();
            echo $this->Html->script('/cache_js/js-libs', $options);
        }
        
        public function initialize_admin($options = array()) {
            $scripts = $this->assets();
            $scripts  .= $this->Html->script('/cahe_js/js-libs', $options);
            $config = json_encode(array(
             		'solution' => 'html, flash',
			'swfPath' => $this->webroot.'musicplayer/swf/Jplayer.swf',
			'volume' => 100,
			'supplied' => 'rtmpa',
			'wmode' => 'window',
			'preload'=> 'auto'   
            ));
            $js = sprintf('$("%s").jPlayer(%s);',
			'#jquery_jplayer',
			$config
            );
            $this->Js->buffer($js);
            echo $scripts;
        }
        
        
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
	public function afterSetNode() {
		$this->Layout->setNodeField('body', preg_replace_callback('/\[Musicplayer:([0-9]+)\]/',array(&$this,'replaceForPlayer'), $this->Layout->node('body')));
	}

	public function replaceForPlayer($subject) {
		preg_match('/\[Musicplayer:([0-9]+)\]/', $subject[0], $matches);
		return $this->_View->element('musicplayer', array('id' => $matches[1]), array('plugin' => 'musicplayer'));
	}
}
