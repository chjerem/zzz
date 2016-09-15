<?php
App::uses('AppModel', 'Model');

class RequestUser extends AppModel {
    public $name = 'RequestUser';
    public $useTable = 'requests_users';
}