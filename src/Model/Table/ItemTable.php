<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemTable extends Table{
	
	public function initialize(array $config){
		$this->table('items');
		
		$this->hasMany('ItemImages', [
			'className' => 'ItemImages',
			'foreignKey' => 'item_id',
		]);
		
		$this->hasMany('ItemPopular', [
			'className' => 'ItemPopular',
			'foreignKey' => 'item_id',
		]);
		
		$this->hasMany('ItemFeatured', [
			'className' => 'ItemFeatured',
			'foreignKey' => 'item_id',
		]);
		
		$this->hasMany('ItemReview', [
			'className' => 'ItemReview',
			'foreignKey' => 'item_id',
		]);
		
		$this->belongsTo('ItemMainCategory', [
			'className' => 'ItemMainCategory',
			'foreignKey' => 'main_category',
		]);
		
		
	}

}