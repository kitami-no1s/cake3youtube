<div id="all-playlists">
<h2>公開されているプレイリスト一覧</h2>
<table class="table table-striped" cellpading="0" cellspacing="0">
<?php foreach($playlists as $playlist): ?>
<tr>
	<td><?= $this->Number->format($playlist->id) ?></td>
	<td><?= h($playlist->title) ?></td>
	<td><?= $this->Html->link("表示",["action" => "view",$playlist->id]) ?>
</tr>
<?php endforeach; ?>
</table>
</div>

<div id="my-playlists">
<h2>マイプレイリスト一覧</h2>
<table class="table table-striped" cellpading="0" cellspacing="0">
<?php foreach($myplaylists as $myplaylist): ?>
<tr>
	<td><?= $this->Number->format($myplaylist->id) ?></td>
	<td><?= h($myplaylist->title) ?></td>
	<td><?= $this->Html->link("表示",["action" => "view",$playlist->id]) ?>
</tr>
<?php endforeach; ?>
</table>
</div>