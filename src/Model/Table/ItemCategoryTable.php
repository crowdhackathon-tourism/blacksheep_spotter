<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemCategoryTable extends Table{

	public function initialize(array $config){
		$this->table('item_categories');

		$this->belongsTo('ItemMainCategory', [
			'className' => 'ItemMainCategory',
			'foreignKey' => 'parent_category',
		]);
	}

}