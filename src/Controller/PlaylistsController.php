<?php
namespace App\Controller;
use App\Controller\AppController;

class PlaylistsController extends AppController
{
	public function index()
	{
		$this->paginate = [
				'contain' => ['Users'],
				"limit" => 10,
		];
		$playlists = $this->paginate($this->Playlists);
		$this->set('playlists',$playlists);
	}
	public function view($playlist_id = null)
	{
		try{
			$playlist = $this->Playlists->get($playlist_id,[
					'contain' => ['Users','PlaylistVideos'],
			]);
		} catch(\Exception $e){
			$this->Flash->error(__('プレイリストが存在しません'));
			return $this->redirect(['action' => 'index']);
		}
		$this->set('playlist');
	}

}