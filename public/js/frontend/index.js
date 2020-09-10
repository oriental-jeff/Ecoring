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

        jQuery(".box-Register").each(function() {
            if ($(".box-Register").visible(true)) {
                myBGscroll();
            }
        });
        
    });
});
function myBGscroll() {
	var sct = $(window).scrollTop()/12-50;
	$('section.box-content').css('background-position-y','calc((100% + 70px) - '+sct+'px)');
	$('section.box-Register').css('background-position-y','calc(-70px - '+sct+'px)');
}