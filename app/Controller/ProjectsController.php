<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ProjectsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();

		//Si l'utilisateur n'est pas ZZZ, redirection sur la HP
		if ($this->name == 'Projects' && !$this->Session->read('Auth.User.is_zzz')) {
			$this->redirect(array('controller' => 'home', 'action' => 'index'));
		}

		//On charge le Model dont on aura toujours besoin à priori
		$this->loadModel('Request');

		$this->set('where', 'Projects');
	}

	public function index() {
		$requests = $this->Request->find('all');
		$this->set('requests', $requests);
	}

	public function delete($id=null) {
		//Suppression des fichiers associés et du dossier (s'il existe)
		$request = $this->Request->findById($id);

		if(!empty($request['Files'])) {
			$dir = $request['Files'][0]['path'];
			$files = glob($dir.'*');
			foreach($files as $file) {
				if(is_file($file))
					unlink($file);
			}
			if(is_dir($dir)) {
				rmdir($dir);
			}
		}
		if ($this->Request->delete($id)) {
			$this->Session->setFlash("La demande a été supprimée", 'alert-success');
		} else {
			$this->Session->setFlash("La demande n'a pas été supprimée", 'alert-danger');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function view($id=null) {
		if(!$id) {
			//Faire setFlash
		}

		$request = $this->Request->findById($id);
		if(!$request) {
			//Faire setFlash
		}

		if($this->request->is('post')) {
//			$this->loadModel('Refusals');
			$this->loadModel('Changes');
			if(!empty($this->request->data['Treatment'])) {
				switch($this->request->data['Treatment']['status']) {
					case 1: //Demande nouvelle
					echo 'mdr';
					break;

					case 2: //Demande en cours de traitement
					//Ici on ne peut traiter qu'un blocage de request
					$this->request->data['Changes']['request_id'] = $id;
					$this->request->data['Changes']['is_zzz'] = 1;
					$this->request->data['Changes']['date'] = date('Y-m-d', time());
					$this->Request->id = $id;
					if($this->Changes->save($this->request->data['Changes']) && $this->Request->saveField('is_blocked', 1)) {
						$this->Session->setFlash("La demande a été bloquée", 'alert-success');
					} else {
						$this->Session->setFlash("La demande n'a pas été bloquée", 'alert-danger');
					}
					return $this->redirect(array('action' => 'index'));
					break;

					default:
					echo 'oops';
					break;
				}
			}
			exit;
		}

		//Check if the request was refused at least once
	/*	if(!empty($request['Refusals'])) {
			$refusals = $request['Refusals'];
			$this->set('refusals', $refusals);		
		}*/

		//Check if the request was reopened at least once
		if(!empty($request['Changes'])) {
			$changes = $request['Changes'];
			//Sort array by dates with the magical usort function :-) :-)
			usort($changes, function($a1, $a2) {
				$v1 = strtotime($a1['date']);
				$v2 = strtotime($a2['date']);
				return $v1 - $v2;
			});
			$this->set('changes', $changes);
		}

		$this->loadModel('User');
		$users2 = $this->User->findAllByIsZzz(1);
		$zzz = array();
		foreach($users2 as $users) {
			foreach($users as $user) {
				$zzz[$user['id']] = $user['email'];
			}
		}

		$this->set('request', $request);
		$this->set('assignedto', $request['AssignedTo']);
		$this->set('idrequest', $request['Request']['id']);
		$this->set('is_blocked', $request['Request']['is_blocked']);
		$this->set('was_blocked', $request['Request']['was_blocked']);
		$this->set('is_closed', $request['Request']['is_closed']);
		$this->set('is_assigned', $request['Request']['is_assigned']);
		$this->set('creationDate', $request['Request']['creationDate']);
		$this->set('lastModified', $request['Request']['lastModified']);
		$this->set('zzz', $zzz);
	}

	public function download($id = null) {
		$this->autoRender = false;
		$this->loadModel('FileUpload');

		if(!$id) {
			//setflash
		}

		$file = $this->FileUpload->findById($id);

		if(!$file) {
			//setflash
		}

		//Je ne sais plus à quoi sert la ligne ci dessous......
		//$this->response->file('webroot'.DS.$file['FileUpload']['path'].$file['FileUpload']['name'], array('download' => true));
		//Somehow, it works well :| Mais je comprends pas pourquoi, merci StackOverflow & CakePHP
		$this->response->download($file['FileUpload']['name']);

		return $this->response;
	}

	public function reopen($id = null) {
		$this->autoRender = false;
		$this->loadModel('RequestUser');
		if(!$id) {
			//setflash
		}

		$request = $this->Request->findById($id);
		if(!$request) {
			//setflash
		}

		$request = $this->Request->read(null, $id);
		$requesttosave = $request['Request'];
		unset($request);

		//Array of things to update
		$requesttosave['is_closed'] = 0;
		$requesttosave['is_blocked'] = 0;
		$requesttosave['is_assigned'] = 0;

		//Array of ids from RequestUser to delete
		$ids =  array();
		$requestusers = $this->RequestUser->findAllByRequestId($id);
		foreach($requestusers as $entry) {
			$ids[] = $entry['RequestUser']['id'];
		}

		//Preparing to delete...
		$condition = array('RequestUser.id in' => $ids);

		if($this->Request->save($requesttosave) && (empty($ids) || $this->RequestUser->deleteAll($condition, false))) {
			$this->Session->setFlash("La demande a été réouverte", 'alert-success');
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash("La demande n'a pas été réouverte...", 'alert-danger');
			return $this->redirect(array('action' => 'index'));
		}

		/* SI ON VEUT, APRES UNE REOUVERTURE DE DEMANDE, N'AVOIR QU'UNE DEMANDE EN TRAITEMENT AU LIEU D'UNE DEMANDE OUVERTE
		if($this->Request->save($requesttosave)) {
			$this->Session->setFlash("La demande a été réouverte", 'alert-success');
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash("La demande n'a pas été réouverte...", 'alert-danger');
			return $this->redirect(array('action' => 'index'));
		}
		*/

	}

	public function close($id = null) {
		$this->autoRender = false;
		if(!$id) {
			//setflash
		}

		$request = $this->Request->findById($id);
		if(!$request) {
			//setflash
		}

		$this->Request->id = $request['Request']['id'];
		if($this->Request->saveField('is_closed', 1)) {
			$this->Session->setFlash("La demande a été fermée", 'alert-success');
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash("La demande n'a pas été fermée...", 'alert-danger');
			return $this->redirect(array('action' => 'index'));
		}
	}
}