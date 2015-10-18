<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemImagesTable extends Table{

	public function initialize(array $config){
		$this->table('item_images');
		
		$this->belongsTo('Item', [
			'className' => 'Item',
			'foreignKey' => 'item_id',
		]);
		
	}

}