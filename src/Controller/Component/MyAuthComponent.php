<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

//AuthComponentを継承した自作のコンポーネント
class MyAuthComponent extends AuthComponent
{
	public $name="MyAuth";
	
	public function initialize(array $config)
	{
		parent::initialize($config);
		$defaults=[
				"authorize"=>"Controller",
				"authenticate"=>[
					"Form"=>[
						"userModel"=>"Users",
						"fields"=>[
							"username"=>"email",
							"password"=>"password",
						],
					],
				],
				"loginRedirect"=>[
						"controller"=>"Playlists",
						"action"=>"index",
						"prefix"=>"admin"
				],
				"logoutRedirect"=>[
						"controller"=>"Playlists",
						"action"=>"index",
						"prefix"=>false
				],
				"loginAction"=>[
						"controller"=>"Users",
						"action"=>"login",
						"prefix"=>false
				],
				"authError"=>"ログインする必要があります",
				"flash"=>[
						"key"=>"auth",
						"element"=>"error",
						"duplicate"=>false
				],
		];
		foreach ($config as $key => $value){
			if($value !==null){
				unset($defaults[$key]);
			}
		}
		$this->config($defaults);
	}
}?>