<?php 
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Association\BelongsTo;


class UsersTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->table('users');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->hasMany('Playlists',[
				'foreignKey'=>'user_id',
		]);
		$this->hasMany('Comments',[
				'foreignKey'=>'user_id'
		]);
	}


	public function validationDefault(Validator $validator)
	{
		$validator
		->integer('id')
		->allowEmpty('id','create');
		$validator
		->requirePresence('name','create')
		->notEmpty('name');
		$validator
		->email('email')
		->requirePresence('email','create')
		->notEmpty('email')
		->add('email','unique',[
				'rule'=>'validateUnique',
				'provider'=>'table',
				'message' => '登録できません']);
		$validator
		->requirePresence('password','create')
		->notEmpty('password');
		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->isUnique(['email'],["message"=>"登録できません"]));
		return $rules;
	}
}?>