<?php
App::uses('AppModel', 'Model');

class Request extends AppModel {
	public $name = 'Request';

	public $belongsTo = array(
		'ScopeTo' => array('className' => 'Scope', 'foreignKey' => 'scope_id'),
		'ColorIs' => array('className' => 'Color', 'foreignKey' => 'color_id'),
		'DetailsAre' => array('className' => 'Detail', 'foreignKey' => 'detail_id'),
		'Asker' => array('className' => 'User', 'foreignKey' => 'user_id')
		);

	public $hasMany = array(
		'Contacts' => array(
			'className' => 'Contact',
			'foreignKey' => 'request_id'
			),
		'Files' => array(
			'className' => 'FileUpload',
			'foreignKey' => 'request_id'
			),
		'Refusals' => array(
			'className' => 'Refusal',
			'foreignKey' => 'request_id',
			'dependent' => true
			),
		'Changes' => array(
			'className' => 'Change',
			'foreignKey' => 'request_id',
			'dependent' => true
			)
		);

	public $hasAndBelongsToMany = array(
		'AssignedTo' => array(
			'className' => 'User',
			'joinTable' => 'requests_users',
			'foreignKey' => 'request_id',
			'associationForeignKey' => 'user_id',
			'unique' => false
			),
		'TypeIs' => array(
			'className' => 'Type',
			'joinTable' => 'requests_types',
			'foreignKey' => 'request_id',
			'associationForeignKey' => 'type_id',
			'unique' => true
			)
		);

}