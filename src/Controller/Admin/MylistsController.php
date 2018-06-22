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
	public function add()
	{	
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
	public function edit($playlist_id = null)
	{
		$mylist_edit = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		try{
			$mylist_edit->user_id=$login_user_id;
			$playlist_videos = $mylist_edit->PlaylistVideos->find()->where([
										'playlist_id'=>$playlist_id,
								]);
			$playlist_title = $mylist_edit->get($playlist_id);
		} catch(\Exception $e){
			$this->Flash->error(__('エラーが発生しました'));
			return $this->redirect(['action' => 'index']);
		}
		$this->set(compact('playlist_videos','playlist_title'));
		
	}
	public function delete()
	{
		
		$v_codes = $this->request->data['v_code'];
		$mylist_delete = TableRegistry::get('Playlists');
		$playlist_id = $this->request->data['playlist_id'];
		if($this->request->is('post')){
			foreach($v_codes as $v_code){
				$mylist_delete->PlaylistVideos->deleteAll([
					'v_code' => $v_code,
			 		'playlist_id' => $playlist_id,
				]);	
			}
			$mylist_delete->PlaylistVideos->updateAll(['seq' => 0])
				->where(['playlist_id' => $playlist_id]);
		}
		return $this->redirect(['action' => 'edit',$this->request->data['playlist_id']]);
		
	}
}