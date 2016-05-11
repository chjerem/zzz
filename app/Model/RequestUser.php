<?php
App::uses('AppModel', 'Model');


class RequestUser extends AppModel {
    public $name = 'RequestUser';
    public $belongsTo = array(
        'Request' => array(
            'className' => 'Request',
            'foreignKey' => 'request_id'
            ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
            )
        );
    public $validate = array(
        'user_id' => array('rule' => 'notBlank'),
        'request_id' => array('rule' => 'notBlank'),
        );
}