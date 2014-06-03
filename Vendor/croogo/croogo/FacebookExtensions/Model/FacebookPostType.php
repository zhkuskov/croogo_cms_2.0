<?php
App::uses('FacebookExtensionsAppModel', 'FacebookExtensions.Model');
/**
 * FacebookPostType Model
 *
 */
class FacebookPostType extends FacebookExtensionsAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
        
        public $actsAs = array('Logging.Loggable');

}
