//ビデオID
var videoId;
// 再生中の動画のタイトル
// ログインしているユーザのid
var login_user_id;
var title;
// 再生中の動画のサムネ
var thum;
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
	$('#main_box').show();
}
// プレイヤが準備できたら呼び出される
function onPlayerReady(event){
	event.target.playVideo();
}

// 画面がロードされたら作動
$(function() {
	$('#main_box').hide();
	$(window).on('load', getVideoId);
	$('#addVideoButton').on('click',addToMyplaylist);
	$('#addCommentButton').on('click',addComment);
	
	
});

// GETで持ってきたvideoIdを取得
function getVideoId(event){
	$('#loading').fadeIn();
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
		v_code = videoId;
 		$('#movie_title').html(title);
		$('.description').html(data.items[0].snippet.description);
	});
	
	$('#loading').fadeOut();
	
};

// コメントをAjaxでとってくる
function getComments(){
	console.log(videoId);
	if(login_user_id==null){
		$.ajax({
			url:"/cake3youtube/comments/commentsajax",
			type: "POST",
			data: {
				'v_code' : videoId,
			},
			dataType:"json",
			success:writeComments,
			error:adminAddVideoError
		});
	}else{
		$.ajax({
			url:"/cake3youtube/admin/comments/commentsajax",
			type: "POST",
			data: {
				'v_code' : videoId,
			},
			dataType:"json",
			success:writeComments,
			error:adminAddVideoError
		});
	}
}
// とってきたら書き込む
function writeComments(data){
	console.log(data);
	$("#comments").text('');
	for(var i in data['comments']){
		$("#comments").append(
				"<div id=comment><p>投稿者:" + data['comments'][i].user.name +  "</p>" +
				"<p>"+ data['comments'][i].body +"</p><p>" + data['comments'][i].created + "</p>" +
				"</div>");
	}
	
}
// コメントが投稿されたら発動
function addComment(event){
	var body =  $('#addComment [name=body]').val();
	$('#addComment [name=body]').val('');
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
		var obj=$("[name='" + key +"']");
		obj.parent().addClass('has-error');
		var field = errors[key];
		for(var value in field){
			var tag ='<div class="help-block">' + field[value] + '</div>';
			obj.after(tag);
		}
	}
}