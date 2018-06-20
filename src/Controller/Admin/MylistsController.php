<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class MylistsController extends AppController
{
	
	public function index()
	{
		$mylistindex = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$this->paginate = [
				'contain' => ['PlaylistVideos'],
				"limit" => 5,
				"conditions" => ['user_id'=>$login_user_id]
		];
		$mylists = $this->paginate($mylistindex);
		$this->set('mylists',$mylists);
	}
	public function add(){
		
		$mylist_add = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$playlist = $mylist_add->newEntity();
		$playlist->user_id=$login_user_id;
		if($this->request->is('post')){
			$playlist = $mylist_add->patchEntity($playlist,$this->request->data);
			if($mylist_add->save($playlist)){
				$this->Flash->success(__('新規登録しました'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('登録に失敗しました'));
		}
		$mylist = $this->paginate($mylist_add);
		$this->set(compact('playlist','mylist'));
	}
}