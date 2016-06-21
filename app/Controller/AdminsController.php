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

		$this->set('where', 'Admins');
	}

	public function index() {
		$aCtrlClasses = App::objects('controller');

		foreach ($aCtrlClasses as $controller) {
			if ($controller == 'AdminsController') {
                // Load the controller
				App::import('Controller', str_replace('Controller', '', $controller));

                // Load its methods / actions
				$aMethods = get_class_methods($controller);

				foreach ($aMethods as $idx => $method) {

					if ($method{0} == '_') {
						unset($aMethods[$idx]);
					}
				}

                // Load the ApplicationController (if there is one)
				App::import('Controller', 'AppController');
				$parentActions = get_class_methods('AppController');

				$controllers[$controller] = array_diff($aMethods, $parentActions);
			}
		}

		$this->set('controllers', $controllers);
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
				$this->Session->setFlash(__("La couleur a été ajoutée"), 'alert-success');
				return $this->redirect(array('action' => 'colors'));
			}
			$this->Session->setFlash(__("La couleur n'a pas pu être ajoutée"), 'alert-danger');
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
	* @param: id of the edited color
	**/
	public function editcolor($id=null) {
		$this->loadModel('Color');
		if(!$id) {
			$this->Session->setFlash("La couleur n'a pas été éditée", 'alert-danger');
			return $this->redirect(array('action' => 'colors'));
		}

		$color = $this->Color->findById($id);
		if(!$color) {
			$this->Session->setFlash(__("La couleur n'a pas été éditée"), 'alert-danger');
			return $this->redirect(array('action' => 'colors'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Color->id = $id;
			if ($this->Color->save($this->request->data)) {
				$this->Session->setFlash(__("La couleur a été éditée"), 'alert-success');
				return $this->redirect(array('action' => 'colors'));
			}
			$this->Session->setFlash(__("La couleur n'a pas été éditée"), 'alert-danger');
			return $this->redirect(array('action' => 'editcolor'));
		}

		if (!$this->request->data) {
			$this->request->data = $color;
		}
	}

	/**
	* Delete a color
	**/
	public function deletecolor($id=null) {
		$this->loadModel('Color');
		if ($this->Color->delete($id)) {
			$this->Session->setFlash("La couleur a été supprimée", 'alert-success');
		} else {
			$this->Session->setFlash("La couleur n'a pas été supprimée", 'alert-danger');
		}

		return $this->redirect(array('action' => 'colors'));
	}

	/******************
	*******SCOPES******
	******************/

	/**
	* Add a scope (Assistance, Espace Client, Shop, ...)
	**/
	public function addscope() {
		$this->loadModel('Scope');
		if($this->request->is('post')) {
			$this->Scope->create();
			if ($this->Scope->save($this->request->data)) {
				$this->Session->setFlash(__("Le scope a été ajouté"), 'alert-success');
				return $this->redirect(array('action' => 'scopes'));
			}
			$this->Session->setFlash(__("Le scope n'a pas pu être ajouté"), 'alert-danger');
		}
	}

	/**
	* View all scopes 
	**/
	public function scopes() {
		$this->loadModel('Scope');
		$scopes = $this->Scope->find('all');
		$this->set('scopes', $scopes);
	}

	/**
	* Edit a scope
	* @param: id of the edited scope
	**/
	public function editscope($id=null) {
		$this->loadModel('Scope');
		if(!$id) {
			$this->Session->setFlash("Le scope n'a pas été édité", 'alert-danger');
			return $this->redirect(array('action' => 'scopes'));
		}

		$scope = $this->Scope->findById($id);
		if(!$scope) {
			$this->Session->setFlash(__("Le scope n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'scopes'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Scope->id = $id;
			if ($this->Scope->save($this->request->data)) {
				$this->Session->setFlash(__("Le scope a été édité"), 'alert-success');
				return $this->redirect(array('action' => 'scopes'));
			}
			$this->Session->setFlash(__("Le scope n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'editscope'));
		}

		if (!$this->request->data) {
			$this->request->data = $scope;
		}
	}

	/**
	* Delete a scope
	**/
	public function deletescope($id=null) {
		$this->loadModel('Scope');
		if ($this->Scope->delete($id)) {
			$this->Session->setFlash("Le scope a été supprimé", 'alert-success');
		} else {
			$this->Session->setFlash("Le scope n'a pas été supprimé", 'alert-danger');
		}

		return $this->redirect(array('action' => 'scopes'));
	}

	/****************
	******TYPES******
	*****************/

	/**
	* Add a type (Run, Build, ...)
	**/
	public function addtype() {
		$this->loadModel('Type');
		if($this->request->is('post')) {
			$this->Type->create();
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__("Le type a été ajouté"), 'alert-success');
				return $this->redirect(array('action' => 'types'));
			}
			$this->Session->setFlash(__("Le type n'a pas pu être ajouté"), 'alert-danger');
		}
	}

	/**
	* View all types 
	**/
	public function types() {
		$this->loadModel('Type');
		$types = $this->Type->find('all');
		$this->set('types', $types);
	}

	/**
	* Edit a type
	* @param: id of the edited type
	**/
	public function edittype($id=null) {
		$this->loadModel('Type');
		if(!$id) {
			$this->Session->setFlash("Le type n'a pas été édité", 'alert-danger');
			return $this->redirect(array('action' => 'types'));
		}

		$type = $this->Type->findById($id);
		if(!$type) {
			$this->Session->setFlash(__("Le type n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'types'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Type->id = $id;
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__("Le type a été édité"), 'alert-success');
				return $this->redirect(array('action' => 'types'));
			}
			$this->Session->setFlash(__("Le type n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'edittype'));
		}

		if (!$this->request->data) {
			$this->request->data = $type;
		}
	}

	/**
	* Delete a type
	**/
	public function deletetype($id=null) {
		$this->loadModel('Type');
		if ($this->Type->delete($id)) {
			$this->Session->setFlash("Le type a été supprimé",'alert-box', 'alert-success');
		} else {
			$this->Session->setFlash("Le type n'a pas été supprimé", 'alert-danger');
		}

		return $this->redirect(array('action' => 'types'));
	}

	/******************
	******DETAILS******
	******************/

	/**
	* Add a detail (Analyse, Recette,...)
	**/
	public function adddetail() {
		$this->loadModel('Detail');
		if($this->request->is('post')) {
			$this->Detail->create();
			if ($this->Detail->save($this->request->data)) {
				$this->Session->setFlash(__("Le détail de la demande a été ajouté"), 'alert-success');
				return $this->redirect(array('action' => 'details'));
			}
			$this->Session->setFlash(__("Le type n'a pas pu être ajouté"), 'alert-danger');
		}
	}

	/**
	* View all details 
	**/
	public function details() {
		$this->loadModel('Detail');
		$details = $this->Detail->find('all');
		$this->set('details', $details);
	}

	/**
	* Edit a detail
	* @param: id of the edited detail
	**/
	public function editdetail($id=null) {
		$this->loadModel('Detail');
		if(!$id) {
			$this->Session->setFlash("Le détail n'a pas été édité", 'alert-danger');
			return $this->redirect(array('action' => 'details'));
		}

		$detail = $this->Detail->findById($id);
		if(!$detail) {
			$this->Session->setFlash(__("Le detail n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'details'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Detail->id = $id;
			if ($this->Detail->save($this->request->data)) {
				$this->Session->setFlash(__("Le detail a été édité"), 'alert-success');
				return $this->redirect(array('action' => 'details'));
			}
			$this->Session->setFlash(__("Le detail n'a pas été édité"), 'alert-danger');
			return $this->redirect(array('action' => 'editdetail'));
		}

		if (!$this->request->data) {
			$this->request->data = $detail;
		}
	}

	/**
	* Delete a detail
	**/
	public function deletedetail($id=null) {
		$this->loadModel('Detail');
		if ($this->Detail->delete($id)) {
			$this->Session->setFlash("Le détail a été supprimé", 'alert-success');
		} else {
			$this->Session->setFlash("Le détail n'a pas été supprimé", 'alert-danger');
		}

		return $this->redirect(array('action' => 'details'));
	}

}