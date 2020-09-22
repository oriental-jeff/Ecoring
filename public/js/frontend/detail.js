$(document).ready(function() {
	
	$('#Boxheight').css('min-height',$('.box-left-sticky').height());
	$('.box-left-sticky').css('height',$('#Boxheight').height());
	
	if($('#b-Toggle .b-Toggle').height()<= 160){
		$('#button-Toggle1,#button-Toggle2').hide();
		$('#b-Toggle').addClass('open');
	}
	if($('#b-Toggle2 .b-Toggle').height()<= 160){
		$('#button-Toggle3,#button-Toggle4').hide();
		$('#b-Toggle2').addClass('open');
	}

});
