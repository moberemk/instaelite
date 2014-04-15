<?php
App::uses('RevenueReport', 'Model');

/**
 * RevenueReport Test Case
 *
 */
class RevenueReportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.revenue_report',
		'app.user',
		'app.group',
		'app.campaign',
		'app.offer',
		'app.category',
		'app.user_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RevenueReport = ClassRegistry::init('RevenueReport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RevenueReport);

		parent::tearDown();
	}

}
