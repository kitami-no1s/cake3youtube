var keyword;
$(function(){
	$('#search_btn').on('click',function(){
			$(this).attr('disabled',true);
			if($('form [name=keyword]').val() == ""){
				window.alert('検索ワードを入れてください');
				$(this).attr('disabled',false);
				return false;
			}else{
				$('form').submit();
				keyword = $('form [name=keyword]').val();
				
			}
	});
});