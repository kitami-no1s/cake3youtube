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

}