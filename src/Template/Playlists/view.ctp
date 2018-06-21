<h1 class="page-header" ><?= h($playlist_title->title) ?></h1>
<div id=result></div>
<table>
<?php foreach($playlist_videos as $playlist_video): ?>
	<tr>
		<td><?= h($playlist_video->seq) ?></td>
		<td><img src="<?= h($playlist_video->thum) ?>"/></td>
		<td><?= h($playlist_video->title) ?></td>		
	</tr>
<?php endforeach ?>
</table>
</div>