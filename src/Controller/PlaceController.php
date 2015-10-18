<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PlaceController extends AppController{
	
	public function index(){

		$this->viewBuilder()->layout('place');
		$items = TableRegistry::get('Item');
		$main_categories = TableRegistry::get('ItemMainCategory');
		
		$item_id = $this->request->query['item'];
		$query = $items->findById($item_id)->contain(['ItemImages', 'ItemReview']);
		$item = $query->toArray();
		$item = $item[0];
		
		$category = $main_categories->findById($item['main_category'])->toArray();
		$item['category'] = $category[0]['name'];
		$item['type_icon'] = "assets/icons/".$category[0]['icon'];
		
		$item['latitude'] = $item['lat'];
		$item['longitude'] = $item['lon'];
		
		//pr($item);
		
		$this->set(compact('item'));
		
	}
	
	
	public function sunbed1(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed2(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed3(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed4(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed5(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed6(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed7(){
		$this->viewBuilder()->layout('place');
	}
	public function sunbed8(){
		$this->viewBuilder()->layout('place');
	}
	
	
	public function watersport1(){
		$this->viewBuilder()->layout('place');
	}
	public function watersport2(){
		$this->viewBuilder()->layout('place');
	}
	public function watersport3(){
		$this->viewBuilder()->layout('place');
	}
	

}








