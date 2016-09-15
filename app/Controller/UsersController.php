<?php
class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'add');
	}

	public function index() {
		$users = $this->User->findById($this->Session->read('Auth.User.id'));
		parent::debug($users);
	}

	public function add() {
		$this->loadModel('Scope');
		$this->set('scopes', $this->Scope->find('all'));
		$scopes = $this->Scope->find('all');
		$scopeoption = array();
		foreach($scopes as $scope) {
			$scopeoption[$scope['Scope']['id']] = $scope['Scope']['name'];
		}

		$this->set('scopeoption', $scopeoption);

		if($this->request->is('post')) {
			$this->User->create();
			if($this->request->data['User']['password'] === $this->request->data['User']['passwordconfirm']) {
				$this->request->data['User']['isZZZ'] = 0;
				if($this->User->save($this->request->data)) {
					$this->Session->setFlash(__("Votre compte a été créé ! Merci de consulter votre boite mail."), 'alert-success');
					return $this->redirect(array('action' => 'login'));
				} else {
					$this->Session->setFlash(__("Erreur survenue"), 'alert-danger');
					return $this->redirect(array('action' => 'add'));
				}
			} else {
				$this->Session->setFlash(__("Les passwords ne correspondent pas..."), 'alert-danger');
				return $this->redirect(array('action' => 'add'));
			}
		}
	}

	public function login() {
		if(!empty($this->request->is('post'))) {
			if($this->Auth->login()) {
				//Ecrire ce qu'il manque dans la session
				$this->redirect(array('controller' => 'admins', 'action' => 'index'));
			} else {
				//setFlash
				$this->redirect(array('action' => 'login'));
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