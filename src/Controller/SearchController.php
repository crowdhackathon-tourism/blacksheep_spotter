<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;


class SearchController extends AppController{
	
	public function index(){
		
		$session = $this->request->session();
		$act = $this->request->data['action'];
		$actions = array('eat', 'stay', 'move', 'recreation');
		$side_categories = array();
		
		/*$keyword = (isset($this->request->data['keyword']) ? $this->request->data['keyword'] : '');
		$keyword = array_filter(preg_split("/\W/", $keyword));
		if ( !empty($keyword) ){
		 	foreach($keyword as $v){
		 		$query .= '+'.$v.' ';
		 	}
		 } else{
		 	//$this->backToHome();
		 }*/
		
		if ( $act == 'experience' ){
			$this->redirect(array('controller' => 'Search', 'action' => 'experience', 'loc' => $this->request->data['location']));
		}
		
		#pr($this->request->data);
		
		$location = (isset($this->request->data['location']) ? $this->request->data['location'] : '');
		if ( mb_strpos($location, ',', 0, 'UTF-8') !== FALSE ){
			$location = explode(',', $location);
			$location = $location[0];
		}
		
		$term = '';
		$place = null;
		
		if ( !empty($location) ){
			$term .= $location;
			$places = TableRegistry::get('Place');
			$place = $places->find('all', ['conditions' => ['MATCH(Place.aliases) AGAINST("'.$location.'" IN BOOLEAN MODE)']])->first();
			if ( !empty($place) ){
				$place = $place->toArray();
				$term .= ' '.$place['name'];
			} else{
				$this->backToHome('no_results');
			}
		} else{
			$this->backToHome('no_results');
		}

		#echo $term;
		
		#USER LATITUDE/LONGITUDE
		if ( isset($this->request->data['lat']) && isset($this->request->data['lon']) && is_numeric($this->request->data['lat']) && is_numeric($this->request->data['lon']) ){
			$latitude =  (float) $this->request->data['lat'];
			$longitude = (float) $this->request->data['lon'];
			$session->write('user-latitude', $latitude);
			$session->write('user-longitude', $longitude);
		}
		
		if ( $session->check('user-latitude') && $session->check('user-longitude') ){
			$latitude =  $session->read('user-latitude');
			$longitude = $session->read('user-longitude');
		}
		
		$items = TableRegistry::get('Item');
		
		$query = $items->find('all', ['conditions' => ['MATCH(Item.address) AGAINST("'.$term.'" IN BOOLEAN MODE)']]);
		
		if ( in_array($act, $actions) ){
			$key = array_search($act, $actions) + 1;
			$query = $query->where(['Item.main_category' => $key]);
		}
		
		#pr($query->toArray());
		
		if ( isset($latitude) && isset($longitude) ){
			$query->select(['distance_real' => 
			"FLOOR(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(lon) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat))) * 1000)"
			])->order(['distance_real' => 'ASC']);
		} else{
			$latitude = Configure::read('default-latitude');
			$longitude = Configure::read('default-longitude');
			$query->select(['distance_default' =>
			"FLOOR(6371 * acos(cos(radians($latitude)) * cos(radians(lat)) * cos(radians(lon) - radians($longitude)) + sin(radians($latitude)) * sin(radians(lat))) * 1000)"
			])->order(['distance_default' => 'ASC']);
		}
		
		$query->select($items)->contain(['ItemImages', 'ItemReview']);
		
		$results = $query->toArray();
		#pr($results);

		$len = count($results);
		
		#NO RESULTS FOUND -> REDIRECT TO HOME PAGE
		if ( $len == 0 ){
			$this->backToHome('no_results');
		#RESULTS FOUND
		} else{
			$main_categories = TableRegistry::get('ItemMainCategory');
			$this->loadComponent('Item');
			$search_results = array();
			$recent = $this->Item->getRecent($items);
			$new_items = $this->Item->getNew($items);
			$featured = $this->Item->getFeatured($items, $place);
			$today_popular = $popular = $this->Item->getPopular($items, $place);
			$popular_listings = $this->Item->getPopularListings($items, $place);
		}
		
		for($i = 0; $i < $len; $i++){
			$search_results['data'][$i]['id'] = $i + 1;
			$search_results['data'][$i]['title'] = $results[$i]['name'];
			
			$category = $main_categories->findById($results[$i]['main_category'])->toArray();
			$search_results['data'][$i]['type'] = $search_results['data'][$i]['category'] = $category[0]['name'];
			$search_results['data'][$i]['type_icon'] = "/assets/icons/".$category[0]['icon'];
			
			$search_results['data'][$i]['latitude'] = (float) $results[$i]['lat'];
			$search_results['data'][$i]['longitude'] = (float) $results[$i]['lon'];
			$search_results['data'][$i]['location'] = $results[$i]['address'];
			$search_results['data'][$i]['price'] = $results[$i]['price'];
			$search_results['data'][$i]['rating'] = $results[$i]['item_review'][0]['rating'];
			$search_results['data'][$i]['url'] = '/place?item='.$results[$i]['id'];
			
			$search_results['data'][$i]['gallery'] = array("/files/item_images/".$results[$i]['item_images'][0]['image']);
			
			if ( isset($results[$i]['distance_real']) ){
				$search_results['data'][$i]['distance'] = round($results[$i]['distance_real'], -2);
			} else{
				$search_results['data'][$i]['distance'] = '';
			}
		}
		
		#GET SIDE CATEGORIES
		if ( !empty($main_categories) ){
			if ( !in_array($act, $actions) ){
				$categories = $main_categories->find('all')->toArray();
			} else{
				$key = array_search($act, $actions) + 1;
				$sub_categories = TableRegistry::get('ItemCategory');
				$categories = $sub_categories->find()->where(['ItemCategory.parent_category' => $key])->order('ItemCategory.name')->toArray();
			}
			foreach($categories as $cat){
				$side_categories[] = $cat['name'];
			}
		}

		#pr($side_categories);
		#pr($search_results);
		
		$this->set(compact('side_categories', 'search_results', 'popular_listings', 'new_items', 'recent', 'today_popular', 'popular', 'featured', 'latitude', 'longitude'));
	
	}
	
	
	public function experience(){

		$location = (isset($this->request->query['loc']) ? $this->request->query['loc'] : '');
		if ( mb_strpos($location, ',', 0, 'UTF-8') !== FALSE ){
			$location = explode(',', $location);
			$location = $location[0];
		}
		
		#pr($this->request->query['loc']);

		$place_id = 0;
		$places = TableRegistry::get('Place');
		$place = $places->find('all', ['conditions' => ['MATCH(Place.aliases) AGAINST("'.$location.'" IN BOOLEAN MODE)']])->first();
		if ( !empty($place) ){
			$place_id = $place['id'];
		} else{
			$this->backToHome('no_location');
		}
		
		$place_descriptions = TableRegistry::get('PlaceDescriptions');
		$place_descriptions = $place_descriptions->find('all', ['conditions'=> ['PlaceDescriptions.place_id' => $place_id]])->toArray();
		
		$place_paths = TableRegistry::get('PlacePaths');
		$place_paths = $place_paths->find('all', ['conditions'=> ['PlacePaths.place_id' => $place_id]])->toArray();
		
		$items = TableRegistry::get('Item');
		$this->loadComponent('Item');
		
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
		
		#pr($place_paths);
		
		$this->set(compact('place_paths', 'place_descriptions', 'side_categories', 'popular_listings', 'new_items', 'recent', 'today_popular', 'popular', 'featured'));
	
	}
	
	
	private function backToHome($message){
		$this->autoRender = false;
		$session = $this->request->session();
		$session->write($message, $message);
		$this->redirect(array('controller' => 'Guests', 'action' => 'index'));
	}
	
	
	public function stay(){
		$this->redirect(array('controller' => 'Search', 'action' => 'index', 'act' => $this->request->params['action']));
	}
	public function eat(){
		$this->redirect(array('controller' => 'Search', 'action' => 'index', 'act' => $this->request->params['action']));
	}
	public function recreate(){
		$this->redirect(array('controller' => 'Search', 'action' => 'index', 'act' => $this->request->params['action']));
	}
	public function move(){
		$this->redirect(array('controller' => 'Search', 'action' => 'index', 'act' => $this->request->params['action']));
	}
	

}
