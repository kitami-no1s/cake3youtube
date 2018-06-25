<h1 class="page-header" ><?= h($playlist->title) ?></h1>
<div id=result></div>
<table>
<?php foreach($playlist_videos as $playlist_video): ?>
	<tr>
		<td><img src="<?= h($playlist_video->thum) ?>"/></td>
		<td><?= $this->Html->link($playlist_video->title,[
								"controller"=>"playlists","action" => "play",
								$playlist_video->playlist_id,$playlist_video->v_code,
								]) ?>
		</td>
	</tr>
<?php endforeach ?>
</table>
</div>