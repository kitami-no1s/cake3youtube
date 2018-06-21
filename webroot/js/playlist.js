//ビデオID
var videoId;
//再生中の動画のタイトル
var title;
//再生中の動画のサムネ
var thum;
var apiKey = 'AIzaSyDkQYaQ7QLoV_RG2ltkPvsptAsvATJXwD8';
//Iframe Player APIを非同期にロード
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
//プレイヤが準備できたら呼び出される
function onPlayerReady(event){
	event.target.playVideo();
}

//画面がロードされたら作動
$(function() {
	$(window).on('load', getVideoId);
	$('#addVideoButton').on('click',addToMyplaylist);
	
});

//GETで持ってきたvideoIdを取得
function getVideoId(event){
	videoId = $('#player').data("video_id");
	login_user_id = $('#player').data("login_user_id");
	console.log(videoId);
	getVideoInfo(videoId);
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
		v_code = videoId;
 		$('#movie_title').html(title);
		$('#description').html(data.items[0].snippet.description);
	});
};
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
		var obj=$("[name='" + key +"']");
		obj.parent().addClass('has-error');
		var field = errors[key];
		for(var value in field){
			var tag ='<div class="help-block">' + field[value] + '</div>';
			obj.after(tag);
		}
	}
}