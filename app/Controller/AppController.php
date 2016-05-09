<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'DebugKit.Toolbar',
		'Security' => array('csrfUseOnce' => false),
		'Session',
		'Flash',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'home',
				'action' => 'index'
				),
			'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
			'authError' => 'Vous n\'êtes pas autorisé à visionner cette page.',
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
                        'username' => 'email', //Default is 'username' in the userModel
                        'password' => 'password'  //Default is 'password' in the userModel
                        )
					)
				)
			)
		);

	public function beforeFilter() {
		$this->layout = 'front';
	}

	public function isAuthorized() {
		return true;
	}
	//Utiliser isAuthorized() dans les AUTRES Controller (par ex : Users les méthodes admin_ ;)) pour les pages admin
}
