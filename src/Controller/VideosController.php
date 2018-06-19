<?php
namespace App\Controller;
use App\Controller\AppController;

class VideosController extends AppController
{
	
	public function result()
	{
		if(!empty($_GET['keyword'])){
			$keyword=$_GET['keyword'];
		}
		$this->set('keyword',$keyword);
	}

}