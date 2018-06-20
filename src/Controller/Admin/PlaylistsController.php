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
		try{
			$playlist = $this->Playlists->get($playlist_id,[
					'contain' => ['Users'],
			]);
		} catch(\Exception $e){
			$this->Flash->error(__('プレイリストが存在しません'));
			return $this->redirect(['action' => 'index']);
		}
	}
}