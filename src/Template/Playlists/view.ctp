<?php $this->prepend('script',$this->Html->script('youtube_api_playlist.js')); ?>
<h1 class="page-header" >詳細</h1>
<div id=result></div>
<table>
<?php foreach($playlist->playlist_videos->v_code as $video): ?>
	
	<td class="thum"></td>
	<td class="title"></td>
	</tr>
<?php //endforeach ?>
</table>
<script
src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>