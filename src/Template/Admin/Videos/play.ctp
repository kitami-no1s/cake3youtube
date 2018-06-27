<?php $this->prepend('script',$this->Html->script('youtube_api_play.js')); ?>
<div id="loading"></div>
<div id="main_box" class="clearfix search">
	<div id="contents">
		<?php
		echo $this->Form->create("PlaylistVideos",[
			"id"=>"addVideo"
		]);
		echo $this->Form->input('playlist_id',['options' => $myplaylists,"empty"=>"選択"]);
		echo $this->Form->button("登録",["type"=>"button","id"=>"addVideoButton"]);
		echo $this->Form->end();
		?>
		<div id="movie_title"></div>
		<!-- <iframe>(とプレイヤ)に置き換わる<div>タグ -->
		<div id="player" data-video_id="<?= $video_id ?>" data-login_user_id = "<?= $login_user_id ?>" data-keyword="<?= $keyword ?>"></div>
		<p class="description"></p>
		<div>
		<?= $this->Form->create("Comments",[
			"id"=>"addComment"
		])	?>
		<?= $this->Form->input("body") ?>
		<?= $this->Form->button("投稿",["type"=>"button","id"=>"addCommentButton"]); ?>
		<?= $this->Form->end(); ?>
		</div>
		<div id="comments">
		</div>
	</div>
	<div id="related" class="pull-left"></div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>