<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;


class PlaylistsController extends AppController
{
	public function index()
	{
		$this->paginate = [
				'contain' => ['Users'],
				"limit" => 10,
		];
		$playlists = $this->paginate($this->Playlists);
	
		$login_user_id = $this->MyAuth->user("id");
		$this->paginate = [
				'contain' => ['Users'],
				"limit" => 10,
				"conditions" => ['Playlists.user_id'=>$login_user_id]
		];
		$myplaylists = $this->paginate($this->Playlists);
		$this->set(compact('myplaylists','playlists'));
	}
	
	public function view($playlist_id = null)
	{
		$login_user_id = $this->MyAuth->user("id");
		try{
			$playlist = $this->Playlists->get($playlist_id);
			if($playlist->public == 0 && $playlist->user_id !== $login_user_id ){
				$this->Flash->error(__('非公開のプレイリストです'));
				return $this->redirect(['action' => 'index']);
			}
			$playlist_videos = $this->Playlists->PlaylistVideos->find()->where(['playlist_id'=>$playlist_id
			]);
		} catch(\Exception $e){
			$this->Flash->error(__('プレイリストが存在しません'));
			return $this->redirect(['action' => 'index']);
		}
		$this->set(compact('playlist_videos','playlist'));
	}
	public function play($playlist_id=null, $v_code=null)
	{
		$login_user_id = $this->MyAuth->user("id");
		$playlist = $this->Playlists->PlaylistVideos->find()->where(['playlist_id'=>$playlist_id,]);
		$this->set(compact('v_code','playlist','login_user_id'));
	}
}