<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class CommentsController extends AppController {
	// コメント追加
	public function addajax() {
		$this->autoRender = false;
		$login_user_id = $this->MyAuth->user ( "id" );
		if ($this->request->is ( [ 
				'ajax' 
		] )) {
			
			$v_code = $this->request->data ['v_code'];
			$video = $this->Comments->Videos->find ()->where ( [ 
					'v_code' => $v_code 
			] );
			if (empty ( $video )) {
				$new_video = $this->Comments->Videos->newEntity ();
				$new_video ['v_code'] = $v_code;
				if ($this->Comments->Videos->save ( $new_video )) {
					$video = $this->Comments->Videos->find ()->where ( [ 
							'v_code' => $v_code 
					] );
				}
				$comment = $this->Comments->newEntity ();
				$comment ['body'] = $this->request->data ['body'];
				$comment ['video_id'] = $video->id;
				$comment ['user_id'] = $login_user_id;
			}
			if ($this->Comments->save ( $comment )) {
				return;
			}
		}
	}
	public function commentsajax() {
		$this->autoRender = false;
		
		// dump($this->request->data);exit;
		
		if ($this->request->is ( [ 
				'ajax' 
		] )) {
			$comments = $this->Comments->find ()->contain ( [ 
					'Videos',
					'Users' 
			] )->where ( [ 
					'Videos.v_code' => $this->request->data ['v_code'] 
			] );
			echo json_encode ( $comments );
			return;
		}
	}
}