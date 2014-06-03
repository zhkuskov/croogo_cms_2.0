<?php
App::uses('FacebookFeed', 'FacebookExtensions.Model');

/**
 * FacebookFeed Test Case
 *
 */
class FacebookFeedTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.facebook_extensions.facebook_feed',
		'plugin.facebook_extensions.facebook_post_type',
		'plugin.facebook_extensions.facebook_feeds_facebook_post_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacebookFeed = ClassRegistry::init('FacebookExtensions.FacebookFeed');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacebookFeed);

		parent::tearDown();
	}

}
