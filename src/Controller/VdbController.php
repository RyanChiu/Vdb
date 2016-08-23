<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Account;

class VdbController extends AppController {
	public function initialize()
	{
		parent::initialize();
		// Always enable the CSRF component.
		$this->loadComponent('Csrf');
		$this->loadComponent('Auth', [
			'authenticate' => [
				'Form' => [
					'userModel' => 'Accounts',
					'fields' => ['username' => 'email', 'password' => 'pwd']
				]
			],
			'Basic' => ['userModel' => 'Accounts'],
			'loginRedirect' => [
				'controller' => 'Vdb',
				'action' => 'index'
			],
			'logoutRedirect' => [
				'controller' => 'Vdb',
				'action' => 'index',
				'home'
			]
		]);
		$this->loadComponent('Flash');
		
		$this->Accounts = TableRegistry::get('Accounts');
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'login', 'register']);
	}
	
    public function index() {
    	
    }
    
    public function login() {
    	// load the Captcha component and set its parameter
    	$this->loadComponent('CakeCaptcha.Captcha', [
			'captchaConfig' => 'LoginCaptcha'
    	]);
    	
    	if ($this->request->is('post')) {
    		$Account = $this->Auth->identify();
    		if ($Account) {
    			$this->Flash->success('logged in!');
    			$this->Auth->setUser($Account);
    			return $this->redirect($this->Auth->redirectUrl());
    		} else {
    			$this->Flash->error('Invalid username or password, please try again' . ' | ' . print_r($Account, true));
    		}
    	}
    }
    
    public function logout()
    {
    	return $this->redirect($this->Auth->logout());
    }
    
    public function register() {
    	$Account = new Account;
    	if ($this->request->is('post')) {
    		$Account = $this->Accounts->patchEntity($Account, $this->request->data);
    		if ($this->Accounts->save($Account)) {
    			$this->Flash->success('Registered!');
    			return $this->redirect(['action' => 'register']);
    		}
    		$this->Flash->error('Unable to register the email as a user.');
    	}
    	$this->set('Account', $Account);
    }
    
    public function details() {
    	
    }
}
