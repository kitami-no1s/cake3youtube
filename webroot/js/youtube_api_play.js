//ビデオID
var videoId;
// ログインしているユーザのid
var login_user_id;
// 再生中の動画のタイトル
var title;
// 再生中の動画のサムネ
var thum;
var v_code;
var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
// Iframe Player APIを非同期にロード
var tag = document.createElement('script');
tag.src = 'http://www.youtube.com/player_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);


var player;

function addToMyplaylist(event){
	adminPlaylistFormInit()
	var playlist_id = $('#addVideo [name=playlist_id]').val();
	console.log(playlist_id);
	$.ajax({
		url:"/cake3youtube/admin/playlist-videos/addajax",
		type: "POST",
		data: {
			playlist_id : playlist_id,
			title : title,
			thum : thum,
			v_code : v_code
		},
		dataType:"json",
		success:adminAddVideoSuccess,
		error:adminAddVideoError
	});
}
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
// プレイヤが準備できたら呼び出される
function onPlayerReady(event){
	event.target.playVideo();
}

// 画面がロードされたら作動
$(function() {
	$(window).on('load', getVideoId);
	$('#addVideoButton').on('click',addToMyplaylist);
	$('#addCommentButton').on('click',addComment);
	
});

// GETで持ってきたvideoIdを取得
function getVideoId(event){
	videoId = $('#player').data("video_id");
	login_user_id = $('#player').data("login_user_id");
	console.log(videoId);
	getVideoInfo(videoId);
	getComments();
	startPlayer();
}

function getVideoInfo(videoId)
{
	gapi.client.setApiKey(apiKey);
	gapi.client.load('youtube','v3',function(){
	});
	var request = gapi.client.request({
		'path': '/youtube/v3/videos',
		'params':{
			'id':videoId,
			'part': 'snippet',
		}
	});
	request.execute(function(data){
		console.log(data);
		title = data.items[0].snippet.title;
		thum = data.items[0].snippet.thumbnails.default.url;
 		$('#movie_title').html(title);
		$('#description').html(data.items[0].snippet.description);
	});
	search_related(videoId);
	
};
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
				data.items[i].id.kind　==　"youtube#video"){
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
// コメントをAjaxでとってくる
function getComments(){
	console.log(videoId);
	$.ajax({
		url:"/cake3youtube/admin/comments/commentsajax",
		type: "POST",
		data: {
			'v_code' : videoId,
		},
		dataType:"json",
		success:writeComments
	});
}
// とってきたら書き込む
function writeComments(data){
	console.log(data);
	for(var i in data){
		$("#comments").append(
				"<div id=comment><p>" + data[i].body + "</p>" +
				"<p>" + data[i].user.name + "</p><p>" + data[i].create + "</p>" +
				"</div>");
	}
}
// コメントが投稿されたら発動
function addComment(event){
	var body =  $('#addComment [name=body]').val();
	$.ajax({
		url:"/cake3youtube/admin/comments/addajax",
		type: "POST",
		data: {
			'body':body,
			'v_code':videoId,
		},
		dataType:"json",
		success:getComments
	});
}
function adminPlaylistFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}
function adminAddVideoSuccess(result){
	if(result['status'] == 'success'){
		showSuccessMessage("お気に入りに追加しました")
	}else{
		showErrorMessage("お気に入り追加に失敗しました");
		showValidationMessage(result['errors']);
	}
}

function adminAddVideoError(result){
	showErrorMessage("エラーが発生しました");
}

function showSuccessMessage(message){
	var tag = '<div id="message" class="alert alert-success">';
	tag += message;
	tag += '</div>';
	$('.main').prepend(tag);
}

function showErrorMessage(message){
	var tag = '<div id="message" class="alert alert-danger">';
	tag += message;
	tag += '</div>';
	$('.main').prepend(tag);
}

function showValidationMessage(errors){
	for(key in errors){
		var obj　=　$("[name='" + key +"']");
		obj.parent().addClass('has-error');
		var field = errors[key];
		for(var value in field){
			var tag =　'<div class="help-block">' + field[value] + '</div>';
			obj.after(tag);
		}
	}
}