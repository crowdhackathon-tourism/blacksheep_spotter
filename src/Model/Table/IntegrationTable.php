<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class IntegrationTable extends Table{

	public function initialize(array $config){
		$this->table('integrations');
		
		$this->belongsTo('ItemMainCategory', [
			'className' => 'ItemMainCategory',
			'foreignKey' => 'main_category',
		]);
		
	}

}