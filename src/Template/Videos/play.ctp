<?php $this->prepend('script',$this->Html->script('youtube_api_play.js')); ?>
<div id="loading"></div>
<div id="main_box" class="clearfix search">
	<div id="contents">
		<div id="movie_title"></div>
		<!-- <iframe>(とプレイヤ)に置き換わる<div>タグ -->
		<div id="player" data-video_id="<?= $video_id ?>" data-keyword="<?= $keyword ?>"></div>
		<p class="description"></p>
	<div id="comments"></div>
	</div>
	<div id="related" class="pull-left"></div>
</div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>