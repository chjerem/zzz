<?php
App::uses('AppController', 'Controller');

class AdminsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->layout = 'back'; //Charge le layout back
		//Si l'utilisateur n'est pas ZZZ, redirection sur la HP
		if ($this->name == 'Admins' && !$this->Session->read('Auth.User.isZZZ')) {
			$this->redirect(array('controller' => 'home', 'action' => 'index'));
		}
	}

	public function index() {
	}

	/*****************************************************
	******************************************************
	*************************CRUD*************************
	******************************************************
	*****************************************************/

	/******************
	*******COLORS******
	******************/

	/**
	* Add a color (Orange, Sosh, ...)
	**/
	public function addcolor() {
		$this->loadModel('Color');
		if($this->request->is('post')) {
			$this->Color->create();
			if ($this->Color->save($this->request->data)) {
				$this->Session->setFlash(__("La couleur a été ajoutée :)"),'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'colors'));
			}
			$this->Session->setFlash(__("La couleur n'a pas pu être ajoutée :("), 'alert-box', array('class' => 'alert-danger'));
		}
	}

	/**
	* View all colors 
	**/
	public function colors() {
		$this->loadModel('Color');
		$colors = $this->Color->find('all');
		$this->set('colors', $colors);
	}

	/**
	* Edit a color
	* @param: id
	**/
	public function editcolor($id=null) {
		if(!$id) {

		}
	}

	/**
	* Delete a color
	**/
	public function deletecolor($id=null) {

	}

}
