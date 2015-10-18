<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class PlaceTable extends Table{
	
	public function initialize(array $config){
		$this->table('places');
		
		$this->hasMany('Item', [
			'className' => 'Item',
			'foreignKey' => 'place_id',
		]);
		
		$this->hasMany('ItemPopular', [
			'className' => 'ItemPopular',
			'foreignKey' => 'place_id',
		]);
		
		$this->hasMany('ItemFeatured', [
			'className' => 'ItemFeatured',
			'foreignKey' => 'place_id',
		]);

	}

}