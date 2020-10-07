$(document).ready(function() {
    (function(e) {
        e.fn.visible2 = function(t, n, r) {
            var i = e(this).eq(0),
                s = i.get(0),
                o = e(window),
                u = o.scrollTop()+window.innerHeight,
                a = u + o.height(),
                f = o.scrollLeft(),
                l = f + o.width(),
                c = i.offset().top,
                h = c + i.height(),
                p = i.offset().left,
                d = p + i.width(),
                v = t === true ? h : c,
                m = t === true ? c : h,
                g = t === true ? d : p,
                y = t === true ? p : d,
                b = n === true ? s.offsetWidth * s.offsetHeight : true,
                r = r ? r : "both";
            if (r === "both")
                return !!b && m <= a && v >= u && y <= l && g >= f;
            else if (r === "vertical")
                return !!b && m <= a && v >= u;
            else if (r === "horizontal")
                return !!b && y <= l && g >= f
        }
    })(jQuery)
    	
	boxSlide();
	boxType();
	lazyLoad();
	
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
function lazyLoad() {
	var list = $(".box-products .box-List.lazyload .list");
	var btn = $("#a-lazyload");
	
	// โหลดทีล่ะเท่าไร
	var n = 6;
	
	list.slice(n).hide();
    var mincount = n;
	var maxcount = n*2;
    jQuery(window).scroll(function(event) {
        if (!btn.visible2(true)) {
			list.slice(mincount,maxcount).fadeIn(1200);
			mincount = mincount+n;
			maxcount = maxcount+n;
			
			if(mincount > list.length ){
				btn.hide();
			}
        }
    });
}
