<?php
App::uses('Videoplayer', 'Videos.Model');

/**
 * Videoplayer Test Case
 *
 */
class VideoplayerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.videos.videoplayer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Videoplayer = ClassRegistry::init('Videos.Videoplayer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Videoplayer);

		parent::tearDown();
	}

}
