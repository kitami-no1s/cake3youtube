<?php
namespace App\Controller;
use App\Controller\AppController;

class VideosController extends AppController
{
	
	public function result()
	{
		$keyword=$this->request->query['keyword'];
		
		$this->set('keyword',$keyword);
	}
	
	public function play()
	{
		$video_id = $this->request->query['videoId'];
		
		$this->set('video_id',$video_id);
	}
}