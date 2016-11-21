<?php
// src/Model/Table/MakesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class MakesTable extends Table
{
	public function initialize(array $config)
	{
		$this->addAssociations([
			'hasMany' => ['Models'
				=> ['foreignKey' => 'makeid']
			]
		]);
	}
}
?>