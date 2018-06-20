<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;


class PlaylistVideosController extends AppController
{
	public function addajax(){
		$this->autoRender = false;
		$result = [ ];
		
		if ($this->request->is ( [
				'ajax'
		] )) {
			$playlist_video = $this->PlaylistVideos->newEntity ($this->request->data );
			$this->PlaylistVideos->save ( $playlist_video );
			}
	}
	
}