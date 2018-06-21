<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class VideosController extends AppController
{

	public function result()
	{
		$login_user_id = $this->MyAuth->user("id");
		$keyword=$_GET['keyword'];

		$this->set(compact('keyword','login_user_id'));
	}

	public function play()
	{
		$playlists = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$myplaylists = $playlists->find('list')->where(['user_id'=>$login_user_id]);
		$video_id = $_GET['videoId'];
		
		$this->set(compact('video_id','login_user_id','myplaylists','comments'));
	}
}