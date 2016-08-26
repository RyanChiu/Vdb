<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;

class VdbController extends AppController {
	public function initialize()
	{
		parent::initialize();
		// Always enable the CSRF component.
		$this->loadComponent('Csrf');
		$this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Vdb',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Vdb',
                'action' => 'login',
                'home'
            ]
        ]);
        
        $this->Users = TableRegistry::get("Users");
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
    		// validate the user-entered Captcha code
    		$isHuman = captcha_validate($this->request->data['CaptchaCode']);
    		
    		// clear previous user input, since each Captcha code can only be validated once
    		unset($this->request->data['CaptchaCode']);

    		if ($isHuman) {
    			$user = $this->Auth->identify();
	            if ($user) {
	                $this->Auth->setUser($user);
	                $this->Flash->Success(__('Logged in!'));
	                return $this->redirect($this->Auth->redirectUrl());
	            }
	            $this->Flash->error(__('Invalid username or password, try again'));
    		} else {
    			$this->Flash->error(__('CAPTCHA validation failed, please try again.'));
    		}
    	}
    }
    
    public function logout()
    {
    	return $this->redirect($this->Auth->logout());
    }
    
    public function register() {
    	$user = $this->Users->newEntity();
    	if ($this->request->is('post')) {
    		$user = $this->Users->patchEntity($user, $this->request->data);
    		if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
    	}
    	$this->set('user', $user);
    }
    
    public function details() {
    	
    }
}
