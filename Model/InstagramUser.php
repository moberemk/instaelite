<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property Campaign $Campaign
 * @property Offer $Offer
 */
class InstagramUser extends AppModel {
	public $useDbConfig = 'instagram';
}
