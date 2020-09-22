$(document).ready(function() {
	boxSlide();
	boxType();
});
function boxSlide() {
	$(".box-slide .owl-carousel").owlCarousel({
		loop:true,
		margin:30,
		nav:true,
		dots:true,
		lazyLoad:true,
		navText: ["<img src='../../images/icon-arrow.png'>","<img src='../../images/icon-arrow.png'>"],
		responsiveClass:true,
		responsive:{
			0:{
				items:1
			},
		},
		afterAction: function(current) {
	        current.find('video').get(0).play();
	    }
	});
}
function boxType() {
	$(".box-Type .owl-carousel").owlCarousel({
		loop:true,
		nav:false,
		dots:false,
		lazyLoad:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:2
			},
			600:{
				items:3
			},
			700:{
				items:4
			},
			800:{
				items:5
			},
		}
	});
    $('.box-Type .o-prev').click(function() {
        $('.box-Type .owl-prev').click();
    });
    $('.box-Type .o-next').click(function() {
        $('.box-Type .owl-next').click();
    });
}
