<?php
App::uses('AppModel', 'Model');

class Detail extends AppModel {
    public $name = 'Detail';
    public $validate = array('name' => array('rule' => 'notBlank'));
}