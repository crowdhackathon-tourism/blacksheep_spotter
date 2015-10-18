<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserRolesTable extends Table{

	public function initialize(array $config){
		$this->table('user_roles');
	}

}