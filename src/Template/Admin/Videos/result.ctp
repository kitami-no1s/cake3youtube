<?php $this->prepend('script',$this->Html->script('youtube_api_search.js')); ?>
<h1 class="page-header" id="<?= $keyword ?>" data-login_user_id="<?= $login_user_id ?>" >検索結果</h1>
<div id=result></div>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>