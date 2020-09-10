$(document).ready(function () {
  $('.sidebar .nav > .has-sub > a').each(function () {
    var targetLi = $(this).closest('li');
    var target = $(this).next('.sub-menu');

    $(targetLi).removeClass('closed').addClass('expand');
    $(target).css('display', 'block');
  });

  $('.text-count-20').characterCounter({
    minlength: 0,
    maxlength: 20,
    blockextra: true,
    position: 'top',
  });

  $('.text-count-30').characterCounter({
    minlength: 0,
    maxlength: 30,
    blockextra: true,
    position: 'top',
  });

  $('.text-count-50').characterCounter({
    minlength: 0,
    maxlength: 50,
    blockextra: true,
    position: 'top',
  });

  $('.text-count-75').characterCounter({
    minlength: 0,
    maxlength: 75,
    blockextra: true,
    position: 'top',
  });

  $('.text-count-100').characterCounter({
    minlength: 0,
    maxlength: 100,
    blockextra: true,
    position: 'top',
  });

  $('.text-count-255').characterCounter({
    // minLength
    minlength: 0,
    // maxLength
    maxlength: 255,
    position: 'top',
  });

});

var handleCustomDatepicker = function () {
    $('.datepicker-startdate,.datepicker-enddate').datetimepicker({
      format: 'YYYY-MM-DD',
    });

    $('.datepicker-startdate').on('dp.change', function (e) {
      $('.datepicker-enddate').data('DateTimePicker').minDate(e.date);
    });

    $('.datepicker-enddate').on('dp.change', function (e) {
      // $('.datepicker-startdate').data('DateTimePicker').maxDate(e.date);
    });

    $('.datepicker-default').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('.datepicker-workday').datetimepicker({
      format: 'DD/MM/YYYY',
      maxDate: moment().toDate(),
      daysOfWeekDisabled: [0, 6],
      // disabledDates: ['2020-05-01', '2020-05-06']
    });

    $('.datepicker-workday').on('dp.change', function (e) {
      changeWorkdate();
    });

    $('#start_date,#end_date').datetimepicker({
      format: 'YYYY-MM-DD',
      minDate: moment().add(1, 'd').toDate()
    });

    $('#start_date').on('dp.change', function (e) {
      $('#end_date').data('DateTimePicker').minDate(e.date);
    });

};

var CustomDatepicker = function () {
  "use strict";
  return {
    //main function
    init: function () {
      handleCustomDatepicker();
    }
  };
}();

$('.clockpicker-starttime,.clockpicker-endtime').clockpicker({
  placement: 'bottom',
  align: 'left',
  donetext: 'Done',
  autoclose: true,
  'default': 'now'
});

$(function () {
    $.showLoading = function () {
      var loading = '<div class="fancybox-overlay fancybox-overlay-fixed" id="fancybox_showloading" style="width: auto; height:auto; display: block;"><div id="fancybox-loading"><div></div></div></div>';
      $('.return-list').append(loading);
    }

    $.hideLoading = function () {
      $('#fancybox_showloading').remove();
    }

    $('.search').on('click', function (e) {
      e.preventDefault();
      $.showLoading();
      var form = $('#form_search');
      $.ajax({
        url: $('#form_search').attr('action') + '/search',
        type: 'get',
        dataType: 'html',
        data: $('#form_search').serialize(),
      })
      .done(function (res) {
        $('.return-list').html(res);
        data_table();
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        $.hideLoading();
        window.history.pushState("object or string", "Title", $('#form_search').attr('action') + '?' + $('#form_search').serialize());
        console.log();
      });
    });

    $('.search_all').on('click', function (e) {
      e.preventDefault();
      $.showLoading();
      $.ajax({
        url: $('#form_search').attr('action') + '/search',
        type: 'get',
        dataType: 'html',
        data: {
          search_all: '1'
        },
      })
      .done(function (res) {
        $('.return-list').html(res);
        data_table();
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        $.hideLoading();
        window.history.pushState("object or string", "Title", $('#form_search').attr('action') + '?search_all=1');
      });
    });

    $('#form_search').on('submit', function (e) {
      e.preventDefault();
      $.showLoading();
      var form = $('#form_search');
      $.ajax({
        url: window.location.href + '/search',
        type: 'get',
        dataType: 'html',
        data: $('#form_search').serialize(),
      })
      .done(function (res) {
        $('.return-list').html(res);
        data_table();
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        $.hideLoading();
        console.log(window.location.href);
        window.history.pushState("object or string", "Title", window.location.href + '?' + $('#form_search').serialize());
        console.log();
      });
    })

    function data_table() {
      try {
        var col_width = $.parseJSON(colum_width);
      } catch (err) {
        var col_width = '[{"width" : "95px", "targets" : 0 }]';
      }

      var table_default = $('#data-table-default').DataTable({
        retrieve: true,
        "language": {
          "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
          "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
          "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
          "infoEmpty": "ไม่พบจำนวนรายการ",
          "search": "ค้นหา",
          "paginate": {
            "first": "หน้าแรก",
            "last": "หน้าสุดท้าย",
            "next": "ถัดไป",
            "previous": "ก่อนหน้า"
          }
        },
        //responsive: true,
        searching: true,
        scrollX: true,
        fixedColumns: true,
        //scrollCollapse: true,
        /* fixedColumns: true,*/
      });

      var table_no_sort = $('#data-table-nosort').DataTable({
        retrieve: true,
        "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบจำนวนรายการ",
            "search": "ค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        },
        //responsive: true,
        "columnDefs": col_width,
        searching: true,
        "ordering": false,
        scrollX: true,
        fixedColumns: true,
        //scrollCollapse: true,
        /* fixedColumns: true,*/
      });

      var data_table_list = $('#data-table-list').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'excel', 'pdf', 'print'
        ],
        "lengthMenu": [10, 25, 50, 75, 100],
        retrieve: true,
        "language": {
          "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
          "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
          "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
          "infoEmpty": "ไม่พบจำนวนรายการ",
          "search": "ค้นหา",
          "paginate": {
            "first": "หน้าแรก",
            "last": "หน้าสุดท้าย",
            "next": "ถัดไป",
            "previous": "ก่อนหน้า"
          }
        },
        //responsive: true,
        searching: true,
        "columnDefs": col_width,
        //scrollY:100,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: true,
        //"autoWidth": false,
        scrollY: '50vh',
        //sScrollX: "100%",
        "drawCallback": function (settings) {
          $('[data-toggle="tooltip"]').tooltip({
            container: 'body',
            "html": true,
          });
        }
      });
      data_table_list.columns.adjust().draw();
    }

    get_tooltip();

    function get_tooltip() {
      $('[data-toggle="tooltip"]').tooltip({
        container: 'body',
        /*"delay": {"show": 1000, "hide": 0},*/
        "html": true,
        //"delay": {"show": 1000, "hide": 0},
      });
    }

    try {
      var col_width = $.parseJSON(colum_width);
    } catch (err) {
      var col_width = '[{"width" : "95px", "targets" : 0 }]';
    }

    try {
        $('#data-table-default').DataTable({
          retrieve: true,
          "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่พบจำนวนรายการ",
            "search": "ค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
          },
          responsive: true,
          searching: true,
        });

        var data_table_list = $('#data-table-list').DataTable({
            "lengthMenu": [10, 25, 50, 75, 100],
            retrieve: true,
            "language": {

                "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",

                "zeroRecords": " ",

                "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",

                "infoEmpty": "ไม่พบจำนวนรายการ",

                "search": "ค้นหา",

                "paginate": {

                    "first": "หน้าแรก",

                    "last": "หน้าสุดท้าย",

                    "next": "ถัดไป",

                    "previous": "ก่อนหน้า"

                }

            },

            //responsive: true,

            searching: true,

            "columnDefs": col_width,

            scrollY: '50vh',

            scrollX: true,

            scrollCollapse: true,

            fixedColumns: true,

            //"autoWidth": false,

            //scrollY:  true,



        });



        data_table_list.columns.adjust().draw();



        var data_table_apply = $('#data-table-apply').DataTable({

            dom: 'Blfrtip',

            buttons: [

                'excel', 'pdf', 'print'

            ],

            "lengthMenu": [10, 25, 50, 75, 100],

            retrieve: true,

            "language": {

                // "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",

                // "zeroRecords": " ",

                // "info": "แสดง หน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",

                // "infoEmpty": "ไม่พบจำนวนรายการ",

                // "search": "ค้นหา",

                // "paginate": {

                //     "first": "หน้าแรก",

                //     "last": "หน้าสุดท้าย",

                //     "next": "ถัดไป",

                //     "previous": "ก่อนหน้า"

                // }
                "url": "../plugins/DataTables/json/English.json"

            },

            //responsive: true,

            searching: true,

            "columnDefs": col_width,

            scrollY: '50vh',

            scrollX: true,

            scrollCollapse: true,

            fixedColumns: true,

            //"autoWidth": false,

            //scrollY:  true,



        });



        data_table_apply.columns.adjust().draw();





    } catch {

        //not have DataTable

        //



    }





    $('button.back').on('click', function () {

        var back_auto_search = $(this).val();



        //window.history.back();



        window.location.href = back_auto_search;

    });













    //toggle menu

    $(window).on('show.bs.dropdown', function (e) {

        dropdownMenu = $(e.target).find('.dropdown-menu');

        $('.dropdown-menu').hide();

        $('body').append(dropdownMenu.detach());



        var eOffset = $(e.target).offset();



        dropdownMenu.css({

            'display': 'block',

            'top': eOffset.top + $(e.target).outerHeight(),

            'left': eOffset.left,

            'min-width': '80px'

        });

    });



    //hide again

    $(window).on('hide.bs.dropdown', function (e) {

        $(e.target).append(dropdownMenu.detach());

        dropdownMenu.hide();

    });







    var preview = '';

    var xy = '';

    var image_crop = '';



    $('.upload_image').on('change', function () {

        $('#image_demo').croppie('destroy');

        xy = $(this).siblings('.x-y');

        var viewport_xy = xy.attr('x-y-show');

        image_crop = $('#image_demo').croppie({

            enableExif: true,

            viewport:

                $.parseJSON(viewport_xy),

            boundary: {

                width: 700,

                height: 700

            },

        });

        preview = $(this).closest('.custom-file').siblings('.icon').children('.uploaded_image');

        var reader = new FileReader();

        reader.onload = function (event) {

            image_crop.croppie('bind', {

                url: event.target.result

            }).then(function () {

            });

        }

        reader.readAsDataURL(this.files[0]);

        $('#uploadimageModal').modal('show');

    });



    $('.crop_image').click(function (event) {

        event.preventDefault();

        var size_xy = xy.attr('x-y-save');

        image_crop.croppie('result', {

            type: 'canvas',

            size: $.parseJSON(size_xy),

        }).then(function (response) {



            $('#uploadimageModal').modal('hide');

            var src = '<img src="' + response + '" class="img-icon" data-original-title="<img src=' + response + '"  class="img-tootip"  data-toggle="tooltip" data-placement="top"  />';

            preview.html(src);

            xy.val(response);



        })

    });













});









function checkform() {

    var form = $('#form_data');

    form.parsley().validate();

    if (form.parsley().isValid()) {

        swal({

            icon: 'warning',

            title: 'ยืนยันการบันทึกข้อมูล',

            buttons: {

                cancel: {

                    text: 'ยกเลิก',

                    value: 'cancel',

                    visible: true,

                    className: 'btn btn-default',

                    closeModal: true,

                },

                confirm: {

                    text: 'ยืนยัน',

                    value: 'submit',

                    visible: true,

                    className: 'btn btn-info',

                    closeModal: true

                }

            }

        }).then(function (value) {

            switch (value) {

                case 'submit':

                    $('#form_data').submit();

                    break;

                default:
                    '';

            }

        });

    } else {

        // swal({

        //   icon: 'error',

        //   title: 'กรุณากรอกข้อมูลให้ครบ',

        // });

        return false;

    }

}







function readURL(_this, _div) {

    var sum = (_this.files[0].size / 1048576);

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

}





$('body').popover({

    selector: '[data-toggle="popover"]',

    placement: 'auto',

    container: 'body',

    trigger: 'hover',

    "html": true,

    content: function () {

        return '<img class="img-fluid" src="' + $(this).data('img') + '" />';

    }

});
