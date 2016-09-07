<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

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
                'action' => 'login'
            ]
        ]);
        
        $this->Users = TableRegistry::get("Users");
        $this->Cars = TableRegistry::get("Cars");
        $this->Locals = TableRegistry::get("Locals");
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'details', 'login', 'register', 'asyncs']);
	}
	
    public function index() {
    	if ($this->Auth->user()) {
    		$this->set("user", $this->Auth->user());
    	} else {
    		$this->set("user", null);
    	}
    	
    	/**
    	 * fill in the data of search block
    	 */
    	$query = $this->Cars->find();
    	$query->hydrate(false);
    	$makes = $query
    		->select(["make"])
    		->distinct(["make"])
    		->toList();
    	$this->set(compact("makes"));
    	
    	/**
    	 * show picked 4 cars
    	 */
    	$query = $this->Cars->find();
    	$query->hydrate(false);
    	$rs4 = $query
    		->contain(['Locals'
    			=> function ($q) {
    				return $q
    					->where(['Locals.zip' => '85550']);
    			}
    		])
    		->limit(4)
    		->toList();
    	$this->set(compact("rs4"));
    }
    
    public function login() {
    	if ($this->Auth->user()) {
    		return $this->redirect($this->Auth->redirectUrl());
    	}
    	
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
	                return $this->redirect(['action' => 'index']);
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
    	// load the Captcha component and set its parameter
    	$this->loadComponent('CakeCaptcha.Captcha', [
    		'captchaConfig' => 'RegisterCaptcha'
    	]);
    	
    	$user = null;
    	if ($this->request->is('post')) {
    		// validate the user-entered Captcha code
    		$isHuman = captcha_validate($this->request->data['CaptchaCode']);
    		
    		// clear previous user input, since each Captcha code can only be validated once
    		unset($this->request->data['CaptchaCode']);
    		
    		if ($isHuman) {
    			$user = $this->Users->newEntity();
	    		$user = $this->Users->patchEntity($user, $this->request->data);
	    		if ($this->Users->save($user)) {
	                $this->Flash->success(__('The user has been saved.'));
	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__('Unable to add the user.'));
    		} else {
    			$this->Flash->error(__('CAPTCHA validation failed, please try again.'));
    		}
    	}
    	
    	$as = $this->request->query("as");
    	if (empty($as)) {
    		$this->set("as", 2);
    	} else {
    		if (in_array($as, [1, 2])) {
    			$this->set(compact("as"));
    		} else {
    			$this->set("as", 2);
    		}
    	}
    	$this->set('user', $user);
    }
    
    public function asyncs() {
    	$this->viewBuilder()->layout("ajax");
    	$query = $this->Cars->find();
    	$query->hydrate(false);
    	if ($make = $this->request->query("make")) {
    		$models = $query
    			->select(['model'])
    			->where(['make' => $make])
    			->toList();
    		$this->set(compact("models"));
    	}
    }
    
    public function profile() {
    	$user = $this->Users->newEntity();
    	if (!$this->Auth->user()) {
    		$this->set('user', null);
    		return $this->redirect($this->Auth->redirectUrl());
    	} else {
    		$user = $this->Users->patchEntity($user, $this->Auth->user());
    		$this->set(compact("user"));
    	}
    }
    
    public function details() {
    	if ($this->Auth->user()) {
    		$this->set("user", $this->Auth->user());
    	} else {
    		$this->set("user", null);
    	}
    	
    	if ($this->request->is("post")) {
    		$data = $this->request->data;
    		$query = $this->Cars->find();
    		$query->hydrate(false);
    		$where = [];
    		$where += $data['make'] == -1 ? [1 => 1] : ['make' => $data['make']];
    		$where += $data['model'] == -1 ? [1 => 1] : ['model' => $data['model']];
    		$rs = $query
    			->contain(['Locals'
    				=> function ($q) use ($data) {
    					$where = ['Locals.zip' => $data['zip']];
    					$where += $data['price'] == -1 ? [1 => 1] : ['price' => $data['price']];
    					return $q
    						->where($where);
    				}
    			])
    			->where($where)
    			->toList();
    		$this->set(compact('rs'));
    		$this->set("zip", $data['zip']);
    	} else {
    		// to do
    	}
    }
}
