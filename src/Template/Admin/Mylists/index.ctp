<h1 class="title">マイリスト</h1>

	<div class="newedit">
		<p><?= $this->Html->link("新規作成",["action" => "add"]) ?></p>
	</div>
	
	
	<table class="mylist">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('順番') ?></th>
		<th scope="col"><?= $this->Paginator->sort('プレイリスト名') ?></th>
		<th scope="col"><?= $this->Paginator->sort('最終更新日') ?></th>
		<th scope="col"><?= $this->Paginator->sort('Actioin') ?></th>
		<th scope="col">操作</th>
	</tr>
	<?php foreach($mylists as $mylist): ?>
		<tr>
			<td><?= $this->Number->format($mylist->id) ?></td>
			<td><?= h($mylist->title) ?></td>
			<td><?= h($mylist->modified) ?></td>
			<td><?= $this->Html->link("編集",["action" => "edit",$playlist->id]) ?>
				<?= $this->Html->link("削除",['controller'=>'Playlists','action'=>'delete',$playlist->id]) ?>
			</td>
		</tr>
	</table>
<?php endforeach; ?>
	
	
	