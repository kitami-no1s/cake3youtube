//ビデオID
var videoId;
var login_user_id;
var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
//Iframe Player APIを非同期にロード
var tag = document.createElement('script');
tag.src = 'http://www.youtube.com/player_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);


var player;


function startPlayer(){
	player = new YT.Player('player',{
		height:'390',
		width:'640',
		videoId:videoId,
		events:{
			'onReady':onPlayerReady
		}
	});
}
//プレイヤが準備できたら呼び出される
function onPlayerReady(event){
	event.target.playVideo();
}

//画面がロードされたら作動
$(function() {
	$(window).on('load', getVideoId);
	
});

//GETで持ってきたvideoIdを取得
function getVideoId(event){
	videoId = $('#player').data("videoid");
	login_user_id = $('#player').data("login_user_id")
	console.log(videoId);
	search_related(videoId);
	startPlayer();
}

function search_related(videoId) {
	gapi.client.setApiKey(apiKey);
	gapi.client.load('youtube','v3',function(){
	});
	var request = gapi.client.request({
		'path': '/youtube/v3/search',
		'params':{
			'type': 'video',
			'relatedToVideoId':videoId,
			'maxResults':20,
			'part': 'snippet',
		}
	});
	request.execute(function(data){
		console.log(data);
		$('#related').text('');
		$('#related').append('<table>');
		for(var i in data.items){
			if(data.items[i].id.videoId && 
				data.items[i].id.kind=="youtube#video"){
				if(login_user_id == null){
				$('#related table').append(
						'<tr class="movie_box" id="' + data.items[i].id.videoId + '">' +
						'<td class="thum">' +
						'<img src="' + data.items[i].snippet.thumbnails.default.url + '" width="200px"/>' +
						'</td>' + '<td class="details">' + 
						'<a href="http://localhost/cake3youtube/videos/play?videoId=' +
						data.items[i].id.videoId + '">'+ data.items[i].snippet.title + '</a><br/>' +
						'<span class="description"></span>' +
						'</td>'+
						'</tr>');
				}else{
				$('#related table').append(
						'<tr class="movie_box" id="' + data.items[i].id.videoId + '">' +
						'<td class="thum">' +
						'<img src="' + data.items[i].snippet.thumbnails.default.url + '" width="200px"/>' +
						'</td>' + '<td class="details">' + 
						'<a href="http://localhost/cake3youtube/admin/videos/play?videoId=' +
						data.items[i].id.videoId + '">'+ data.items[i].snippet.title + '</a><br/>' +
						'<span class="description"></span>' +
						'</td>'+
						'</tr>');
				}
			}
		}
	});
}