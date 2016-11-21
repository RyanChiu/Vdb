<?php
// src/Model/Table/LocalsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class LocalsTable extends Table
{
	public function initialize(array $config)
	{
		$this->addAssociations([
			'belongsTo' => ['Cars'
				=> ['foreignKey' => 'carid']
			]
		]);
	}
}
?>