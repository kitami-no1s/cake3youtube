<?php $this->prepend('script',$this->Html->script('youtube_api_play.js')); ?>
<?php $this->prepend('script',$this->Html->script('comments.js')); ?>
<div id="main_box" class="clearfix">
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
		<div id="player" data-video_id="<?= $video_id ?>" data-login_user_id = "<?= $login_user_id ?>"></div>
		<p id="description"></p>
		<div id="comments">
		<?php foreach($comments as $comment){ ?>
			<div id="comment"><p><?= h($comment->user->name) ?></p>
							  <p><?= h($comment->body) ?></p>
							  <p><?= h($comment->created) ?></p>
			</div>
		<?php } ?>
		</div>
	</div>
	<div id="related" class="pull-left"></div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>