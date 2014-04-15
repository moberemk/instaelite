<?php
App::uses('AppController', 'Controller');
/**
 * Offers Controller
 *
 * @property Offer $Offer
 */
class OffersController extends AppController {
	public $helpers = array('User');

	public function before_filter() {
		$this->Auth->deny('index','view');

		// Call parent function's before_filter
		Parent::before_filter();
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index($id=null) {
		if($id && $this->Auth->user('group') == 0) {
			$this->loadModel('User');
			$user = $this->User->findById($id);
			if(!$user) {
				throw new NotFoundException(__('Invalid user'));
			}
			$user = $user['User'];
		} else {
			$user = $this->Auth->user();
		}
		$this->paginate = array(
			'conditions' => array('Offer.user_id'=>$user['id']));
		$this->set('archivedOffers', $this->paginate());
		$this->set('offers', $this->Offer->find('all', array(
			'conditions' => array(
				'User.id' => $user['id'],
				'OR' => array(
					'Offer.accepted' => null,
					'AND' => array('Offer.accepted' => true, 'Offer.instagram_id' => null)
				)
			)
		)));
	}

	/**
	 *	Accept/Reject an offer
	 */
	public function accept($offer_id) {
		$offer = $this->Offer->findById($offer_id);
		if(count($offer)) {
			$offer['Offer']['accepted'] = true;
			if($this->Offer->save($offer['Offer'])) {
				$this->Session->setFlash('Offer accepted!');
			}
		}
		$this->redirect($this->referer());
	}
	public function reject($offer_id) {
		$offer = $this->Offer->findById($offer_id);
		if(count($offer)) {
			$offer['Offer']['accepted'] = false;
			if($this->Offer->save($offer['Offer'])) {
				$this->Session->setFlash('Sorry you did not like the offer, how could we make offers better? Please <a href="/pages/contact">give us feedback</a>.');
			}
		}
		$this->redirect($this->referer());
	}
	/**
	 *	Checks if this offer can be rejected by this user
	 */
	private function user_offer($offer) {

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Offer->exists($id)) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$options = array('conditions' => array('Offer.' . $this->Offer->primaryKey => $id));
		$this->set('offer', $this->Offer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Offer->create();
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
			}
		}
		$campaigns = $this->Offer->Campaign->find('list');
		$users = $this->Offer->User->find('list');
		$this->set(compact('campaigns', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function addURL($id) {
		$offer = $this->Offer->find('first', array('conditions'=>array('Offer.id'=>$id)));
		if(!count($offer)) {
			throw new NotFoundException(__('Invalid offer'));
		}

		if($offer['Offer']['user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash('Error: attempting to modify an offer that does not belong to you.');
		} else {
			if($this->Offer->save($this->request->data)) {
				$this->Session->setFlash('Successfully submitted the URL!');
			} else {
				$this->Session->setFlash('Problem saving this URL; check that you are using the right Instagram link.');

			}
		}
		$this->redirect($this->referer());
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Offer->delete()) {
			$this->Session->setFlash(__('Offer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Offer->recursive = 0;
		$this->set('offers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Offer->exists($id)) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$options = array('conditions' => array('Offer.' . $this->Offer->primaryKey => $id));
		$this->set('offer', $this->Offer->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$users = $this->request->data['Offer']['user_id'];
			foreach($users as $user) {
				$data['Offer']['user_id'] = $user;
				$this->Offer->create();
				if ($this->Offer->save($data)) {
					$this->Session->setFlash(__('The offers have been sent'));
				} else {
					$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
				}	
			}
			$this->redirect(array('action' => 'index'));			
		}
		$campaigns = $this->Offer->Campaign->find('list');
		$users = $this->Offer->User->find('list');
		$this->set(compact('campaigns', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Offer->exists($id)) {
			throw new NotFoundException(__('Invalid offer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Offer.' . $this->Offer->primaryKey => $id));
			$this->request->data = $this->Offer->find('first', $options);
		}
		$campaigns = $this->Offer->Campaign->find('list');
		$users = $this->Offer->User->find('list');
		$this->set(compact('campaigns', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Offer->delete()) {
			$this->Session->setFlash(__('Offer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
