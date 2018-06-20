<?php
namespace App\Controller;
use App\Controller\AppController;

class VideosController extends AppController
{
	
	public function result()
	{

		$keyword=$_GET['keyword'];
		
		$this->set('keyword',$keyword);
	}
	
	public function play()
	{
		$video_id = $_GET['videoId'];
		
		$this->set('video_id',$video_id);
	}
}