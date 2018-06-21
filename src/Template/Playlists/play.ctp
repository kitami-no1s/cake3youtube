<?php $this->prepend('script',$this->Html->script('playlist.js')); ?>
<div id="main_box" class="clearfix">
	<div id="contents">
		<div id="movie_title"></div>
		<!-- <iframe>(とプレイヤ)に置き換わる<div>タグ -->
		<div id="player" data-video_id="<?= $v_code ?>"></div>
		<p id="description"></p>
	</div>
	<div id="related" class="pull-left">
	<table>
	<?php foreach($playlist as $video): ?>
	
	<tr class="movie_box" id=<?= $video->v_code ?>>
		<td class="thum">
		<img src="<?= $video->thum ?>" width="200px"/>
		</td>
		<td class="details"> 
		<a href="http://localhost/cake3youtube/playlists/play/<?= $video->playlist_id ?>/<?= $video->v_code ?>
		"><?= $video->title ?></a><br/>
		<span class="description"></span>
		</td>
		</tr>
	<?php endforeach; ?>
	
	
	</table>
	</div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>