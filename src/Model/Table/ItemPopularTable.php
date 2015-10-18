<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemPopularTable extends Table{

	public function initialize(array $config){
		$this->table('item_popular');
		
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