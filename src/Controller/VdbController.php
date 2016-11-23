<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

include __DIR__ . "/../ZDriver/includes/constants.php";
include __DIR__ . "/../ZDriver/includes/methods.php";

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
        $this->Makes  = TableRegistry::get("Makes");
        $this->Models = TableRegistry::get("Models");
        
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'details', 'login', 'register', 'asyncs']);
	}
	
	/**
	 * pages below
	 */
    public function index() {
    	if ($this->Auth->user()) {
    		$this->set("user", $this->Auth->user());
    	} else {
    		$this->set("user", null);
    	}
    	
    	/**
    	 * fill in the data of search block
    	 */
    	$query = $this->Makes->find();
    	$query->hydrate(false);
    	$makes = $query
    		->select(["id", "name", "niceName"])
    		->toList();
    	if (empty($makes)) {
    		/*
    		 * if it's nothing there, TODO
    		 */
    		
    	}
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
    	
    	$makeid_nicename = $this->request->query("makeid_nicename");
    	$modelid_nicename = $this->request->query("modelid_nicename");
    	
    	$query = $this->Models->find();
    	$query->hydrate(false);
    	if ($makeid_nicename) {
    		$makeid_nicename = explode(",", $makeid_nicename);
    		$makeid = $makeid_nicename[0];
    		$models = $query
    			->select(['id', 'makeid', 'name', 'niceName'])
    			->distinct(['niceName'])
    			->where(['makeid' => $makeid])
    			->toList();
    		$this->set(compact("models"));
    	} else if ($modelid_nicename) {
    		$modelid_nicename = explode(",", $modelid_nicename);
    		$modelid = $modelid_nicename[0];
    		$models = $query
    			->select(['id', 'year'])
    			->where(['id' => $modelid])
    			->toList();
    		$this->set("model_years", $models);
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
    		/*
    		$query = $this->Cars->find();
    		$query->hydrate(false);
    		$where = [];
    		$where += $data['make'] == -1 ? [1 => 1] : ['make' => $data['make']];
    		$where += $data['model'] == -1 ? [1 => 1] : ['model' => $data['model']];
    		$rs = $query
    			->contain(['Locals'
    				=> function ($q) use ($data) {
    					$where = ['Locals.zip' => $data['zip']];
    					$where += $data['underprice'] == -1 ? [1 => 1] : ['(price - discount) <=' => $data['underprice']];
    					return $q
    						->where($where);
    				}
    			])
    			->where($where)
    			->toList();
    		$this->set(compact('rs'));
    		*/
    		$make = $data['make'];
    		$model = $data['model'];
    		$makeid_nicename = explode(",", $make);
    		$modelid_nicename = explode(",", $model);
    		$makenicename = $makeid_nicename[1];
    		$modelnicename = $modelid_nicename[1];
    		$year = $data['year'];
    		$zip = $data['zip'];
    		$content = callAPI(
    			"https://api.edmunds.com/api/editorial/v2/$makenicename/$modelnicename/$year"
    				. "?api_key=" . EDMUNDS_API_KEY . "&fmt=json"
    		);
    		$jsonArticle = json_decode($content, false);
    		$content = callAPI(
    			"https://api.edmunds.com/api/vehicle/v2/$makenicename/$modelnicename/$year"
    			. "/styles?api_key=" . EDMUNDS_API_KEY . "&fmt=json"
    		);
    		$jsonStyles = json_decode($content, false);
    		$jsonPrice = null;
    		if (!empty($zip) && !empty($jsonStyles) && $jsonStyles->stylesCount > 0) {
    			$styleid = $jsonStyles->styles[0]->id;
    			$content = callAPI(
    				"https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?"
    				. "styleid=$styleid&zip=$zip"
    				. "&api_key=" . EDMUNDS_API_KEY . "&fmt=json"
    			);
    			$jsonPrice = json_decode($content, false);
    		}
    		$this->set(compact("jsonArticle"));
    		$this->set(compact("jsonStyles"));
    		$this->set(compact("jsonPrice"));
    		$this->set(compact("content"));
    		
    		$this->set("zip", $data['zip']);
    		$this->set("underprice", $data['underprice']);
    	} else {
    		// to do
    	}
    }
}
