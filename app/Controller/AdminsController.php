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
				$this->Session->setFlash(__("La couleur a été ajoutée"),'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'colors'));
			}
			$this->Session->setFlash(__("La couleur n'a pas pu être ajoutée"), 'alert-box', array('class' => 'alert-danger'));
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
			$this->Session->setFlash("La couleur n'a pas été éditée",'alert-box', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'colors'));
		}

		$color = $this->Color->findById($id);
		if(!$color) {
			$this->Session->setFlash(__("La couleur n'a pas été éditée"),'alert-box', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'colors'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Color->id = $id;
			if ($this->Color->save($this->request->data)) {
				$this->Session->setFlash(__("La couleur a été éditée"),'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'colorsl'));
			}
			$this->Session->setFlash(__("La couleur n'a pas été éditée"),'alert-box', array('class' => 'alert-danger'));
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
		if ($this->request->is('get')) {
			echo 'lol';
		}

		if ($this->Color->delete($id)) {
			$this->Session->setFlash("La couleur a été supprimée",'alert-box', array('class' => 'alert-success'));
		} else {
			$this->Session->setFlash("La couleur n'a pas été supprimée",'alert-box', array('class' => 'alert-danger'));
		}

		return $this->redirect(array('action' => 'colors'));
	}

	/**
	* View one color at a time, in details
	* @param: id of the color
	*/
	public function viewcolor($id=null) {
		$this->loadModel('Color');
		if (!$id) {
            $this->Session->setFlash("Il n'y a pas d'ID",'alert-box', array('class' => 'alert-danger'));
        }

        $color = $this->Color->findById($id);
        if (!$color) {
            $this->Session->setFlash("La couleur n'existe pas",'alert-box', array('class' => 'alert-danger'));
        }
        $this->set('color', $color);
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
				$this->Session->setFlash(__("Le scope a été ajoutée"),'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'scopes'));
			}
			$this->Session->setFlash(__("La couleur n'a pas pu être ajoutée"), 'alert-box', array('class' => 'alert-danger'));
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
			$this->Session->setFlash("Le scope n'a pas été édité",'alert-box', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'scopes'));
		}

		$scope = $this->Scope->findById($id);
		if(!$scope) {
			$this->Session->setFlash(__("Le scope n'a pas été édité"),'alert-box', array('class' => 'alert-danger'));
			return $this->redirect(array('action' => 'scopes'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Scope->id = $id;
			if ($this->Scope->save($this->request->data)) {
				$this->Session->setFlash(__("Le scope a été édité"),'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__("Le scope n'a pas été éditée"),'alert-box', array('class' => 'alert-danger'));
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
		if ($this->request->is('get')) {
			echo 'lol';
		}

		if ($this->Scope->delete($id)) {
			$this->Session->setFlash("Le scope a été supprimée",'alert-box', array('class' => 'alert-success'));
		} else {
			$this->Session->setFlash("Le scope n'a pas été supprimée",'alert-box', array('class' => 'alert-danger'));
		}

		return $this->redirect(array('action' => 'scopes'));
	}

	public function viewscope($id=null) {
		$this->loadModel('Scope');
		if (!$id) {
            $this->Session->setFlash("Il n'y a pas d'ID",'alert-box', array('class' => 'alert-danger'));
        }

        $scope = $this->Scope->findById($id);
        if (!$scope) {
            $this->Session->setFlash("Le scope n'existe pas",'alert-box', array('class' => 'alert-danger'));
        }
        $this->set('scope', $scope);
	}

}