<div id="all-playlists">
<h2>公開されているプレイリスト一覧</h2>
<table class="index">
<?php foreach($playlists as $playlist): ?>
<?php if($playlist->public == 1): ?>
<tr>
	<td><?= h($playlist->title) ?></td>
	<td><?= h($playlist->user->name) ?></td>	
	<td><?= $this->Html->link("動画一覧",["action" => "view",$playlist->id]) ?></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
</table>
</div>

<div id="my-playlists">
<h2>マイプレイリスト一覧</h2>
<table class="index">
<?php foreach($myplaylists as $myplaylist): ?>
<tr>
	<td><?= h($myplaylist->title) ?></td>
	<td><?= $this->Html->link("動画一覧",["action" => "view",$myplaylist->id]) ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>