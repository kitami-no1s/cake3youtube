<?php $this->prepend('script',$this->Html->script('youtube_api_play.js')); ?>
<div id="main_box" class="clearfix">
	<div id="contents">
		<div id="movie_title"></div>
		<!-- <iframe>(とプレイヤ)に置き換わる<div>タグ -->
		<div id="player" data-video_id="<?= $video_id ?>"></div>
		<p class="description"></p>
	<div id="comments"></div>
	</div>
	<div id="related" class="pull-left"></div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>