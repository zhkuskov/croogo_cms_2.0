<?php
App::uses('MusicplayerAppModel', 'Musicplayer.Model');
/**
 * Playlist Model
 *
 * @property Musicplayer $Musicplayer
 * @property Track $Track
 */
class Playlist extends MusicplayerAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        public $actsAs = array(
		'Croogo.Params',
		'Search.Searchable',
                'Logging.Loggable',
                'Containable'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Musicplayer' => array(
			'className' => 'Musicplayer.Musicplayer',
			'foreignKey' => 'playlist_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Track' => array(
			'className' => 'Musicplayer.Track',
			'foreignKey' => 'playlist_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        
        public $findMethods = array(
		'tracks' => true,
	);

	protected function _findTracks($state, $query, $results = array()) {
		if ($state == 'before') {
			$query = Hash::merge($query, array(
				'recursive' => -1,
				'fields' => array('*', 'Track.*'),
				
				'joins' => array(
					array(
						'alias' => $this->Track->alias,
						'table' => $this->Track->useTable,
						'conditions' => 'Track.playlist_id = Playlist.id',
                                                'order' => 'Track.number desc',
					),
				),
			));
			if (!empty($query['id'])) {
				$query['conditions']['Playlist.id'] = $query['id'];
			}
			unset($query['id']);
			return $query;
		} else {
			if (isset($results[0]['Playlist']['id'])) {
				$album = array('Playlist' => $results[0]['Playlist']);
				$tracks = Hash::extract($results, '{n}.Track');
				$album['Track'] = $tracks;
				$results = $album;
			}
			if (isset($results[0]['Playlist'])) {
				$results = $results[0];
			}
			return $results;
		}
	}

}
