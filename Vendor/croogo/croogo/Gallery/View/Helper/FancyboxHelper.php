<?php

App::uses('AppHelper', 'View/Helper');

class FancyboxHelper extends AppHelper {

	public $helpers = array(
		'Html',
		'Js',
		'Gallery.Gallery',
	);

	public function assets($options = array()) {
		echo $this->Html->script('/cache_js/js-libs', $options);
		echo $this->Html->script('/cache_js/js-libs', $options);
		echo $this->Html->css('/cache_css/css-all', $options);
		echo $this->Html->css('/cache_css/css-all', $options);
	}

	public function album($album, $photos) {
		return $this->Html->tag('div', $photos, array(
			'id' => 'gallery-' . $album['Album']['id'],
		));
	}

	public function photo($album, $photo) {
                $photo = $this->Gallery->normalizePaths($photo);
		$urlLarge = $this->Html->url('/' . $photo['large']); #$this->Html->url
		$urlSmall = ('/' . $photo['small']);
		$imgTag = $this->Html->image($urlSmall);
		return $this->Html->tag('a', $imgTag, array(
			'href' => $urlLarge,
			'rel' => 'gallery-' . $album['Album']['id'],
			'class' => 'gallery-thumb',
		));
	}

	public function initialize($album) {
		$config = $this->Gallery->getAlbumJsParams($album);
		$js = sprintf('$(\'a[rel=%s]\').fancybox(%s);',
			'gallery-' . $album['Album']['id'],
			$config
		);
		$this->Js->buffer($js);
	}

}
