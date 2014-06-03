<?php
App::uses('TrackingsAppModel', 'Trackings.Model');
/**
 * Tracking Model
 *
 */
class Tracking extends TrackingsAppModel {

    public $actsAs = array('Logging.Loggable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'trackingcode' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'if iTunes, leave blank',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
