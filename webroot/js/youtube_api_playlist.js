$(function() {
	$(window).on('load', getPlaylist_id);
	
});
//プレイリスト取得
function getPlaylist_id(event) {
	var playlist_id = $(".page-header").attr("id");
	search(playlist_id);
}
//YoutubeAPIで検索
function search(playlist_id) {
	var videoId;
	var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
	gapi.client.setApiKey(apiKey);
	gapi.client.load('youtube','v3',function(){
	});
	var request = gapi.client.request({
		'path': '/youtube/v3/search',
		'params':{
			'q':playlist_id,
			'type': 'video',
			'relatedToVideoId':videoId,
			'maxResults':20,
			'part': 'snippet',
		}
	});
	//Templateに描画
	request.execute(function(data){
		console.log(data);
		$('#result').text('');
		$('#result').append('<table>');
		for(var i in data.items){
			if(data.items[i].id.videoId && 
				data.items[i].id.kind=="youtube#video"){
				//関連動画をリストに追加
				$('#result table').append(
						'<tr class="movie_box">' + 
						'<td class="thum">' +
						'<img src="' + data.items[i].snippet.thumbnails.default.url + '"/>' +
						'</td>' + '<td class="details">' +
						'<a href="http://localhost/cake3youtube/videos/play?videoId='
						+ data.items[i].id.videoId  +
						'&keyword=' + keyword + '" target="_blank">'  + data.items[i].snippet.title + 
						'</a><br/>' +
						'<span class="description">'+ '' + '</span>' +
						'</td>'+
						'</tr>');
			}
		}
	});
}
