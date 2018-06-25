<?php
namespace App\Controller;
use App\Controller\AppController;

class CommentsController extends AppController
{
	public function commentsajax() {
		$this->autoRender = false;
	
		if ($this->request->is ( [
				'ajax'
		] )) {
			$comments = $this->Comments->find ()->contain ( [
					'Videos',
					'Users'
			] )->where ( [
					'Videos.v_code' => $this->request->data ['v_code']
			] )->order([
					'Comments.created' => "DESC"
			])->all();
			//dump($comments);
			//exit;
			$result = [];
			$result["status"] = "success";
			$result["comments"] =  $comments;
			echo json_encode ( $result );
			exit;
			return;
		}
	}
}