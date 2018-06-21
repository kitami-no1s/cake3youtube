
<h1 class="page-header" ><?= h($playlist_title->title) ?>の編集</h1>

<div id=result></div>

<table id="sortable-table1" class="index" id="<?= $playlist_title->id ?>">
	<tr>
		<th>曲順</th>
		<th></th>
		<th></th>
		<th>削除</th>
	</tr>
<?= $this->Form->create('Mylists',['url'=>['action'=>'delete']]) ?>
<?= $this->Form->hidden('playlist_id',['default'=>$playlist_title->id]) ?>
<?php foreach($playlist_videos as $playlist_video): ?>
	<tr>
		<td><?= h($playlist_video->seq) ?></td>
		<td><img src="<?= h($playlist_video->thum) ?>"/></td>
		<td><?= h($playlist_video->title) ?>
		</td>
		<td><?= $this->Form->input("v_code",["type"=>"checkbox","name"=>"v_code[]","value"=>$playlist_video->v_code]) ?>
		</td>
	</tr>
<?php endforeach ?>
<?= $this->Form->button("削除") ?>
<?= $this->Form->end(); ?>

</table>
</div>
