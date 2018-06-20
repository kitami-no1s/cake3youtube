$(function() {
	$(window).on('load', getKeyword);
	
});
//検索ワード取得
function getKeyword(event) {
	var keyword = $(".page-header").attr("id");
	search(keyword);
}
//YoutubeAPIで検索
function search(keyword) {
	var videoId;
	var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
	gapi.client.setApiKey(apiKey);
	gapi.client.load('youtube','v3',function(){
	});
	var request = gapi.client.request({
		'path': '/youtube/v3/search',
		'params':{
			'q':keyword,
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
						'">'  + data.items[i].snippet.title + 
						'</a><br/>' +
						'<span class="description">'+ data.items[i].snippet.description + '</span>' +
						'</td>'+
						'</tr>');
			}
		}
	});
}
