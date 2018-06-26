<div class ="row" id="playlists">
	<div class="col-md-6" id="public-playlists">
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
	</div>
	<div class="col-md-6" id="my-playlists">
		<h2 class="page-header">マイプレイリスト一覧</h2>
		<table class="table table-striped" cellpadding="0" cellspacing="0" id="indexplaylist">
			<?php foreach($myplaylists as $myplaylist): ?>
			<tr>
				<td><?= h($myplaylist->title) ?></td>
				<td><?= h($myplaylist->user->name)  ?></td>
				<td><?= $this->Html->link("動画一覧",["action" => "view",$myplaylist->id]) ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
