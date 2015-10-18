<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;


class AppController extends Controller{

    public function initialize(){
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        
        $this->loadComponent('Auth', [
        	'loginRedirect' => [
        		'controller' => 'Users',
        		'action' => 'businesses'
        		],
        	'logoutRedirect' => [
        		'controller' => 'Guests',
        		'action' => 'index'
        		],
        	'authenticate' => [
				'Form' => [
				'fields' => ['username' => 'email', 'password' => 'password']
				]
			]
        ]);
    }
    
    
    public function beforeFilter(Event $event){
    	$this->Auth->allow();
    	$this->Auth->deny(['profile', 'newItem', 'myItems']);
    }
    
    
    public function beforeRender(Event $event){
        if ( !array_key_exists('_serialize', $this->viewVars) && in_array($this->response->type(), ['application/json', 'application/xml']) ){
            $this->set('_serialize', true);
        }
    }
}
