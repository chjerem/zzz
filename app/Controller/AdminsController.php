<?php
App::uses('AppController', 'Controller');

class AdminsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'back'; //Charge le layout back
		//Si l'utilisateur n'est pas admin, Redirection sur la Home
		if ($this->name == 'Admins' && !$this->Session->read('Auth.User.isAdmin')) {
			$this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
	}

	public function index() {
		parent::debug('Helloooo');
	}
}
