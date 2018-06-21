<?php $this->prepend('script',$this->Html->script('edit.js')); ?>
<h1 class="page-header" ><?= h($playlist_title->title) ?>の編集</h1>

<div id=result></div>
<table class="index" id="<?= $playlist_title->id ?>">
	<tr>
		<th>曲順</th>
		<th></th>
		<th></th>
		<th>削除</th>
	</tr>
<form id="form">

<input type="submit" name="submit" value="削除">
<?php foreach($playlist_videos as $playlist_video): ?>
	<tr>
		<td><?= h($playlist_video->seq) ?></td>
		<td><img src="<?= h($playlist_video->thum) ?>"/></td>
		<td><?= h($playlist_video->title) ?>
		</td>
		<td><?= $this->Form->input("",["type"=>"checkbox","name"=>"v_code[]","value"=>"$playlist_video->v_code"]) ?></td>
	</tr>
<?php endforeach ?>
</form>
</table>
</div>
