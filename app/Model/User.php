<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');

class User extends AppModel {
	public $name = 'User';

   public $validate = array(
      'email' => array(
        'required' => array(
            'rule' => array('email', true),    
            'message' => 'Veuillez entrer une adresse mail valide'   
            ),
        'unique' => array(
            'rule'    => array('isUnique'),
            'message' => 'Cette adresse mail est déjà utilisée',
            ),
        'between' => array( 
            'rule' => array('between', 6, 255), 
            'message' => 'L\'adresse mail doit être comprise entre 6 et 255 caractères'
            ))
      );
   
   public function beforeSave($options = array()) {
      if (!empty($this->data[$this->alias]['password'])) {
         $passwordHasher = new SimplePasswordHasher();
         $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
            );
     }
     return true;
 }
}