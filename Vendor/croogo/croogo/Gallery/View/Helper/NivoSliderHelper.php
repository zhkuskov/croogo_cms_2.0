<?php

App::uses('AppHelper', 'View/Helper');

class NivoSliderHelper extends AppHelper {

	public $helpers = array(
		'Html',
		'Js',
		'Gallery.Gallery',
	);

	public function assets($options = array()) {
		echo $this->Html->script('/gallery/js/jquery.nivo.slider', $options);
		echo $this->Html->css('/cache_css/css-all', $options);
	}

	public function album($album, $photos) {
		return $this->Html->tag('div', $photos, array(
			'id' => 'gallery-' . $album['Album']['id'],
		));
	}

	public function photo($album, $photo) {
            $photo = $this->Gallery->normalizePaths($photo);
            if (isset($photo['title']))
            {
                $title = $photo['title'];
            }
            else
            {
                $title = '';
            }
            if (isset($photo['url']))
            {
                $url = $photo['url'];
            }
            else
            {
                $url = '';
            }
            $urlLarge = ('/' . $photo['large']); #$this->Html->url
                    $urlSmall = ('/' . $photo['small']); #$this->Html->url
                    $options = Set::merge(array(
                            'rel' => $urlSmall,
                            'title' => $title,
                            'url' => $url,
                    ));
                    return $this->Html->image($urlLarge, $options);
	}

	public function initialize($album) {
		$config = $this->Gallery->getAlbumJsParams($album);
		$milliSecs = 2000;
        // TODO Change target_blank functionality for use with target status
		$js = sprintf('setTimeout(function() { $(\'#%s\').nivoSlider(%s); jQuery(".nivoSlider a").attr("target","_blank"); }, %d)',
			'gallery-' . $album['Album']['id'],
			$config,
			$milliSecs
		);
		$this->Js->buffer($js);
	}

}
