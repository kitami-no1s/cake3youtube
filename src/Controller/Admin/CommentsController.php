<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class CommentsController extends AppController {
	// コメント追加
	public function addajax() {
		$this->autoRender = false;
		$login_user_id = $this->MyAuth->user ( "id" );
		$status = [ ];
		if ($this->request->is ( [ 
				'ajax' 
		] )) {
			
			$v_code = $this->request->data ['v_code'];
			$video = $this->Comments->Videos->find ()->where ( [ 
					'v_code' => $v_code 
			] )->first ();
			if (empty ( $video )) {
				$new_video = $this->Comments->Videos->newEntity ();
				$new_video ['v_code'] = $v_code;
				if ($this->Comments->Videos->save ( $new_video )) {
					$video = $this->Comments->Videos->find ()->where ( [ 
							'v_code' => $v_code 
					] )->first ();
				}
			}
			
			$comment = $this->Comments->newEntity ();
			$comment ['body'] = $this->request->data ['body'];
			$comment ['video_id'] = $video->id;
			$comment ['user_id'] = $login_user_id;
			if ($this->Comments->save ( $comment )) {
				$result ['status'] = 'success';
				echo json_encode ( $result );
				return;
			}
			$result ['status'] = 'error';
			echo json_encode ( $result );
			return;
		}
	}
}