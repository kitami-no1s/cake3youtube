<?php $this->prepend('script',$this->Html->script('playlist.js')); ?>
<div id="loading"></div>
<div id="main_box" class="clearfix">
	<div id="contents">
		<div id="movie_title"></div>
		<!-- <iframe>(とプレイヤ)に置き換わる<div>タグ -->
		<div id="player" data-video_id="<?= $v_code ?>" data-login_user_id = "<?= $login_user_id ?>"></div>
		<p class="description"></p>
		<div>
			<?= $this->Form->create("Comments",[
				"id"=>"addComment"
			])	?>
			<?= $this->Form->input("body") ?>
			<?= $this->Form->button("投稿",["type"=>"button","id"=>"addCommentButton"]); ?>
			<?= $this->Form->end(); ?>
		</div>
	<div id="comments"></div>
	</div>
	<div id="related" class="pull-left">
	<table>
	<?php foreach($playlist as $video): ?>
	
	<tr class="movie_box" id=<?= $video->v_code ?>>
		<td class="thum">
		<img src="<?= $video->thum ?>" width="200px"/>
		</td>
		<td class="details"> 
		<a href="http://localhost/cake3youtube/admin/playlists/play/<?= $video->playlist_id ?>/<?= $video->v_code ?>
		"><?= $video->title ?></a><br/>
		
		</td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	</div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>