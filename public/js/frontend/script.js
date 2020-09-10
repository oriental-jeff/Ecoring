$(document).ready(function() {

    (function(e) {
        e.fn.visible = function(t, n, r) {
            var i = e(this).eq(0),
                s = i.get(0),
                o = e(window),
                u = o.scrollTop(),
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

    jQuery(window).scroll(function(event) {

        jQuery("#firstbox").each(function() {
            if ($("#firstbox").visible(true)) {
                $('body').removeClass("down");
            } else {
                $('body').addClass("down");
            }
        });
    });
    
	if ($(window).width() < 768) {
		$(".box-branch .list").click(function() {
			$(this).find('.head-off-on').toggleClass('open');
			$(this).siblings().find('.head-off-on').removeClass('open');
			$(this).find(' .text-off-on').slideToggle();
			$(this).siblings().find(' .text-off-on').slideUp()
		});
	}
	
	$(document).on('click', 'a[href^="#"]', function (event) {
	    event.preventDefault();
	
	    $('html, body').animate({
	        scrollTop: $($.attr(this, 'href')).offset().top-90
	    }, 500);
	});
	
	$('header ul.box-menu').css('padding-right',$('.box-social-lang').width()+'px');

});