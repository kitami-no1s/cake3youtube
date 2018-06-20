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
			$count_playlist_videos=$this->PlaylistVideos->find()->where(['playlist_id'=>$this->request->data['playlist_id']])
										->count();
			$playlist_video['seq'] = $count_playlist_videos + 1;
			$this->PlaylistVideos->save ( $playlist_video );
			}
	}
	
}