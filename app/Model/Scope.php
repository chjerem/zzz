<?php
App::uses('AppModel', 'Model');

class Scope extends AppModel {
    public $name = 'Scope';
    public $validate = array('name' => array('rule' => 'notBlank'));
}