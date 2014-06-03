<?php

App::uses('AppController', 'Controller');

class GalleryAppController extends AppController {

	public $paginate = array();

	public function beforeFilter() {
		if (false === ($setting = Cache::read('Gallery.jslibs', 'gallery'))) {
			$setting = ClassRegistry::init('Setting')->findByKey('Gallery.jslibs');
			Cache::write('Gallery.jslibs', $setting, 'gallery');
		}
		Configure::write('Gallery.jslibs', $setting['Setting']['value']);

		return parent::beforeFilter();
	}

}