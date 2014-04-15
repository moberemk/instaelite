<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
				'prefix' => false,
				'admin' => false
			),
			'loginRedirect' => array(
				'controller' => 'users',
				'action' => 'profile',
				'prefix' => false,
				'admin' => false
			),
			'logoutRedirect' => '/',
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'username',
						'password' => 'password'
					)
				)
			)
		)
	);

	public $helpers = array('User');

	public function beforeFilter() {
		// Store a reference to the user (if there is one)
		$user = $this->Auth->user();
		if($user != null) {
			$this->set('activeUser', $user);

			// Get the user's active offer count
			$this->loadModel('Offer');
			$activeOffers = $this->Offer->find('count', array('conditions'=>array('User.id'=>$user['id'], 'accepted'=>NULL)));
			if($activeOffers == 0) {
				$activeOffers = '';
			}
			$this->set('activeUserOffers', $activeOffers);
		}
		$this->set('password', AuthComponent::password('password'));

		// Get the category list
		/*$this->loadModel('Category');
		$this->set('categories', $this->Category->find('list'));*/
	}

	/**
	 *	Check if the user is authorized to perform this action;
	 *	globally this locks non-admins out of admin functions
	 */
	public function isAuthorized($user = null) {
		if(empty($this->request->prefix)) {
			return true;
		} else if($this->request->prefix == 'admin') {
			if($user['group'] == 0) {
				return true;
			}
		}

		return false;
	}

}
