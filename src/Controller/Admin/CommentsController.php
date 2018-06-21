<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class CommentsController extends AppController
{
	public function add($video_id = null){
		$login_user_id = $this->MyAuth->user("id");
		try{
			$comment = $this->Comments->newEntity();
			$comment = $this->Comments->get($video_id,[
					'contain' => ['Users'],
			]);
			$comment->video_id=$video_id;
			$comment->user_id=$login_user_id;
			$check = $this->Comments->Users->find()
			->where(['Users.user_id'=>$login_user_id])
			->count();
			//dump($check);exit;
			if($check == 0){
				$this->Flash->error(__('投稿に失敗しました'));
				return $this->redirect(['controller'=>'videos','action' => 'play',$video_id]);
			}
			$comment = $this->Coments->patchEntity($comment,$this->request->data);
			if($this->Comments->save($comment)){
				$this->Flash->success(__('投稿しました'));
				return $this->redirect(['controller'=>'videos','action' => 'play',$video_id]);
			}
		}catch(\Exception $e){
			$this->Flash->error(__('動画が存在しません'));
			return $this->redirect(['controller'=>'playlists','action' => 'index']);
		}
	}
	
	public function commentsajax(){
		$this->autoRender = false;
		$result = [ ];
		
		//dump($this->request->data);exit;
		
		if ($this->request->is ( [
				'ajax'
		] )){
			$comments = $this->Comments->find()->contain(['Videos','Users'])
						->where(['Videos.v_code'=>$this->request->data['v_code']]);
						echo json_encode ( $comments );
						return;
		}
	}
	
}