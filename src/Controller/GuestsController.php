<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class GuestsController extends AppController{
	
	public function index(){

		$items = TableRegistry::get('Item');

		$session = $this->request->session();
		
		if ( $session->check('no_results') ){
			$this->Flash->search_error('There are no results found', ['key'=>'no_results']);
		} else if ( $session->check('no_location') ){
			$this->Flash->search_error('No experience found on that location', ['key'=>'no_results']);
		}
		
		$session->delete('no_results');
		$session->delete('no_location');
		
		//$session->delete('user-latitude');
		//$session->delete('user-longitude');
		
		if ( !$session->check('user-latitude') && !$session->check('user-longitude') ){
			$latitude = Configure::read('default-latitude');
			$longitude = Configure::read('default-longitude');
		} else{
			$latitude = $session->read('user-latitude');
			$longitude = $session->read('user-longitude');
		}

		$this->set(compact('latitude', 'longitude'));
		
	}
	
	
	public function pathMaps(){
		$path_id = $this->request->query['path'];
		$place_paths = TableRegistry::get('PlacePaths');
		$path = $place_paths->get($path_id);
		$items = TableRegistry::get('Item');
		$this->loadComponent('Item');
		
		$place['id'] = 1;
		$recent = $this->Item->getRecent($items);
		$new_items = $this->Item->getNew($items);
		$featured = $this->Item->getFeatured($items, $place);
		$today_popular = $popular = $this->Item->getPopular($items, $place);
		$popular_listings = $this->Item->getPopularListings($items, $place);

		#GET SIDE CATEGORIES
		$main_categories = TableRegistry::get('ItemMainCategory');
		$side_categories = array();
		$categories = $main_categories->find('all')->toArray();
		foreach($categories as $cat){
			$side_categories[] = $cat['name'];
		}
		
		$this->set(compact('side_categories', 'path', 'popular_listings', 'new_items', 'recent', 'today_popular', 'popular', 'featured'));
	}

}









