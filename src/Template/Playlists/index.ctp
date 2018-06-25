<h2 class="page-header">公開されているプレイリスト一覧</h2>
<table class="table table-striped" cellpadding="0" cellspacing="0" id="indexplaylist">
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
