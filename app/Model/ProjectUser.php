<?php
App::uses('AppModel', 'Model');


class ProjectUser extends AppModel {
    public $name = 'ProjectUser';
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id'
            ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
            )
        );
    public $validate = array(
        'user_id' => array('rule' => 'notBlank'),
        'project_id' => array('rule' => 'notBlank'),
        );
}