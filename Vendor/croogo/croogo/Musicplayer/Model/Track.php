<?php
App::uses('MusicplayerAppModel', 'Musicplayer.Model');
/**
 * Track Model
 *
 * @property Playlist $Playlist
 */
class Track extends MusicplayerAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


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
			'order' => ''
		)
	);
}
