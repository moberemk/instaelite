<?php

/**
 * Media entry (photo) added to Instagram. Maps to the /media API endpoint.
 *
 * @package InstagramDatasource
 * @author Michael Enger <mien@nodesagency.no>
 * @see http://instagram.com/developer/endpoints/media/
 */
class User extends InstagramDatasourceAppModel {

/**
 * The database configuration to use.
 *
 * @var string
 */
	public $useDbConfig = 'instagram';

/**
 * Schema describing the model.
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255
		),
		'username' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255,
		),
		'full_name' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255,
		),
		'profile_picture' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255,
		),
		'bio' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255,
		),
		'website' => array(
			'type' => 'string',
            'null' => false,
            'length' => 255,
		),
		'counts' => array(
			'type' => 'array',
            'null' => false,
		),
	);

}
