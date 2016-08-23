<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;


class AccountsTable extends Table {
	public function beforeSave(Event $event)
	{
		$Account = $event->data['Account'];
	
		// Make a password for digest auth.
		$Account->digest_hash = DigestAuthenticate::password(
			$Account->email,
			$Account->pwd,
			env('SERVER_NAME')
			);
		return true;
	}
	
	public function validationDefault(Validator $validator)
	{
		return $validator
			->notEmpty('email', 'An email as username is required')
			->notEmpty('pwd', 'A password is required');
	}
	
}
?>