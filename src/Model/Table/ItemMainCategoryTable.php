<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class ItemMainCategoryTable extends Table{

	public function initialize(array $config){
		$this->table('item_main_categories');

		$this->hasMany('Item', [
			'className' => 'Item',
			'foreignKey' => 'main_category',
		]);
		
		
		$this->hasMany('ItemCategory', [
			'className' => 'ItemCategories',
			'foreignKey' => 'parent_category',
		]);
		
		
		$this->hasMany('Integration', [
			'className' => 'Integration',
			'foreignKey' => 'main_category',
		]);
	}

}