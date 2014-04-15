<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function before_filter() {
		// Allow access to index and view methods
		$this->Auth->allow('index', 'view');

		Parent::before_filter();
	}

	/**
	 *	Login function
	 */
	public function login() {
		if(!$this->Auth->user()) {
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		            return $this->redirect($this->Auth->redirectUrl());
		        } else {
		            $this->Session->setFlash(__('Username or password is incorrect'), 'auth', array(), 'auth');
		        }
		    }
		} else {
			$this->redirect(array('action'=>'profile'));
		}
	}

	/**
	 *	Logout function
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('users', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($username = null) {
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.username' => $username
			),
			'contain' => array('Offer','Category')
		));
		if (!count($user)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->set('user', $user);

		$this->set('offers', $this->User->Offer->find('all', array(
			'fields' => array(
				'Offer.instagram_id',
				'Campaign.buy_url',
				'Campaign.caption',
				'Campaign.image',
				'Campaign.id',
				'Offer.id'
			),
			'conditions' => array(
				'User.id'=>$user['User']['id'],
				'Offer.accepted'=>1,
				'`Offer`.`instagram_id` IS NOT NULL'
			),
			'limit' => 25,
			'order' => array(
				'Offer.created DESC'
			)
		)));

		// Get random other users
		$this->set('random_users', $this->User->find('all', array('conditions'=> array(
			'User.group_id!=0',
			'User.id!='.$user['User']['id']),
			'order'=>'rand()',
			'limit'=>3,
			'contain' => array('Offer','Category')
		)));

	}

	/**
	 *	For logged in users, proxies to view for their own username;
	 *	for everyone else, redirect to the users index page
	 */
	public function profile() {
		$user = $this->Auth->user();
		if($user != null) {
			$this->redirect(array('action'=>'view', $user['username']));
		} else {
			$this->redirect(array('action'=>'index'));
		}
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 *	Options page
	 */
	public function options() {
		$authUser = $this->Auth->user();
		$id = $authUser['id'];
		$user = $this->User->findById($id);
		$this->set('user', $user);

		$categories = $this->User->Category->find('list');
		$this->set('categories',$categories);

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	/**
	 *	Password change
	 */
	public function change_password() {
		$authUser = $this->Auth->user();
		$id = $authUser['id'];
		$user = $this->User->findById($id);
		$this->set('user', $user);

		if ($this->request->is('post') || $this->request->is('put')) {
			if(($this->request->data['User']['password'] == $this->request->data['User']['repeat_password']) &&
				(AuthComponent::password($this->data['User']['original_password'] == $user['User']['password']))) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('Password has been changed successfully!'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Error changing password; please try again'));
				}	
			} else {
				$this->Session->setFlash(__('Please retype your new password'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	/**
	 *	Revenue page
	 */
	public function revenue($user_id = null, $second_param = null) {
		if(is_string($user_id)) {
			switch ($user_id) {
				case 'commission':
					$this->revenue_Commission($second_param);
					return true;
					break;
				case 'posts':
					$this->revenue_posts($second_param);
					return true;
					break;
				default:
					$user_id = $second_param;
					break;
			}
		}

		if($user_id && $this->Auth->user('group') == 0) {
			$this->loadModel('User');
			$user = $this->User->findById($user_id);
			if(!$user) {
				throw new NotFoundException(__('Invalid user'));
			}
			$user = $user['User'];
			$this->set('admin_view', true);
		} else {
			$user = $this->Auth->user();
			$user_id = $user['id'];
		}
		$this->set('user', $user);
		$this->set('totals', $this->User->getTotals($user_id));

		// Get the monthly reports
		$this->set('revenuereport_monthly', $this->User->RevenueReport->getMonthlyReports($user_id));
		$this->set('postreport_monthly', $this->User->Offer->getMonthlyReports($user_id));

		$this->set('offers', $this->User->Offer->find('all', array(
			'fields' => array(
				'Offer.instagram_id',
				'Offer.created',
				'Offer.posted',
				'Offer.offer',
				'Campaign.buy_url',
				'Campaign.caption',
				'Campaign.image',
				'Campaign.id',
				'Offer.id'
			),
			'conditions' => array(
				'User.id'=>$user_id,
				'Offer.accepted'=>1,
				'`Offer`.`instagram_id` IS NOT NULL'
			),
			'limit' => 25,
			'order' => array(
				'Offer.created DESC'
			)
		)));

		// Load the revenue reports for the active user
		$this->set('revenue', $this->User->RevenueReport->find('all', array(
	        'conditions' => array('user_id'=>$user_id),
	        'limit' => 30,
	        'order' => array(
	        	'RevenueReport.process_datetime' => 'desc'
	        ),
	        'recursive' => -1
	    )));
	}

	/**
	 *	Display the current user's Commission information
	 */
	public function revenue_commission($user_id = null) {
		if($user_id && $this->Auth->user('group') == 0) {
			$this->loadModel('User');
			$user = $this->User->findById($user_id);
			if(!$user) {
				throw new NotFoundException(__('Invalid user'));
			}
			$user = $user['User'];
			$this->set('admin_view', true);
		} else {
			$user = $this->Auth->user();
			$user_id = $user['id'];
		}
		$this->set('user', $user);
		
		// Get the monthly reports
		$this->set('monthly', $this->User->RevenueReport->getMonthlyReports($user_id));

		$this->set('revenueReportTotal', $this->User->RevenueReport->find('first', array(
			'fields' => array(
				'SUM(RevenueReport.commission) AS "total"'
			),
	        'conditions' => array('user_id'=>$user_id),
	        'order' => array(
	        	'RevenueReport.process_datetime' => 'desc'
	        )
		)));

		// Load the revenue reports for the active user
		$this->paginate = array(
	        'conditions' => array('user_id'=>$user_id),
	        'limit' => 30,
	        'order' => array(
	        	'RevenueReport.process_datetime' => 'desc'
	        ),
	        'recursive' => -1
	    );
	    $revenue = $this->paginate('User.RevenueReport');
		$this->set('revenueReports', $revenue);

		$this->render('revenue_commission');
	}

	/**
	 *	Grab the current user's post revenue information
	 */
	public function revenue_posts($user_id = null) {
		if($user_id && $this->Auth->user('group') == 0) {
			$this->loadModel('User');
			$user = $this->User->findById($user_id);
			if(!$user) {
				throw new NotFoundException(__('Invalid user'));
			}
			$user = $user['User'];
			$this->set('admin_view', true);
		} else {
			$user = $this->Auth->user();
			$user_id = $user['id'];
		}
		$this->set('user', $user);

		$this->set('monthly', $this->User->Offer->getMonthlyReports($user_id));

		$this->paginate = array(
			'fields' => array(
				'Offer.instagram_id',
				'Offer.created',
				'Offer.posted',
				'Offer.offer',
				'Campaign.buy_url',
				'Campaign.caption',
				'Campaign.image',
				'Campaign.id',
				'Offer.id'
			),
			'conditions' => array(
				'User.id'=>$user_id,
				'Offer.accepted'=>1,
				'`Offer`.`instagram_id` IS NOT NULL'
			),
			'limit' => 25,
			'order' => array(
				'Offer.created DESC'
			)
		);

		$this->set('postTotal', $this->User->Offer->find('first', array(
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
		)));

		$this->set('postreports', $this->Paginate('User.Offer'));

		$this->render('revenue_posts');
	}

	/**
	 * Grab Commission information for the current user from the Rakuten server
	 */
	public function refreshReports() {
		// Disable view rendering
		$this->autoRender = false;

		// Create new reports
		$new_reports = $this->User->RevenueReport->refreshReports($this->Auth->user());
		$this->User->RevenueReport->saveAll($new_reports);
		$this->set('new_reports', $new_reports);
		
		// Redirect to referer
		$this->redirect($this->referer());
	}

	/**
	 *	Payment page
	 */
	public function payment() {
		$user = $this->Auth->user();
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));

		$categories = $this->User->Category->find('list');
		$this->set('categories',$categories);
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 *	
	 */
	public function admin_message($user_id) {
		$user = $this->User->findById($user_id);
		$this->set('user', $user);
		if(!count($user)) {
			throw new NotFoundException('No user by that ID found!');
		}

		if(!empty($this->data)) {
			App::import('Component', 'CakeEmail');
			$email = new CakeEmail('smtp');

			$email->emailFormat('html')
				->to($user['User']['email'])
				->subject('New Message from InstaElite')
				->send($this->request->data['User']['message']);
			$this->Session->setFlash('Your message has been sent!');
			$this->redirect(array('controller'=>'users', 'action'=>'index'));
		} else {
			 // Do nothing
		}
	}
}
