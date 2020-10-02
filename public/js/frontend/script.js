$(document).ready(function () {

    (function (e) {
        e.fn.visible = function (t, n, r) {
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

    jQuery(window).scroll(function (event) {

        jQuery("#firstbox").each(function () {
            if ($("#firstbox").visible(true)) {
                $('body').removeClass("down");
                $('#menuCategory').slideDown();
            } else {
                $('body').addClass("down");
                $('#menuCategory').slideUp();
            }
        });
    });

    sliderCategory();
    sliderBanner();
    sliderTRemaining();
    sliderRelate();
    slidershowImg();

    $("#button-hourglass").click(function () {
        $(this).toggleClass('active');
    });
    $("#btn-close").click(function () {
        $('#button-hourglass').removeClass('active');
    });

    $(".box-footer .list").click(function () {
        $(this).find('.head-off-on').toggleClass('open');
        $(this).siblings().find('.head-off-on').removeClass('open');
        $(this).find(' .text-off-on').slideToggle();
        $(this).siblings().find(' .text-off-on').slideUp()
    });

    $('.btn-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $('.btn-group .btn-plus').click(function () {
        var n1 = $(this).closest(".btn-group").find("input").val();
        $(this).closest(".btn-group").find(".btn-delete").removeClass('disabled');

        $(this).closest(".btn-group").find("input").val(parseInt(n1) + 1);
        calAmount($this);
    });
    $('.btn-group .btn-delete').click(function () {
        var n2 = $(this).closest(".btn-group").find("input").val();
        if (parseInt(n2) == 2) {
            $(this).closest(".btn-group").find(".btn-delete").addClass('disabled');
        }

        if (parseInt(n2) > 1) {
            $(this).closest(".btn-group").find("input").val(parseInt(n2) - 1);
            calAmount($this);
        }
    });

    $('.box-products .box-List .btn').on('click', function () {
        if ($(window).width() < 1025) {
            var cart = $('#boxOfProductmobile');
        } else {
            var cart = $('#boxOfProduct');
        }
        var imgtodrag = $(this).closest('.list').find(".img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.9',
                    width: imgtodrag.width(),
                    height: imgtodrag.height(),
                    'position': 'absolute',
                    'z-index': '1031'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 40,
                    'height': 28
                }, 1000, 'easeInOutExpo');
            if ($(window).width() < 1025) {
                $('body').css('overflow', 'hidden');
            }

            setTimeout(function () {
                cart.effect("shake", {
                    times: 2,
                    distance: 10
                }, 300);
            }, 1500);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
                $('body').css('overflow', '');
                // ฟังก์ชันเมื่อย้ายตำแหน่ง เสร็จต้องการให้ทำอะไร
                // สามารถนำไปประยุกต์ เพิ่มสินค้าในตะกร้าสินค้า ด้วย ajax
                // alert('เพิ่มสินค้า');
            });
        }
    });

});

function sliderCategory() {
    $(".menu-category .owl-carousel").owlCarousel({
        margin: 20,
        nav: true,
        dots: false,
        lazyLoad: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 4
            },
            700: {
                items: 5
            },
            800: {
                items: 6
            },
            900: {
                items: 7
            },
        }
    });
}

function sliderBanner() {
    $(".box-banner .owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        lazyLoad: true,
        navText: ["<img src='../../images/icon-arrow.png'>", "<img src='../../images/icon-arrow.png'>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
        },
        afterAction: function (current) {
            current.find('video').get(0).play();
        }
    });
}

function sliderRelate() {
    $(".box-relate .owl-carousel").owlCarousel({
        margin: 20,
        nav: false,
        loop: false,
        dots: false,
        lazyLoad: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2
            },
            700: {
                items: 4
            },
            800: {
                items: 5
            }
        }
    });
    $('.box-relate .o-prev').click(function () {
        $('.box-relate .owl-prev').click();
    });
    $('.box-relate .o-next').click(function () {
        $('.box-relate .owl-next').click();
    });
}

function slidershowImg() {
    $(".box-showImg .owl-carousel").owlCarousel({
        margin: 0,
        nav: true,
        loop: true,
        dots: false,
        lazyLoad: true,
        navText: ["<img src='../../images/icon-arrow.png'>", "<img src='../../images/icon-arrow.png'>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 5
            }
        }
    });
}

function sliderTRemaining() {
    var timer = $('#TRemaining').attr('data-time');
    // Set the date we're counting down to
    var countDownDate = new Date(timer).getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("TRemaining").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("TRemaining").innerHTML = "EXPIRED";
        }
    }, 1000);
}

function sliderTRemaining_old() {
    // this code set time to 24 hrs
    // var timer2 = "05:35:06";
    var timer2 = $('#TRemaining').attr('data-time');
    var timer3 = localStorage.getItem('TRemaining');

    if (timer3) {
        timer2 = timer3;
        $('#TRemaining').text(timer3);
    } else {
        $('#TRemaining').text(timer2);
        localStorage.setItem('TRemaining', timer2);
    }

    var interval = setInterval(function () {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var hours = parseInt(timer[0], 10);
        var minutes = parseInt(timer[1], 10);
        var seconds = parseInt(timer[2], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        hours = (minutes < 0) ? --hours : hours;
        if (hours < 0) clearInterval(interval);
        minutes = (minutes < 0) ? 59 : minutes;
        minutes = (minutes < 10) ? '0' + minutes : minutes;
        hours = (hours < 10) ? '0' + hours : hours;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        minutes = (minutes < 10) ? minutes : minutes;

        timer2 = hours + ':' + minutes + ':' + seconds;
        if (hours <= 0 && minutes == 0 && seconds == 0) {
            // if you want to delete it on local storage
            // localStorage.removeItem('timer');
            console.log('finish')

            //เมื่อนับจบ
            //คำสั่งให้เริ่มจับเวลาใหม่
            localStorage.clear('TRemaining');
            // window.location.replace("index.php");
        } else {
            $('#TRemaining').html(timer2);
            localStorage.setItem('TRemaining', hours + ':' + minutes + ':' + seconds);
            timer2 = hours + ':' + minutes + ':' + seconds;
        }

    }, 1000);
}

function calAmount(e) {
    var price = e.closest('.order-body').find('.display-price span').text();
    var unit = e.parent().find('.quantity').val();
    var amount = e.closest('.order-body').find('.display-amount span');
    amount.html(numberWithCommas(parseFloat(unit.replace(',', '')) * parseFloat(price.replace(',', ''))));
    sumTotal();
}

function sumTotal(displayDiscount = 0) {
    var total = 0;
    var totalDiscount = 0;
    var amount = 0;
    var discountAmount = 0;
    var vat7 = 0;
    var hasCB = false;
    $('.btn-next-process').addClass('disabled');
    if ($('.order-head').find('input:checkbox').hasClass('selectAll')) hasCB = true;
    $('.box-history .order-body').each(function () {
        if (hasCB) {
            if ($(this).find('input:checkbox').prop('checked')) {
                amount = parseFloat($(this).find('.display-amount>span').text().replace(',', ''));
                total += amount;
                if (displayDiscount !== 0) {
                    discountAmount = parseFloat($(this).find('.display-price>b>span').text().replace(',', '')) * parseFloat($(this).find('.display-qty').text().replace(',', ''));
                    totalDiscount += discountAmount - amount;
                }
            }
        } else {
            amount = parseFloat($(this).find('.display-amount>span').text().replace(',', ''));
            total += amount;
            if (displayDiscount !== 0) {
                discountAmount = parseFloat($(this).find('.display-price>b>span').text().replace(',', '')) * parseFloat($(this).find('.display-qty').text().replace(',', ''));
                totalDiscount += discountAmount - amount;
            }
        }
    });
    if (total > 0) $('.btn-next-process').removeClass('disabled');
    $('.display-total span').html(numberWithCommas(numberWithCommas(total.toFixed(2))));
    if (displayDiscount !== 0) {
        $('.display-discount-total span').html(numberWithCommas(totalDiscount.toFixed(2)));
        var valVat7 = total * 0.07;
        $('.display-vat7 span').html(numberWithCommas((valVat7).toFixed(2)));
        var deliveryPrice = parseFloat($('.display-logistic-price span').html());
        $('.display-gtotal span').html(numberWithCommas((total + deliveryPrice + valVat7).toFixed(2)));
    }
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function readURL(_this, _div = null) {
    var sum = (_this.files[0].size / 1048576);
    // Fixed Old version and New version
    if (typeof $(_this).attr('maxSizeByte') == 'undefined') {
        // For Old version
        var size = sum.toFixed(0);
        if (size > 5) {
            $(_this).val('');
            $('#' + _div).attr('src', 'http://ubooking.am2bmarketing.co.th/assets/noimage.jpg');
            swal({
                type: 'warning',
                text: 'ขนาดไฟล์ใหญ่เกินกำหนด'
            });
        } else {
            if (_this.files && _this.files[0]) {
                var reader2 = new FileReader();
                reader2.onload = function (e) {
                    $('#' + _div).attr('src', e.target.result).attr('data-content', "<img src='" + e.target.result + "'  class='img-tootip' />");
                }
                reader2.readAsDataURL(_this.files[0]);
            }
        }
    } else {
        // For New version
        var error_file_size = 'ขนาดไฟล์ใหญ่เกินกำหนด';
        var error_file_format = 'ประเภทไฟล์ไม่ถูกต้อง';
        var chkNotErr = true;
        var size = _this.files[0].size;
        var maxSize = parseFloat($(_this).attr('maxSizeByte'));
        // Check Max Size
        if (chkNotErr) {
            if (maxSize) {
                if (size > maxSize) {
                    $(_this).val('');
                    // $('#' + _div).attr('src', 'http://artexchange.am2bmarketing.co.th/assets/noimage.jpg');
                    swal({
                        type: 'warning',
                        text: error_file_size
                    });
                    var target = $(_this).parent().parent().siblings(':first-child');
                    if (target.find('div').hasClass('file-name')) target.find('div').remove();
                    chkNotErr = false;
                }
            }
        }
        // Check File Type
        if (chkNotErr) {
            var rs = chkTypeValid(_this);
            if (!rs) {
                $(_this).val('');
                swal({
                    type: 'warning',
                    text: error_file_format
                });
                var target = $(_this).parent().parent().siblings(':first-child');
                if (target.find('div').hasClass('file-name')) target.find('div').remove();
                chkNotErr = false;
            }
        }
        // Preview and Display Name
        if (chkNotErr) {
            if (_div) {
                imgPreview(_this, _div);
            } else {
                displayFileName(_this);
            }
        }
    }

}

function displayFileName(_this) {
    var target = $(_this).parent().parent().siblings(':first-child');
    var fileName = (_this.files[0].name.length > 30) ? _this.files[0].name.substr(0, 30) + '...' : _this.files[0].name;
    if (target.find('div').hasClass('file-name')) target.find('div').remove();
    target.append('<div class="file-name" style="color: #35bdc4; background: #f8f8f8; border-radius: 8px; padding: 2px 4px;">' + fileName + '</div>');
}

function imgPreview(_this, _div) {
    if (_this.files && _this.files[0]) {
        var reader2 = new FileReader();
        reader2.onload = function (e) {
            $('#' + _div).attr('src', e.target.result).attr('data-content', "<img src='" + e.target.result + "'  class='img-tootip' />");
        }
        reader2.readAsDataURL(_this.files[0]);
    }
}

function chkTypeValid(_this) {
    switch ($(_this).attr('fileType')) {
        case 'image':
            return isImage(_this.files[0].name);
        case 'file':
            return isFile(_this.files[0].name);
        case 'video':
            return isVideo(_this.files[0].name);
    }
    return false;
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':
            //etc
            return true;
    }
    return false;
}

function isFile(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'pdf':
            //etc
            return true;
    }
    return false;
}

function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'mp4':
            // etc
            return true;
    }
    return false;
}
