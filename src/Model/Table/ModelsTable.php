<?php
// src/Model/Table/ModelsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ModelsTable extends Table
{
	public function initialize(array $config)
	{
		$this->addAssociations([
			'belongsTo' => ['Makes'
				=> ['foreignKey' => 'makeid']
			]
		]);
	}
}
?>