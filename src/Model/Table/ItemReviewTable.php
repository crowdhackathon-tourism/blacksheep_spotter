<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemReviewTable extends Table{

	public function initialize(array $config){
		$this->table('item_reviews');
		
		$this->belongsTo('Item', [
			'className' => 'Item',
			'foreignKey' => 'item_id',
		]);
		
	}

}