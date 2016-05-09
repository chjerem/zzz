<?php
class UsersController extends AppController {
	public function admin_index() {
		echo 'lol';
	}

	public function index() {
		echo 'mdr';
	}

	public function login() {
		if(!empty($this->request->is('post'))) {
			if($this->Auth->login()) {
				parent::debug('bravo');
				exit;
			}
			parent::debug($this->request->data);
			exit;
		}
	}

	public function logout() {

	}
}