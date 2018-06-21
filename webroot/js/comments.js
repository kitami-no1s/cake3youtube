$(function(){
	$(window).on('load',getComments);
});

function getComments(event){
	videoId = $('#player').data("video_id");
	$.ajax({
		url:"/cake3youtube/admin/comments/getcommentajax",
		type: "POST",
		data: videoId,
		dataType:"json",
		success:writeComments
	});
}

function writeComments(data){
	for(var i in data){
		if(data)
		$("#comments").append(
				"<div id=comment><p>" + data[i].body + "</p>" +
				"<p>" + data[i].user.name + "</p><p>" + data[i].create + "</p>" +
				"</div>");
	}
}