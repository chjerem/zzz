<?php
App::uses('AppModel', 'Model');

class Contact extends AppModel {
    public $name = 'Contact';

    public $belongsTo = 'Request';
}