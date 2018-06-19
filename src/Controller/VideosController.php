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

}