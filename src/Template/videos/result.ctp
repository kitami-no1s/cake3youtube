<?php $this->prepend('script',$this->Html->script('youtube_api_search.js')); ?>
<h1 class="page-header" id="<?= $keyword ?>">検索結果</h1>
<div id="result"></div>
<div id="loading"></div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>