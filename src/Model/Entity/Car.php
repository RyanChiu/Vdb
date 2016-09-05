<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Car extends Entity {
	// Make all fields mass assignable except for primary key field "id".
	protected $_accessible = [
			'*' => true,
			'id' => false
	];
}
?>