<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class MylistsController extends AppController
{
	
	public function index()
	{
		$mylistindex = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$this->paginate = [
				'contain' => ['PlaylistVideos'],
				"limit" => 5,
				"conditions" => ['user_id'=>$login_user_id]
		];
		$mylists = $this->paginate($mylistindex);
		$this->set('mylists',$mylists);
	}
	public function add()
	{	
		$mylist_add = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$playlist = $mylist_add->newEntity();
		$playlist->user_id = $login_user_id;
		//カテゴリ新規作成
		if($this->request->is('post')){
			$playlist = $mylist_add->patchEntity($playlist,$this->request->data);
			if($mylist_add->save($playlist)){
				$this->Flash->success(__('新規登録しました'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('登録に失敗しました'));
		}
		$mylist = $this->paginate($mylist_add);
		$this->set(compact('playlist','mylist'));
	}
	public function edit($playlist_id = null)
	{
		$mylist_edit = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		try{
			$playlist_videos = $mylist_edit->PlaylistVideos->find()->where([
										'playlist_id'=>$playlist_id,
								]);
			$playlist_title = $mylist_edit->get($playlist_id);
		} catch(\Exception $e){
			$this->Flash->error(__('エラーが発生しました'));
			return $this->redirect(['action' => 'index']);
		}
		$this->set(compact('playlist_videos','playlist_title'));
		
	}
	public function deletemylist($playlist_id = null)
	{
		$mylist_delete = TableRegistry::get('Playlists');
		$login_user_id = $this->MyAuth->user("id");
		$entity = $mylist_delete->find()
			->where(['user_id' => $login_user_id,'id' => $playlist_id])
			->first();
		if(empty($entity)){
			$this->Flash->error(__('マイプレイリストのみが削除可能です'));
			return $this->redirect(['action' => 'index']);
		}
		$mylist_delete->delete($entity);
		$this->Flash->success(__('プレイリストを削除しました'));
		return $this->redirect(['action' => 'index']);
	}
	public function delete()
	{
		$mylist_delete = TableRegistry::get('Playlists');
		//checkの入ったv_codeの配列
		$v_codes = $this->request->data['v_codes'];
		$playlist_id = $this->request->data['playlist_id'];
		if($this->request->is('post')){
			if(isset($this->request->data["delete"])){
				//v_codeを削除
				foreach($v_codes as $v_code){
					$mylist_delete->PlaylistVideos->deleteAll([
						'v_code' => $v_code,
				 		'playlist_id' => $playlist_id,
					]);	
				}			
			}
		}
		return $this->redirect(['action' => 'edit',$this->request->data['playlist_id']]);
	}
	public function sortajax()
	{
		$mylist_sort = TableRegistry::get('PlaylistVideos');
		
		$this->autoRender = FALSE;
		$result = [ ];
		//並び替えた順番のid配列
 		$video_ids = $this->request->data['id'];
		$playlist_id = $this->request->data['playlist_id'];
		if ($this->request->is ( [ 'ajax'] )) {
			//seqを1からインクリメント
			$index = 1;
			foreach($video_ids as $video_id){
				$sort_video = $mylist_sort->query()->update()->set(['seq' => $index ])
							->where(['id'=>$video_id])
							->andwhere(['playlist_id'=>$playlist_id])->execute();
				$index++;
			}
			$result ['status'] = "success";			
			echo json_encode ( $result );
			return;
		}
		$result ['status'] = 'error';
		echo json_encode ( $result );
	}
	
}