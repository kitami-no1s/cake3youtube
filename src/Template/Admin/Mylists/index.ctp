<h1 class="title">マイリスト</h1>

	<div class="newedit">
		<p><?= $this->Html->link("新規作成",["action" => "add"]) ?></p>
	</div>
	
	
	<table border="1" class="index">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('プレイリスト名') ?></th>
		<th scope="col"><?= $this->Paginator->sort('最終更新日') ?></th>
		<th scope="col"><?= $this->Paginator->sort('Actioin') ?></th>
	</tr>
	<?php foreach($mylists as $mylist): ?>
	<tr>
		<td><?= h($mylist->title) ?></td>
		<td><?= h($mylist->modified) ?></td>
		<td><?= $this->Html->link("編集",["action" => "edit",$mylist->id]) ?>
			<?= $this->Html->link("削除",['action'=>'delete',$mylist->id]) ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	
	
	