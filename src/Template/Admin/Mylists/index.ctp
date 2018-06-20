<h1 class="title">マイリスト</h1>

	<?= $this->Html->link("新規作成",["action" => "add"]) ?>
	<?= $this->Html->link("編集",["action" => "edit",$playlist->id]) ?>
	<?= $this->Html->link("削除",['controller'=>'Playlists','action'=>'delete',$playlist->id]) ?></p></td>
</tr>
