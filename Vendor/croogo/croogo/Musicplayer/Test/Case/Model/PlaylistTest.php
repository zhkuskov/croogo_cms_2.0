<?php
App::uses('Playlist', 'Musicplayer.Model');

/**
 * Playlist Test Case
 *
 */
class PlaylistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.musicplayer.playlist',
		'plugin.musicplayer.musicplayer',
		'plugin.musicplayer.track'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Playlist = ClassRegistry::init('Musicplayer.Playlist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Playlist);

		parent::tearDown();
	}

}
