<?php
class RequestsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function add() {
		if($this->request->is('post')) {
			$this->Request->create();

			//Get things right before saving
			$this->request->data['Request']['user_id'] = $this->Session->read('Auth.User.id');
			$this->request->data['Request']['color_id'] = $this->request->data['Color']['id'];
			$this->request->data['Request']['scope_id'] = $this->request->data['Scope']['id'];
			$this->request->data['Request']['detail_id'] = $this->request->data['Detail']['id'];
			$this->request->data['Request']['is_assigned'] = 0;
			$this->request->data['Request']['is_closed'] = 0;
			$this->request->data['Request']['is_blocked'] = 0;
			$this->request->data['Request']['was_blocked'] = 0;
			$this->request->data['Request']['creationDate'] = date('Y-m-d', time());
			$this->request->data['Request']['lastModified'] = date('Y-m-d', time());

			//Formatting dates before saving
			if(strrpos($this->request->data['Request']['onlinedate'],'/')) { 
				$onlineDate = explode('/',$this->request->data['Request']['onlinedate']);
				$onlineDate = $onlineDate[2].'-'.$onlineDate[0].'-'.$onlineDate[1];
				$this->request->data['Request']['onlineDate'] = $onlineDate;
			}

			if(strrpos($this->request->data['Request']['testdate'],'/')) {
				$testDate = explode('/',$this->request->data['Request']['testdate']);
				$testDate = $testDate[2].'-'.$testDate[0].'-'.$testDate[1];
				$this->request->data['Request']['testDate'] = $testDate;
			}

			//Cleaning up
			unset($this->request->data['Color']);
			unset($this->request->data['Scope']);
			unset($this->request->data['Detail']);
			unset($this->request->data['Request']['testdate']);
			unset($this->request->data['Request']['onlinedate']);

			//Upload file if there is any file
			//First, we check if there is a file...
			if($this->request->data['File']['upload'][0]['name'] == null) {
				unset($this->request->data['File']);
			}

			if(isset($this->request->data['File'])) {
				foreach($this->request->data['File'] as $files) {
					$folder = intval('0'.rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9));
					$folder = $folder*time();
					$folder = 'files/requests/'.$folder.'/';
					foreach($files as $file) {

						//Create the folder
						if(!file_exists($folder)) {
							mkdir($folder, 0777, true);
						}

						$filename = basename($file['name']);
						$sizemax = 10000000;
						$actualsize = filesize($file['tmp_name']);
						$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.zip', '.pdf', '.txt', '.ppt', '.pptx');
						$extension = strrchr($file['name'], '.'); 
						//Secure the uploads
						//Verify if extension is OK
						if(!in_array($extension, $extensions)) {
							$error = 'L\'extension n\'est pas bonne...';
						}
						if($actualsize>$sizemax) {
							$error = 'Le fichier est trop gros...';
						}

						if(!isset($error)) {
							//if no security error, let's upload
							//First, be sure to have a correct filename
							$filename = strtr($filename, array('é' => 'e'));
							$filename = strtr($filename, array('è' => 'e'));
							$filename = strtr($filename, array('ë' => 'e'));
							$filename = strtr($filename, array('ê' => 'e'));
							$filename = strtr($filename, array('à' => 'a'));
							$filename = preg_replace('/([^.a-z0-9]+)/i', '-', $filename);

							if(move_uploaded_file($file['tmp_name'], $folder . $filename)) {
								//OK :) :) :)
							} else {
								//If saving is not working...
								$this->Session->setFlash("Il y a eu un soucis lors de l'enregistrement de la demande :'(", 'alert-danger');
								return $this->redirect(array('action' => 'index'));
							}
						} else {
							$this->Session->setFlash($error, 'alert-danger');
							return $this->redirect(array('action' => 'index'));
						}
						$this->request->data['Files'][] = array(
							'name' => $filename,
							'path' => $folder,
							'size' => $actualsize
							);
					}
				}
			}
			$this->Session->setFlash("Demande prise en compte", 'alert-success');
			unset($this->request->data['File']);
			$this->Request->saveAssociated($this->request->data);
		}



		$this->set('title', "Poser une demande");

		//LOADING MODELS (+ vars with datas)
		//Scope model already loaded in AppController
		$scopes =  $this->Scope->find('all');
		$scopeoption = array();
		foreach($scopes as $scope) {
			$scopeoption[$scope['Scope']['id']] = $scope['Scope']['name'];
		}
		$this->set('scopeoption', $scopeoption);

		$this->loadModel('Color');
		$colors = $this->Color->find('all');
		$coloroption = array();
		foreach($colors as $color) {
			$coloroption[$color['Color']['id']] = $color['Color']['name'];
		}
		$this->set('coloroption', $coloroption);

		$this->loadModel('Type');
		$types = $this->Type->find('all');
		$typeoption = array();
		foreach($types as $type) {
			$typeoption[$type['Type']['id']] = $type['Type']['name'];
		}
		$this->set('typeoption', $typeoption);

		$this->loadModel('Detail');
		$details =  $this->Detail->find('all');
		$detailoption = array();
		foreach($details as $detail) {
			$detailoption[$detail['Detail']['id']] = $detail['Detail']['name'];
		}
		$this->set('detailoption', $detailoption);
	}

	public function edit($id=null) {
		if(!$id) {
			$this->Session->setFlash("L'id n'existe pas", 'alert-danger');
			return $this->redirect(array('action' => 'index'));
		}

		$request = $this->Request->findById($id);
		if(!$request) {
			$this->Session->setFlash(__("La demande n'existe pas"), 'alert-danger');
			return $this->redirect(array('action' => 'index'));
		}

		if (!$this->request->data) {
			$this->set('title', "Poser une demande");

			//LOADING MODELS (+ vars with datas)
			//Scope model already loaded in AppController
			$scopes =  $this->Scope->find('all');
			$scopeoption = array();
			foreach($scopes as $scope) {
				$scopeoption[$scope['Scope']['id']] = $scope['Scope']['name'];
			}
			$this->set('scopeoption', $scopeoption);

			$this->loadModel('Color');
			$colors = $this->Color->find('all');
			$coloroption = array();
			foreach($colors as $color) {
				$coloroption[$color['Color']['id']] = $color['Color']['name'];
			}
			$this->set('coloroption', $coloroption);

			$this->loadModel('Type');
			$types = $this->Type->find('all');
			$typeoption = array();
			foreach($types as $type) {
				$typeoption[$type['Type']['id']] = $type['Type']['name'];
			}
			$this->set('typeoption', $typeoption);

			$this->loadModel('Detail');
			$details =  $this->Detail->find('all');
			$detailoption = array();
			foreach($details as $detail) {
				$detailoption[$detail['Detail']['id']] = $detail['Detail']['name'];
			}
			$this->set('detailoption', $detailoption);
			
			$this->request->data = $request;
		}
	}
}