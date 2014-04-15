<?php
App::uses('AppModel', 'Model');
App::uses('InstagramUser', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property Campaign $Campaign
 * @property Offer $Offer
 */
class User extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
		public $displayField = 'username';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'minlength' => array(
				'rule' => array('minLength', '8'),
	            'message' => 'Mimimum 8 characters long'
			)
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'rakuten_id' => array(
			'rule' => array('maxlength', 11)
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
			),
		),
		'modified' => array(
			'datetime' => array(
				'rule' => array('datetime'),
			),
		),
		'bio' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 500),
				'allowEmpty' => true,
			),
		),
		'facebook' => array(
			'url' => array(
				'rule' => array('url'),
				'allowEmpty' => true
			)
		),
		'website' => array(
			'url' => array(
				'rule' => array('url'),
				'allowEmpty' => true
			)
		),
		'twitter' => array(
			'url' => array(
				'rule' => array('url'),
				'allowEmpty' => true
			)
		),
		'pinterest' => array(
			'url' => array(
				'rule' => array('url'),
				'allowEmpty' => true
			)
		),
		'post_price' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => true,
			),
		),
		'video_price' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => true,
			),
		),
		'address' => array(
		),
		'city' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'allowEmpty' => true,
			),
		),
		'province' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'allowEmpty' => true,
			),
		),
		'postal_code' => array(
			'postal' => array(
				'rule' => array('postal', null, 'ca'),
				'allowEmpty' => true,
			),
		),
		'paypal' => array(
			'email' => array(
				'rule' => array('email'),
				'allowEmpty' => true
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id'
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Campaign' => array(
			'className' => 'Campaign',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'Offer' => array(
			'className' => 'Offer',
			'foreignKey' => 'user_id',
			'dependent' => false
		),
		'RevenueReport' => array(
			'className' => 'RevenueReport',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'user_id',
			'dependent' => true
		)
	);

	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'user_categories',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'category_id',
			'unique' => true
		)
	);

	public $actsAs = array(
		'Containable',
		'Upload.Upload' => array(
			'cover_photo' => array(
				'thumbnailMethod' => 'php',
				'path' => '{ROOT}webroot{DS}img{DS}users{DS}cover_photos{DS}'
			),
			'profile_photo' => array(
				'thumbnailMethod' => 'php',
				'path' => '{ROOT}webroot{DS}img{DS}users{DS}profile_photo{DS}'
			)
		)
	);


	/**
	 *	Hash the password before saving
	 */
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}

	/**
	 *	Method to manipulate the result set after it's found by attaching an Instagram User to it
	 */
	public function afterFind($results, $primary = false) {
		if($primary) {
			$InstagramUser = new InstagramUser();
			foreach($results as $key => $result) {
				debug($results[$key]);
				if(isset($results[$key]['User']) && (isset($results[$key]['User']['instagram_id']) || $results[$key]['User']['instagram_id'] == null)) {
					// If there's no set instagram user ID, then find it and save it to the database for future reference
					if($results[$key]['User']['instagram_id'] == null) {
						$instagramUser = $InstagramUser->find('first', array('conditions'=>array('username'=>$result['User']['username'])));
						$results[$key]['User']['instagram_id'] = $instagramUser['InstagramUser']['id'];
						unset($results[$key]['User']['password']);
						$this->save($results[$key]['User']);
					} else if(($results[$key]['User']['retrieved'] == null) || ($results[$key]['User']['retrieved'] > strtotime('-1 day'))) {
						// Now check that the last update time was more than six hours ago
						$instagramUser = $InstagramUser->find('first', array('conditions'=>array('id'=>$result['User']['instagram_id'])));

						// If the data has been successfully retrieved, save it to the DB
						if($instagramUser['InstagramUser']) {
							$results[$key]['User']['follower_count'] = $instagramUser['InstagramUser']['counts']['followed_by'];
							$results[$key]['User']['retrieved'] = date('Y-m-d H:i:s', time());;
							unset($results[$key]['User']['password']);
							$this->save(array('User'=>$results[$key]['User']));
						}
					}
				}
			}
		}

		return $results;
	}

	/**
	 *	Gets the totals for offers, commission, and payments, as well as the
	 *	calculated total of all three (commission halved)
	 */
	public function getTotals($user_id) {
		$return = array();

		$offers = $this->Offer->find('first', array(
			'fields' => array(
				'SUM(Offer.offer) AS "total"'
			),
			'conditions' => array(
				'User.id'=>$user_id,
				'Offer.accepted'=>1,
				'`Offer`.`instagram_id` IS NOT NULL'
			),
			'order' => array(
				'Offer.created DESC'
			)
		));
		if(count($offers)) {
			$return['postTotal'] = round($offers[0]['total'], 2);
		} else {
			$return['postTotal'] = 0;
		}

		$revenueReports = $this->RevenueReport->find('first', array(
			'fields' => array(
				'SUM(RevenueReport.commission) AS "total"'
			),
	        'conditions' => array('User.id'=>$user_id),
	        'order' => array(
	        	'RevenueReport.process_datetime' => 'desc'
	        )
		));

		if(count($revenueReports)) {
			$return['revenueReportTotal'] = round($revenueReports[0]['total'] / 2, 2);
		} else {
			$return['revenueReportTotal'] = 0;
		}

		$payments = $this->Payment->find('first', array(
			'fields' => array(
				'SUM(Payment.amount) AS "total"'
			),
			'conditions' => array(
				'User.id'=>$user_id
			)
		));

		if(count($payments)) {
			$return['paymentTotal'] = round($payments[0]['total'], 2);
		} else {
			$return['paymentTotal'] = 0;
		}

		$return['overallTotal'] = round(($return['postTotal'] + $return['revenueReportTotal']) - $return['paymentTotal'], 2);
		return $return;
	}
}
