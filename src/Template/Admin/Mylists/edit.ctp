<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<?php $this->prepend('script',$this->Html->script('edit.js')); ?>

<h1 class="page-header" ><?= h($playlist_title->title) ?>の編集</h1>

<div id=result></div>

<table id="sortable-table1" class="index" id="<?= $playlist_title->id ?>">
	<tr>
		<th></th>
		<th></th>
		<th>削除</th>
	</tr>
<?= $this->Form->create('Mylists') ?>
<?= $this->Form->hidden('playlist_id',['default'=>$playlist_title->id]) ?>
<?php foreach($playlist_videos as $playlist_video): ?>
	<tr>
		<td><img src="<?= h($playlist_video->thum) ?>"/></td>
		<td><?= h($playlist_video->title) ?>
		</td>
		<td><?= $this->Form->input("v_code",["type"=>"checkbox","value"=>$playlist_video->v_code]) ?>
		</td>
	</tr>
<?php endforeach ?>
<?= $this->Form->button("削除") ?>
<input type="hidden" id="result" name="result" />
<?= $this->Form->button("並び替え",['id' => 'submit']) ?>
<?= $this->Form->end(); ?>

</table>
</div>
