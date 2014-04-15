<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('InstagramDatasourceAppModel', 'InstagramDatasource.Model');
App::uses('InstagramSource', 'InstagramDatasource.Model/Datasource');
App::uses('Media', 'InstagramDatasource.Model');
/**
 * Offer Model
 *
 * @property Campaign $Campaign
 * @property User $User
 */
class Offer extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'campaign_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'description' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'caption' => array(
			'maxlength' => array(
				'rule' => array('maxlength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'offer' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Campaign' => array(
			'className' => 'Campaign',
			'foreignKey' => 'campaign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 *	If there is a non-null instagram ID, check that it is a URL. If it is,
	 *	replace the URL with a media ID (if possible)
	 *	@param options The options passed to the save function
	 *	@return boolean True if validation passes successfully, false otherwise
	 */
	function beforeValidate($options = array()) {
		// debug($this->data);
		if(!empty($this->data['Offer']['instagram_id'])) {
			if(filter_var($this->data['Offer']['instagram_id'], FILTER_VALIDATE_URL)) {
				$InstagramMedia = new Media();
				$media = $InstagramMedia->find('first', array('conditions'=>array('url'=>$this->data['Offer']['instagram_id'])));
				// debug($media);
				if(empty($media)) {
					// debug('Whoops');
					return false;
				} else {
					$exploded = explode('_',$media['Media']['media_id']);
					$this->data['Offer']['instagram_id'] = $exploded[0];
					$this->data['Offer']['posted'] = date('Y-m-d H:i:s', time());

					// Find the related user and send them an e-mail
					$offer = $this->findById($this->data['Offer']['id']);

					App::import('Component', 'CakeEmail');
					$email = new CakeEmail('smtp');

					$email->emailFormat('html')
						->to($offer['User']['email'])
						->subject('Link Confirmed')
						->send('Congratulations! Your link to your post has been confirmed. You can now see what you earned from this offer listed on your Revenue page.'.
								'Remember, to cash out you need a balance of at least $100 in your account.');
				}
			} else {
				return false;
			}
		}
		return true;
	}

	/**
	 *	If a new offer was created, send an e-mail notification
	 */
	function afterSave($created) {
		if($created) {
			// Get the last created record
			$offer = $this->findById($this->getLastInsertId());

			App::import('Component', 'CakeEmail');
			$email = new CakeEmail('smtp');

			$email->emailFormat('html')
				->to($offer['User']['email'])
				->subject('New Offer from InstaElite')
				->send('You\'ve received a new offer from InstaElite! <a href="http://instaelite.com">Go check it out!</a>');
		}
		return true;
	}

	function afterFind($results, $primary = false) {
		if($primary) {
			foreach($results as $key=>$result) {
				if(isset($result['Offer']) && isset($result['Offer']['instagram_id'])) {
					$results[$key]['InstagramMedia'] = $this->getInstagramInformation($result['Offer']);
				}
			}
		}
		return $results;
	}

	/**
	 *	Gets an offer's related Instagram media item
	 *	@param Offer An associative array containing information about an Offer
	 *	@return mixed Either null if no valid instagram ID exists for the media or an array otherwise
	 */
	function getInstagramInformation($offer) {
		$returned = null;
		if($offer['instagram_id'] != null) {
			$InstagramMedia = new Media();
			$offer['instagram_id'];
			try {
				$returned = $InstagramMedia->find('first', array('conditions'=>array('id'=>$offer['instagram_id'])));
			} catch(InstagramSourceException $e) {
				debug($e);
			}
		}

		return $returned;
	}


	/**
	 *	Find months with available reports
	 *	@param int The ID of the user to fetch reports for
	 *	@param array A conditions array to 
	 */
	public function getReportMonths($user_id, $conditions = array()) {
		$months = $this->query("SELECT DATE_FORMAT(posted, '%m') as \"month\", DATE_FORMAT(posted, '%Y') as \"year\" FROM offers WHERE posted IS NOT NULL GROUP BY LEFT(posted, 7) ORDER BY posted DESC");

		$results = array();
		foreach($months as $key => $row) {
			$results[$key] = $row[0];
		}

		return $results;
	}

	/**
	 *	Get a report on a  single month
	 */
	public function getMonthReport($user_id, $month, $year) {
		$offers = $this->find('all', array(
			'conditions' => array(
				'Offer.user_id' => $user_id,
				'Offer.posted IS NOT NULL',
				'MONTH(Offer.posted)' => $month,
				'YEAR(Offer.posted)' => $year
			),
			'fields' => array(
				'Offer.posted',
				'SUM(Offer.offer) AS total_offers',
				'MONTH(Offer.posted) AS month',
				'YEAR(Offer.posted) AS year'
			),
			'recursive' => -1
		));

		return $offers;
	}

	/**
	 *	Find totals per month
	 */
	public function getMonthlyReports($user_id, $conditions = array()) {
		$months = $this->getReportMonths($user_id);

		$return = array();
		foreach ($months as $key => $month) {
			$return[$key] = $this->getMonthReport($user_id, $month['month'], $month['year']);
		}
		return $return;
	}
}
