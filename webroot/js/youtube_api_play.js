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
	$('#addVideoButton').attr('disabled',true);
	adminPlaylistFormInit()
	var playlist_id = $('#addVideo [name=playlist_id]').val();
	$.ajax({
		url:"/cake3youtube/admin/playlist-videos/addajax",
		type: "POST",
		data: {
			playlist_id : playlist_id,
			title : title,
			thum : thum,
			v_code : videoId
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
	$('#loading').fadeIn();
	$('#main_box').hide();
	$(window).on('load', getVideoId);
	$('#addVideoButton').on('click',addToMyplaylist);
	$('#addCommentButton').on('click',addComment);
	
});

var keyword;
// GETで持ってきたvideoIdを取得
function getVideoId(event){
	keyword = $('#keyword').val();
	videoId = $('#player').data("video_id");
	login_user_id = $('#player').data("login_user_id");
	getVideoInfo(videoId);
	startPlayer();
	getComments();
	
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
		$('.description').html(data.items[0].snippet.description);
	});
	if($('#main_box').hasClass('search')){
	    search_related(videoId);
	}else{
		$('#main_box').show();
		$('#loading').fadeOut();
		changeHighlight(videoId)
	}
};

//プレイリスト再生中背景
function changeHighlight(videoId){
	$('.movie_box').each(function(){
		if ( $(this).hasClass("highlight") ){
			$(this).removeClass("highlight");
		}
		if(videoId == $(this).attr('id')){
			$(this).addClass('highlight');
		}
	});	
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
		$('#related').append('<table class="table table-striped" cellpadding="0" cellspacing="0">');
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
						data.items[i].id.videoId +  '&keyword=' + keyword + '">'+ data.items[i].snippet.title + '</a><br/>' +
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
						data.items[i].id.videoId + '&keyword=' + keyword +'">'+ data.items[i].snippet.title + '</a><br/>' +
						'<span class="description"></span>' +
						'</td>'+
						'</tr>');
				}
			}
		}
	});
	$('#main_box').show();
	$('#loading').fadeOut();
}
// コメントをAjaxでとってくる
function getComments(){
	console.log(videoId);
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
	$('#addCommentButton').attr('disabled',false);
	
}
// コメントが投稿されたら発動
function addComment(event){
	$('#addCommentButton').attr('disabled',true);
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
		success:getComments,
		error: adminAddVideoError
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
	$('#addVideoButton').attr('disabled',false);
}

function showErrorMessage(message){
	var tag = '<div id="message" class="alert alert-danger">';
	tag += message;
	tag += '</div>';
	$('.main').prepend(tag);
	$('#addVideoButton').attr('disabled',false);
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
		$('#addVideoButton').attr('disabled',false);
	}
}