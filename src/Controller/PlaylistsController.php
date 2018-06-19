<?php
namespace App\Controller;
use App\Controller\AppController;

class PlaylistsController extends AppController
{
	public function index()
	{
		$this->paginate = [
				"limit" => 10,
		];
		$playlists = $this->paginate($this->Playlists);
			
	}

}