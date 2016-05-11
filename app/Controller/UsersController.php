<?php
class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
	}

	public function index() {
		$users = $this->User->findById($this->Session->read('Auth.User.id'));
		parent::debug($users);
	}

	public function test() {
		$users = $this->User->find('all');
		parent::debug($users);
	}

	public function login() {
		if(!empty($this->request->is('post'))) {
			if($this->Auth->login()) {
				//Ecrire ce qu'il manque dans la session
			} else {
				//setFlash
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
		}
	}

	public function logout() {
		if(!$this->User->exists($this->Session->read('Auth.User.id'))) {
			//setFlash
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		} else {
			$this->redirect($this->Auth->logout());
			//Détruire les sessions si logout ne le fait pas :)
		}
	}
}