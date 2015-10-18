<?php 

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;


class ItemComponent extends Component{
	
	
    public function getFeatured($items, $place){
    	$query = $items->find()->contain(['ItemImages', 'ItemMainCategory'])
    	->matching('ItemFeatured', function ($q) use ($place){
    	return $q->where(['ItemFeatured.item_status'=>1, 'ItemFeatured.place_id' => $place['id']]);});
    	$obj = $query->toArray();
        return $obj;
    }
    
    
    public function getNew($items){
    	$query = $items->find()->contain(['ItemImages', 'ItemMainCategory'])->order('created DESC')->limit(2);
		$obj = $query->toArray();
    	return $obj;
    }
    
    
     public function getPopular($items, $place){
     	$query = $items->find()->contain(['ItemImages', 'ItemMainCategory'])
     	->matching('ItemPopular', function ($q) use ($place){
     	return $q->where(['ItemPopular.popularity >'=>0, 'ItemPopular.place_id' => $place['id']]);});
     	$obj = $query->toArray();
    	return $obj;
     }
     
     
     public function getPopularListings($items, $place){
     	$query = $items->find()->contain(['ItemImages', 'ItemMainCategory'])
     	->matching('ItemPopular', function ($q) use ($place){
     	return $q->where(['ItemPopular.popularity >'=>0, 'ItemPopular.place_id' => $place['id']]);})->limit(3);
     	$obj = $query->toArray();
    	return $obj;
     }
     
     
     public function getRecent($items){
     	$query = $items->find()->contain(['ItemImages', 'ItemMainCategory'])->order('created DESC')->limit(3);
     	$obj = $query->toArray();
     	return $obj;
     }
     
    
    
}