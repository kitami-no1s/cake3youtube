<h1 class="title">マイリスト</h1>

	<div class="newedit">
		<p><?= $this->Html->link("新規作成",["action" => "add"]) ?></p>
	</div>
	
	
	<table border="1" id="indexplaylist">
	<tr>
		<th>プレイリスト名</th>
		<th>最終更新日</th>
		<th>Actioin</th>
	</tr>
	<?php foreach($mylists as $mylist): ?>
	<tr>
		<td><?= h($mylist->title) ?></td>
		<td><?= h($mylist->modified) ?></td>
		<td><?= $this->Html->link("編集",["action" => "edit",$mylist->id]) ?>
			<?= $this->Html->link("削除",['action'=>'deletemylist',$mylist->id]) ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	
	
	