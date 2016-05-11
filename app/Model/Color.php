<?php
App::uses('AppModel', 'Model');

class Color extends AppModel {
    public $name = 'Color';
    public $validate = array('name' => array('rule' => 'notBlank'));
}