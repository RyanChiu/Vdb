<?php
// src/Model/Table/CarsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class CarsTable extends Table
{
	public function initialize(array $config)
	{
		$this->addAssociations([
			'hasMany' => ['Locals'
				=> ['foreignKey' => 'carid']
			]
		]);
	}
}
?>