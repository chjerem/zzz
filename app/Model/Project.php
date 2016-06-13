<?php
App::uses('AppModel', 'Model');

class Project extends AppModel {
    public $name = 'Project';
    public $hasAndBelongsToMany = array(
        'Requests' =>
            array(
                'className' => 'Request',
                'joinTable' => 'projects_requests',
                'foreignKey' => 'project_id',
                'associationForeignKey' => 'request_id',
                'unique' => false,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => ''
            )
    );
}