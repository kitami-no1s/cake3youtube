<?php $this->prepend('script',$this->Html->script('youtube_api_playlist.js')); ?>
<h1 class="page-header" id="<?= $playlist_id ?>" ><?= h($playlist->title)?>詳細</h1>
<div id=result></div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>