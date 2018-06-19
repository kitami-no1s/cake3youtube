<h1 class="page-header">公開されているプレイリスト一覧</h1>
<table class="table table-striped" cellpading="0" cellspacing="0">
<?php foreach($playlists as $playlist): ?>
<tr>
	<td><?= $this->Number->format($playlist->id) ?></td>
	<td><?= h($playlist->title) ?></td>
	<td><?= $this->Html->link("表示",["action" => "view",$playlist->id]) ?>
</tr>
<?php endforeach; ?>
</table>
