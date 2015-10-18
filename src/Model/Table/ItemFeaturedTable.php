<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemFeaturedTable extends Table{

	public function initialize(array $config){
		$this->table('item_featured');
		
		$this->belongsTo('Item', [
			'className' => 'Item',
			'foreignKey' => 'item_id',
		]);
		
		$this->belongsTo('Place', [
			'className' => 'Place',
			'foreignKey' => 'place_id',
		]);
		
	}

}