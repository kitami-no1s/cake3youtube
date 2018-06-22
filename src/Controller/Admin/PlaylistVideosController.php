<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use App\Model\Entity\PlaylistVideo;

class PlaylistVideosController extends AppController {
	public function addajax() {
		$this->autoRender = false;
		$result = [ ];
		if ($this->request->is ( [ 
				'ajax' 
		] )) {
			$playlist_video = $this->PlaylistVideos->newEntity ( $this->request->data );
			
			$max_playlist_video = $this->PlaylistVideos->find ()->where ( [ 
					'playlist_id' => $this->request->data ['playlist_id'] 
			] )->max ( 'seq' );
			// 曲の順番を追加
			if (empty ( $max_playlist_video )) {
				$playlist_video ['seq'] = 1;
			} else {
				$playlist_video ['seq'] = $max_playlist_video->seq + 1;
			}
			// 同じ動画がないか判定
			$video = $this->PlaylistVideos->find ()->where ( [ 
					'v_code' => $this->request->data ['v_code'] 
			] )->andwhere ( [ 
					'playlist_id' => $this->request->data ['playlist_id'] 
			] )->count ();
			if (empty ( $video )) {
				$this->PlaylistVideos->save ( $playlist_video );
				$result ['status'] = 'success';
				echo json_encode ( $result );
				return;
			}
			$result ['errors'] = $playlist_video->errors ();
		}
		$result ['status'] = "error";
		echo json_encode ( $result );
	}
}