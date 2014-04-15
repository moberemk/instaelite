<?php
App::uses('AppModel', 'Model');
/**
 * RevenueReport Model
 *
 * @property User $User
 */
class RevenueReport extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty')
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 *	Update a user's Revenue Reports list
	 *	@param User An associative array containing a user's information
	 */
	public function refreshReports($user) {
		if($user['rakuten_id'] != null) {
			$latestReportTime = $last = $this->User->RevenueReport->find('first', array(
				'conditions' => array('User.id'=>$user['id']),
				'order'=>array('RevenueReport.process_datetime DESC'),
				'fields'=>array('RevenueReport.process_datetime')
			));

			$channel_username = '{CHANNELNAME}';
			$channel_password = '{CHANNELPASS}!';
			$channel_id = $user['rakuten_id'];

			if(count($latestReportTime)) {
				$startdate = date('Ymd', strtotime($latestReportTime['RevenueReport']['process_datetime']));
			} else {
				// Using a date where it's guaranteed to not have anything as the start
				$startdate = "20130101";
			}
			$enddate = date('Ymd', strtotime('-1 day'));
			$url = "http://cli.linksynergy.com/cli/publisher/reports/downloadReport.php?bdate=".$startdate."&edate=".$enddate."&cuserid=".$channel_username."&cpi=".$channel_password."&eid=".$channel_id;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$returned = curl_exec($ch);
			curl_close($ch);

			$parsed = explode("\n", $returned);

			$returned = array();
			if(count($parsed) > 1) {
				$associative_titles = array(
					'member_id',
					'advertiser_id',
					'advertiser_name',
					'order_id',
					'transaction_date',
					'transaction_time',
					'sku',
					'sales',
					'quantity',
					'Commissions',
					'process_date',
					'process_time',
					'number'
				);
				$count = 0;
				foreach ($parsed as $key => $value) {
					if($key) {
						$parsed_line = str_getcsv($value, "\t");

						// If the line has the right amount of content, map and return it
						if(count($parsed_line) == count($associative_titles)) {
							// Combine the arrays
							$mapped_array = array_combine($associative_titles, $parsed_line);
							// Replace a nonexistent member ID with a null
							if($mapped_array['member_id'] == '<none>') {
								$mapped_array['member_id'] = null;
							}

							// Format and add the data
							$mapped_array['user_id'] = $user['id'];

							// Combine the datetime fields
							$mapped_array['process_datetime'] = date("Y-m-d H:i:s",strtotime($mapped_array['process_date'].' '.$mapped_array['process_time']));
							unset($mapped_array['process_date']);
							unset($mapped_array['process_time']);

							$mapped_array['transaction_datetime'] = date("Y-m-d H:i:s",strtotime($mapped_array['transaction_date'].' '.$mapped_array['transaction_time']));
							unset($mapped_array['transaction_date']);
							unset($mapped_array['transaction_time']);

							// Make the integer values integers
							$mapped_array['quantity'] = floatval($mapped_array['quantity']);
							$mapped_array['Commission'] = floatval($mapped_array['Commissions']);
							unset($mapped_array['Commissions']);
							$mapped_array['number'] = intval($mapped_array['number']);
							$mapped_array['sales'] = intval($mapped_array['sales']);

							array_push($returned, $mapped_array);
						}
					}
				}
				return $returned;
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	/**
	 *	Before saving the data, check for a unique combination of process,
	 *	transaction, SKU, and order_id
	 */
	public function beforeValidate($options=array()) {
		return !(bool)$this->find('count', array(
			'conditions' => array(
				'RevenueReport.sku' => $this->data['RevenueReport']['sku'],
				'RevenueReport.process_datetime' => $this->data['RevenueReport']['process_datetime'],
				'RevenueReport.transaction_datetime' => $this->data['RevenueReport']['transaction_datetime'],
				'RevenueReport.order_id' => $this->data['RevenueReport']['order_id']
			),
			'recursive' => -1
		));

		if(count($count)) {
			debug($count);
			return false;
		} else {
			return true;
		}
	}

	/**
	 *	After a successful find, halve the Commission result (reflecting the 50% cut the company takes)
	 */
	public function afterFind($results, $primary = false) {
		foreach($results as $key => $report) {
			if(isset($results[$key]['RevenueReport']['Commission'])) {
				$results[$key]['RevenueReport']['Commission'] = round($results[$key]['RevenueReport']['Commission'] / 3, 2);
			}
		}
		return $results;
	}

	/**
	 *	Find months with available reports
	 *	@param int The ID of the user to fetch reports for
	 *	@param array A conditions array to
	 */
	public function getReportMonths($user_id, $conditions = array()) {
		$months = $this->query("SELECT DATE_FORMAT(process_datetime, '%m') as \"month\", DATE_FORMAT(process_datetime, '%Y') as \"year\" FROM revenue_reports GROUP BY LEFT(process_datetime, 7) ORDER BY process_datetime DESC");

		$results = array();
		foreach($months as $key => $row) {
			$results[$key] = $row[0];
		}

		return $results;
	}

	/**
	 * Get a report on a  single month
	 * @param  integer $user_id The ID of the user to fetch reports for
	 * @param  integer $month   The month to fetch reports for
	 * @param  integer $year    The year to fetch reports for
	 * @return array            An array of revenue reports
	 */
	public function getMonthReport($user_id, $month, $year) {
		return $this->find('all', array(
			'conditions' => array(
				'RevenueReport.user_id' => $user_id,
				'MONTH(RevenueReport.process_datetime)' => $month,
				'YEAR(RevenueReport.process_datetime)' => $year
			),
			'fields' => array(
				'RevenueReport.process_datetime',
				'SUM(RevenueReport.Commission) AS total_commission',
				'SUM(RevenueReport.sales) AS total_sales',
				'MONTH(RevenueReport.process_datetime) AS month',
				'YEAR(RevenueReport.process_datetime) AS year'
			),
			'recursive' => -1
		));
	}

	/**
	 * Find monthly income totals
	 * @param  integer $user_id    The user to fetch reports for
	 * @return array             An array of revenue reports
	 */
	public function getMonthlyReports($user_id) {
		$months = $this->getReportMonths($user_id);

		$return = array();
		foreach ($months as $key => $month) {
			$return[$key] = $this->getMonthReport($user_id, $month['month'], $month['year']);
		}
		return $return;
	}
}
