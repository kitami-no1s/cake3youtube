<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

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
		$video_id = $_GET['videoId'];

		$this->set('video_id',$video_id);
	}
}