<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'instaelite',
	);

	public $instagram = array(
		'datasource' => 'InstagramDatasource.InstagramSource',
		'client_id' => '{CLIENTID}',
		'client_secret' => '{CLIENTSECRET}',
		'redirect_url' => ''
	);
}
