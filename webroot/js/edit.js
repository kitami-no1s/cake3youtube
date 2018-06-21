$(function(){
	$("#button").on('click',adminVideoDeleteRequest);
});
function adminVideoDeleteRequest(event){
	 adminDeleteFormInit();
	 var v_code=[];
     $("[name='v_code[]']:checked").each(function(){
         v_code.push(this.value);
     });
     var playlist_id = $('.index').attr('id');
     $.ajax({
         type: "POST",
         url: "/cake3youtube/admin/mylists/deleteajax",
         data: {
             "v_code":v_code,
             "playlist_id":playlist_id
         },
 		dataType:"json",
 		success:adminDeleteVideoSuccess,
 		error:adminDeleteVideoError
     });
}

function adminDeleteFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}
function adminDeleteVideoSuccess(result){
	if(result['status'] == 'success'){
		showSuccessMessage("削除しました")
	}else{
		showErrorMessage("削除に失敗しました");
		showValidationMessage(result['errors']);
	}
}

function adminDeleteVideoError(result){
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
$(function(){
	$('#sortable-table1 tbody').sortable();
});