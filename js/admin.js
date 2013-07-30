$(document).ready(function(){
  	
	$('#add-group-button').click(function(e) {
		$('#add-group').submit();
	});

	$('.close').click(function(e) {
		$(this).parent().remove();
	});


});