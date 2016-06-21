<?php
class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'test');-
		$this->Auth->deny('login');
	}

	public function index() {
		$users = $this->User->findById($this->Session->read('Auth.User.id'));
		parent::debug($users);
	}

	public function test() {
		/*$this->loadModel('Request');
		$requests = $this->Request->find('all');
		parent::debug($requests);
		exit;*/
		//$this->Request
		$this->loadModel('Contact');
		$contacts = $this->Contact->find('all');
		parent::debug($contacts);
		exit;
	}

	public function login() {
		if(!empty($this->request->is('post'))) {
			if($this->Auth->login()) {
				//Ecrire ce qu'il manque dans la session
				$this->redirect(array('controller' => 'admins', 'action' => 'index'));
			} else {
				//setFlash
				$this->redirect(array('controller' => 'home', 'action' => 'index'));
			}
		}
	}

	public function logout() {
		if(!$this->User->exists($this->Session->read('Auth.User.id'))) {
			//setFlash
			$this->redirect(array('controller' => 'home', 'action' => 'index'));
		} else {
			$this->Auth->logout();
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
			//Détruire les sessions si logout ne le fait pas :)
		}
	}
}