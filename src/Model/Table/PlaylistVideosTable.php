<?php 
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Association\BelongsTo;


class PlaylistVideosTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->table('playlist_videos');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('playlists',[
				'foreignKey'=>'playlist_id',
		]);
	}


	public function validationDefault(Validator $validator)
	{
		$validator
		->integer('id')
		->allowEmpty('id','create');
		
		
		$validator
		->requirePresence('v_code','create')
		->notEmpty('v_code');
		
		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['playlist_id'],'Playlists'));
		return $rules;
	}
}