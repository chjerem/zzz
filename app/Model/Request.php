<?php
App::uses('AppModel', 'Model');

class Request extends AppModel {
	public $name = 'Request';
	/*public $hasAndBelongsToMany = array(
		'Projects' => array(
			'className' => 'Project',
			'joinTable' => 'projects_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'project_id',
			'unique' => false
			)
		);*/

	public $belongsTo = array(
		'ScopeTo' => array('className' => 'Scope', 'foreignKey' => 'scope_id'),
		'ColorIs' => array('className' => 'Color', 'foreignKey' => 'color_id'),
		'TypeIs' => array('className' => 'Type', 'foreignKey' => 'type_id'),
		'Asker' => array('className' => 'User', 'foreignKey' => 'user_id')
		);
}
