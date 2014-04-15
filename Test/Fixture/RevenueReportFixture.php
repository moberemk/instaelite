<?php
/**
 * RevenueReportFixture
 *
 */
class RevenueReportFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'quantity' => array('type' => 'float', 'null' => true, 'default' => null),
		'comission' => array('type' => 'float', 'null' => true, 'default' => null),
		'process_datetime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'member_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'advertiser_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'advertiser_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'order_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'transaction_datetime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'sku' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'number' => array('type' => 'integer', 'null' => true, 'default' => null),
		'sales' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'quantity' => 1,
			'comission' => 1,
			'process_datetime' => '2013-08-17 21:48:59',
			'member_id' => 'Lorem ipsum dolor ',
			'advertiser_id' => 'Lorem ipsum dolor ',
			'advertiser_name' => 'Lorem ipsum dolor sit amet',
			'order_id' => 'Lorem ipsum dolor sit amet',
			'transaction_datetime' => '2013-08-17 21:48:59',
			'sku' => 'Lorem ipsum dolor sit amet',
			'number' => 1,
			'sales' => 1
		),
	);

}
