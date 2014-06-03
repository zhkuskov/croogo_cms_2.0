<?php
App::uses('MusicplayerAppModel', 'Musicplayer.Model');
/**
 * Musicplayer Model
 *
 * @property Playlist $Playlist
 */
class Musicplayer extends MusicplayerAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        public $actsAs = array('Containable', 'Logging.Loggable');

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
                        'inList'  => array(
                                'rule' => array('inList', array('Spotify Player', 'Audioplayer (Stream)')),
                                'message' => "Please select one of the currently implemented Musicplayer types: Spotify Player or Audioplayer (Stream)"
                        )
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Playlist' => array(
			'className' => 'Musicplayer.Playlist',
			'foreignKey' => 'playlist_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
                        
		)
	);
}
