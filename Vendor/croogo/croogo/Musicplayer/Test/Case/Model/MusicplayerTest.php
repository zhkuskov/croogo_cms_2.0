<?php
App::uses('Musicplayer', 'Musicplayer.Model');

/**
 * Musicplayer Test Case
 *
 */
class MusicplayerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.musicplayer.musicplayer',
		'plugin.musicplayer.playlist'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Musicplayer = ClassRegistry::init('Musicplayer.Musicplayer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Musicplayer);

		parent::tearDown();
	}

}
