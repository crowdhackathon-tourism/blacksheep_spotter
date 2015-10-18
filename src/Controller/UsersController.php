<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;

class UsersController extends AppController{

	public function beforeFilter(Event $event){
		parent::beforeFilter($event);
		$this->viewBuilder()->layout('user');
		$this->Auth->allow(['login', 'logout', 'register']);
	}
	
	
	public function logout(){
		return $this->redirect($this->Auth->logout());
	}
	
	
	public function isAuthorized($user){
		#Admin can access every action
		if ( isset($user['role']) && $user['role'] === 1 ){
			return true;
		}
		return false;
	}
	
	
	public function login(){
		$items = TableRegistry::get('Item');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user){
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, please try again.'));
		}
		$this->set(compact('new_items', 'today_popular', 'recent_review_items'));
	}
	

	public function register(){
		$items = TableRegistry::get('Item');
		$this->loadComponent('Item');
		$today_popular = $popular = $this->Item->getPopular($items);
		$new_items = $this->Item->getFeatured($items);
		$recent_review_items = $this->Item->getFeatured($items);
		$UserRoles = TableRegistry::get('UserRoles');
		$roles = $UserRoles->find('all')->toArray();
		$user_roles = '<option value="0" selected>Select a role</option>';
		foreach($roles as $k=>$role){
			$user_roles .= '<option value="'.$role['role'].'">'.$role['role'].'</option>';
		}
		$user = $this->Users->newEntity();
		if ($this->request->is('post')){
			$user = $this->Users->patchEntity($user, $this->request->data);
			$role = $UserRoles->findByRole($this->request->data['role'])->toArray();
			$user->role = @$role[0]['id'];
			$user->created = date('Y-m-d H:i:s');
			if ($this->Users->save($user)) {
				$this->Flash->success(__('You have been registered successfully.'));
				return $this->redirect(['action' => 'login']);
			}
			$this->Flash->error(__('A problem occured with your registration details.'));
		}
		$this->set('user', $user);
		$this->set('user_roles', $user_roles);
		$this->set(compact('new_items', 'today_popular', 'recent_review_items'));
	}
	
	
	public function profile(){
		$items = TableRegistry::get('Item');
		$users = TableRegistry::get('User');
		$user_id = $this->Auth->user('id');
		$user = $users->get($user_id);
		$this->set(compact('user'));
	}
	
	
	public function businesses(){
		$items = TableRegistry::get('Item');
		$users = TableRegistry::get('Users');
		$main_categories = TableRegistry::get('ItemMainCategory');
		$user_id = $this->Auth->user('id');
		$user = $users->get($user_id);
		$eat = $items->find()->where(['Item.main_category' => 1])->contain(['ItemImages', 'ItemReview'])->first()->toArray();
		$hotel = $items->find()->where(['Item.main_category' => 2])->contain(['ItemImages', 'ItemReview'])->first()->toArray();
		$move = $items->find()->where(['Item.main_category' => 3])->contain(['ItemImages', 'ItemReview'])->first()->toArray();
		$recereate = $items->find()->where(['Item.main_category' => 4])->contain(['ItemImages', 'ItemReview'])->first()->toArray();
		$my_items = array($hotel, $eat, $move, $recereate);
		#GET CATEGORY FOR EACH ITEM
		for($i = 0; $i < count($my_items); $i++){
			$category = $main_categories->findById($my_items[$i]['main_category'])->toArray();
			$my_items[$i]['category'] = $category[0]['name'];
			$my_items[$i]['type_icon'] = "/assets/icons/".$category[0]['icon'];
		}
		
		//pr($my_items);
		$this->set(compact('user', 'my_items'));
	}
	
	
	public function newBusiness(){
		$items = TableRegistry::get('Item');
		$main_categories = TableRegistry::get('ItemMainCategory');
		$main_categories = $main_categories->find()->contain(['Integration'])->toArray();
		$sub_categories = TableRegistry::get('ItemCategory');
		$sub_categories = $sub_categories->find()->toArray();
		$this->set(compact('new_items', 'today_popular', 'recent_review_items', 'main_categories', 'sub_categories'));
	}
	
	



	
	
	
}