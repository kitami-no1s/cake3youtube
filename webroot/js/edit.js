

$(function(){
	$('#sortable-table1 tbody').sortable();
	$("#sort").on('click',arrayVideos);
	/*$(".select").hover(
			function(){
				 $('#').css('background-color', 'red');
			},
			function(){
				 $('.select').css('background-color', 'white');
			}
			);
		*/
});
function arrayVideos(event)
{
	adminVideosSortFormInit();
	var id = $('#sortable-table1 tbody').sortable("toArray");
	var playlist_id = $('#sortable-table1').data('playlist_id');
	
	$.ajax({
		url: "/cake3youtube/admin/mylists/sortajax",
		type: "POST",
		data: {
				id : id,
				playlist_id : playlist_id
		},
		dataType: "json",
		success: adminVideosSortSuccess,
		error: adminVideosSortError,
	});
}
function adminVideosSortFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}

function adminVideosSortSuccess(result){
	if(result['status'] == 'success'){
		showSuccessMessage("並び替えました");
	}else{
		showErrorMessage("並び替えに失敗しました");
		showValidationMessage(result['errors']);
	}
	
}
function adminVideosSortError(result){
	showErrorMessage("エラーが発生しました");
}
function showSuccessMessage(message){
	var tag = '<div id="message" class="alert alert-success">';
	tag += message;
	tag +='</div>';
	$('.main').prepend(tag);
}
function showErrorMessage(message){
	var tag = '<div id="message" class="alert alert-danger">';
	tag += message;
	tag +='</div>';
	$('.main').prepend(tag);
}
function showValidation(errors){
	for(key in errors){
		var obj = $("[name'" + key + "']");
		obj.parent().addClass('has-error');
		var field = errors[key];
		for(var value in field){
			var tag = '<div class="help-block">' + field[value] +'</div>';
			obj.after(tag);
		}
	}
}




/*

$(function(){
	$('#sortable-table1 tbody').sortable();
	$("#sort").on('click',arrayVideos);
	$("#delete").on('click',deleteVideos);
});
function deleteVideos(event){
	
	$("#form").attr("action","/cake3youtube/admin/mylists/delete").submit();
}

function arrayVideos(event){
	 var result = $("#sortable-table1 tbody").sortable("toArray");
     $("#result").val(result);
     $("form").submit();
}
*/