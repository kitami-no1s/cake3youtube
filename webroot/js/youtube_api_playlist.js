$(function() {
	$(window).on('load');
	
});

var video_Id="7DwAwNNHaW8";

//YoutubeAPIで検索
function search(video_Id) {
	var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
	gapi.client.setApiKey(apiKey);
	gapi.client.load('youtube','v3',function(){
	});
	var request = gapi.client.request({
		'path': '/youtube/v3/search',
		'params':{
			'type': 'video',
			'relatedToVideoId':video_Id,
			'maxResults':20,
			'part': 'snippet',
		}
	});
	//Templateに描画
	request.execute(function(data){
		console.log(data);
		for(var i in data.items){
			if(data.items[i].id.videoId && 
				data.items[i].id.kind=="youtube#video"){
				//関連動画をリストに追加
				$('.thum').html('<img src="' + data.items[i].snippet.thumbnails.default.url + '"/>');
				
			}
		}
	});
}
