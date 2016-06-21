<?php
App::uses('AppModel', 'Model');

class Type extends AppModel {
    public $name = 'Type';
    public $validate = array('name' => array('rule' => 'notBlank'));
}