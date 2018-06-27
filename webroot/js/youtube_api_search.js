$(function() {
	$('#search_btn').attr('disabled',true);
	$(window).on('load', getKeyword);
	$('#loading').fadeIn();
	
});
var login_user_id;
//検索ワード取得
function getKeyword(event) {
	$('#result').hide();
	var keyword = $(".page-header").attr("id");
	$('form [name=keyword]').val(keyword);
	login_user_id = $(".page-header").data("login_user_id");
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
		$('#result').append('<table class="table table-striped" cellpadding="0" cellspacing="0">');
		for(var i in data.items){
			if(data.items[i].id.videoId && 
				data.items[i].id.kind=="youtube#video"){
				if(login_user_id == null){
				//関連動画をリストに追加
				$('#result table').append(
						'<tr class="movie_box">' + 
						'<td class="thum">' +
						'<img src="' + data.items[i].snippet.thumbnails.default.url + '"/>' +
						'</td>' + '<td class="details">' + 
						'<a href="http://localhost/cake3youtube/videos/play?videoId='+ data.items[i].id.videoId  + '&keyword=' + keyword + '">'
						+ data.items[i].snippet.title + 
						'</a><br/>' +
						'<span class="description">'+ data.items[i].snippet.description + '</span>' +
						'</td>'+
						'</tr>');
				}else{
					$('#result table').append(
						'<tr class="movie_box">' + 
						'<td class="thum">' +
						'<img src="' + data.items[i].snippet.thumbnails.default.url + '"/>' +
						'</td>' + '<td class="details">' + 
						'<a href="http://localhost/cake3youtube/admin/videos/play?videoId='
						+ data.items[i].id.videoId + '&keyword=' + keyword + '">'
						+ data.items[i].snippet.title + 
						'</a><br/>' +
						'<span class="description">'+ data.items[i].snippet.description + '</span>' +
						'</td>'+
						'</tr>');						
				}
				
			}
		}
		
		$('#loading').fadeOut();
		$('#result').show();
		$('#search_btn').attr('disabled',false);
	});
}