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
			$playlist_videos = $this->Playlists->PlaylistVideos->find()->where(['playlist_id'=>$playlist_id
			]);
			$playlist_title = $this->Playlists->get($playlist_id);
		} catch(\Exception $e){
			$this->Flash->error(__('プレイリストが存在しません'));
			return $this->redirect(['action' => 'index']);
		}
		$this->set(compact('playlist_videos','playlist_title'));
	}
	public function play($playlist_id=null, $v_code=null)
	{
		$playlist = $this->Playlists->PlaylistVideos->find()->where(['playlist_id'=>$playlist_id,]);
		$this->set(compact('v_code','playlist'));
	} 

}