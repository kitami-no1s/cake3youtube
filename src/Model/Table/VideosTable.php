<?php 
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Association\BelongsTo;


class VideosTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->table('videos');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->hasMany('Comments',[
				'foreignkey' => 'video_id'
		]);
	}


	public function validationDefault(Validator $validator)
	{
		$validator
		->integer('id')
		->allowEmpty('id','create');
		
		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['video_id'],'Comments'));
		return $rules;
	}
}