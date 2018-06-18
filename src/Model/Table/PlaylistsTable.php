<?php 
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Association\BelongsTo;


class PlaylistsTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->table('playlists');
		$this->displayField('title');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('users',[
				'foreignKey'=>'user_id',
		]);
		$this->hasMany('playlist_vidos',[
				'foreignKey'=>'playlist_id',
		]);
	}


	public function validationDefault(Validator $validator)
	{
		$validator
		->integer('id')
		->allowEmpty('id','create');
		$validator
		->requirePresence('title','create')
		->notEmpty('title');
		
		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['user_id'],'Users'));
		return $rules;
	}
}