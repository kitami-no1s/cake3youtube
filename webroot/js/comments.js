$(function(){
	$(window).on('load',getComments);
});

function getComments(event){
	videoId = $('#player').data("video_id");
	$.ajax({
		url:"/cake3youtube/admin/comments/getcommentajax",
		type: "POST",
		data: videoId,
		dataType:"json"
	});
}

function writeComments(){}