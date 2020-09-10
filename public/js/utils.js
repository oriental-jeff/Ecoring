$(document).ready(function() {

  $(document).on('click', '.xxx', function(event) {

    event.preventDefault();

    var _this = $(this);

  });



  $(document).on('change', '.xxx', function(event) {

    event.preventDefault();

    var _this = $(this);

  });

  $('.sidebar .nav > .has-sub > a').each(function(){

    var targetLi = $(this).closest('li');
    var target = $(this).next('.sub-menu');

    $(targetLi).removeClass('closed').addClass('expand');
    $(target).css('display', 'block');

  });

  $(document).on('click', '.menu-link', function(event) {

    var menu_id = $(this).attr('data-id');

    var menu_parent_id = $(this).attr('data-parent-id');

    if (!menu_parent_id.length) {

      menu_parent_id = '';

    }

    setMenuSession(menu_id, menu_parent_id);

  });



  $(document).on('click', '.menu-form-frontend, .menu-form-frontend-sub', function() {

    var menu_id = $(this).attr('data-id');

    getMenuFormData('front', menu_id);

  });



  $(document).on('change', '.status-order-update', function(event) {

    var status_module = $(this).attr('data-module');

    var status_type = $(this).attr('data-status');

    var order_id = $(this).attr('data-id');

    var status_val = $(this).val();

    updateOrderStatus(status_module, status_type, order_id, status_val);

  });



  $(document).on('click', '.lang-option', function(event) {

    var language = $(this).attr('data-lang');

    var module = $(this).attr('data-module');

    $.post(base_url + 'LangSwitch/switchLanguage', {language : language, module : module}, function( data ) {

      // location.reload();

      console.log(data);

      // location.href = base_url + data;

    });

    return false;

  });

  $(document).on('click', '.reset-password', function(event) {
    var user_id = $(this).attr('data-id');
    swal({
      icon: 'warning',
      title: 'ยืนยันการรีเซ็ตรหัสผ่าน',
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
          className: 'btn btn-warning',
          closeModal: true
        }
      }
    }).then(function (value) {
      switch (value) {
        case 'submit':
          $.post(base_url + 'backend/ManageEmployee/resetPassword', { 'Em_Id' : user_id }, function( response ) {
            if (response) {
              swal({
                icon: 'success',
                title: 'รีเซ็ตรหัสผ่านเรียบร้อย'
              });
            } else {
              swal({
                icon: 'warning',
                title: 'ไม่สามารถรีเซ็ตรหัสผ่านได้',
                html: 'กรุณาตรวจสอบ'
              });
            }
          });
        break;
        default: '';
      }
    });
  });

  $(document).on('click', '.send-email', function(event) {

    var order_id = $(this).attr('data-id');

    var email_type = $(this).attr('data-email-type');

    $.post(base_url + 'email/sendEmail', {'id' : order_id, 'type' : email_type}, function( response ) {

      if (response) {

        swal({

          icon: 'success',

          title: 'ส่งอีเมลเรียบร้อย'

        })

        .then((value) => {

          location.reload();

        });

      } else {

        swal({

          icon: 'warning',

          title: 'ไม่สามารถส่งอีเมลได้',

          html: 'กรุณาตรวจสอบ'

        });

      }

    });

    return false;

  });

});



$.showMenuFormLoading = function(){

  $('#menu_form_loader').show();

};



$.hideMenuFormLoading = function(){

  $('#menu_form_loader').hide();

};



function numberWithCommas(x) {

  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}



function changeCountry() {

  var country_id = $('.country-list').val();

  var province = $('.province-list').val();

  var opt = "<option value=\"\" selected=\"selected\">กรุณาระบุ</option>";

  if (country_id != '') {

	  $.getJSON(base_url + 'get_json_data/dropdown_select_province',{ 'country_id': country_id }, function(json) {

	    var returnData = json;

	    if (returnData.length != 0) {

	      for (var i = 0; i < returnData.length; i++) {

	        opt += "<option value='" + returnData[i].Ap_Id + "'>" + returnData[i].Ap_Name + "</option>";

	      }

	      $('.province-list').html(opt);

	      if (province != '' && province != 0) {

	        $('.province-list option[value="' + province + '"]').attr('selected','selected');

	      }

	    }

	  });

	  changeProvince();

	}

}



function changeProvince() {

  var province_id = $('.province-list').val();

  var district = $('.district-list').val();

  var opt = "<option value=\"\" selected=\"selected\">กรุณาระบุ</option>";

  if (province_id != '') {

	  $.getJSON(base_url + 'get_json_data/dropdown_select_district',{ 'province_id': province_id }, function(json) {

	    var returnData = json;

	    if (returnData.length != 0) {

	      for (var i = 0; i < returnData.length; i++) {

	        opt += "<option value='" + returnData[i].Ad_Id + "'>" + returnData[i].Ad_Name + "</option>";

	      }

	      $('.district-list').html(opt);

	      if (district != '' && district != 0) {

	        $('.district-list option[value="' + district + '"]').attr('selected','selected');

	      }

	    }

	  });

	  changeDistrict();

	}

}



function changeDistrict() {

  var province_id = $('.province-list').val();

  var district_id = $('.district-list').val();

  var subdistrict = $('.subdistrict-list').val();

  var opt = "<option value=\"\" selected=\"selected\">กรุณาระบุ</option>";

  if (province_id != '' && district_id != '') {

	  $.getJSON(base_url + 'get_json_data/dropdown_select_subdistrict',{ 'province_id': province_id, 'district_id': district_id }, function(json) {

	    var returnData = json;

	    if (returnData.length != 0) {

	      for (var i = 0; i < returnData.length; i++) {

	        opt += "<option value='" + returnData[i].Asd_Id + "'>" + returnData[i].Asd_Name + "</option>";

	      }

	      $('.subdistrict-list').html(opt);

	      if (subdistrict != '' && subdistrict != 0) {

	        $('.subdistrict-list option[value="' + subdistrict + '"]').attr('selected','selected');

	      }

	    }

	  });

	}

}



function setMenuSession(menu_id, menu_parent_id) {

  $.post(base_url + 'setSession', { 'menu_id' : menu_id, 'menu_parent_id' : menu_parent_id, 'session_type' : 'menu' }, function( response ) {

    if (response) {

      return true;

    } else {

      return false;

    }

  });

}



function getMenuFormData(type, menu_id) {

	$.showMenuFormLoading();

  //Menu Form Edit

  if (type == 'front') {

  	var module_path = 'manageMenuFront';

  } else {

  	var module_path = 'manageMenuBack';

  }



  $('#menu_form_edit').empty();

  var url = base_url + 'backend/' + module_path + '/getMenuForm';

  $.ajax({

    url: url,

    dataType: 'html',

    data : { 'menu_id': menu_id },

    type: "POST",

    success: function(result){

    	// console.log(result)

     	$('#menu_form_edit').html(result);

      $('.text-count-20').characterCounter({

        minlength: 0,

        maxlength: 20,

        blockextra: true,

      });

      $("#form_save").on('submit', function(e){

        e.preventDefault();

        var form = $(this);

        form.parsley().validate();

        if (form.parsley().isValid()) {

         var formData = new FormData($(this)[0]);

         form_save(formData);

        }

      });

   	}

  });

}



// function readURL(input, type) {

//   if (input.files && input.files[0]) {

//     var reader = new FileReader();

//     reader.onload = function (e) {

//       $('#preview_' + type).attr('src', e.target.result);

//     }

//     reader.readAsDataURL(input.files[0]);

//  }

// }



function selectDayOfWeek(row) {

  if ($('#dow_' + row).is(':checked')) {

    $('#dow_check_' + row).val('1');

  } else {

    $('#dow_check_' + row).val('0');

  }

}



function changeRoomGroupConfig() {

  var room_group_id = $('#RoGr_Id').val();



  $.getJSON(base_url + "get_json_data/dropdown_select_room_type_config",{ 'room_group_id': room_group_id }, function(json) {

    var returnData = json;

    if (returnData.length != 0) {

      var opt = "<option value=\"\" selected=\"selected\">กรุณาระบุ</option>";

      for (var i = 0; i < returnData.length; i++) {

          opt += "<option value='" + returnData[i].RoTy_Id + "'>" + returnData[i].RoTy_Name + "</option>";

      }

      $('#RoTy_Id').html(opt);

    }

  });

}



function changeRoomGroup(row) {

  var start_date = $('#OrDr_CheckInExpectDate').val();

  var end_date = $('#OrDr_CheckOutExpectDate').val();

  var room_group_id = $('#RoGr_Id' + row).val();

  var room_id_array = $('.room-list').map(function() {

    if (this.value == '') {

      value = 0;

    } else {

      value = this.value;

    }

    return value;

  }).get();



  $.getJSON(base_url + "get_json_data/dropdown_select_room_type",{ 'room_group_id': room_group_id, 'room_id_dup': room_id_array, 'start_date': start_date, 'end_date': end_date }, function(json) {

    var returnData = json;

    if (returnData.length != 0) {

      var opt = "<option value=\"\" selected=\"selected\">ทั้งหมด</option>";

      for (var i = 0; i < returnData.length; i++) {

          opt += "<option value='" + returnData[i].RoTy_Id + "'>" + returnData[i].RoTy_Name + "</option>";

      }

      $('#RoTy_Id' + row).html(opt);

    }

  });

}



function changeRoomType(row) {

  var start_date = $('#OrDr_CheckInExpectDate').val();

  var end_date = $('#OrDr_CheckOutExpectDate').val();

  var room_group_id = $('#RoGr_Id' + row).val();

  var room_type_id = $('#RoTy_Id' + row).val();

  // var room_group_id = $('#RoTy_Id' + row).find('option:selected').attr('data-group');

  var room_id_array = $('.room-list').map(function() {

    if (this.value == '') {

      value = 0;

    } else {

      value = this.value;

    }

    return value;

  }).get();



  var opt = "<option value=\"\" selected=\"selected\">กรุณาระบุ</option>";

  if (room_type_id != '') {

    $.getJSON(base_url + 'get_json_data/dropdown_select_room',{ 'room_type_id': room_type_id, 'room_id_dup': room_id_array, 'start_date': start_date, 'end_date': end_date }, function(json) {

      var returnData = json;

      if (returnData.length != 0) {

        for (var i = 0; i < returnData.length; i++) {

          opt += "<option value='" + returnData[i].Ro_Id + "'>" + returnData[i].Ro_Name + "</option>";

        }

        $('#Ro_Id' + row).html(opt);

      }

    });

    getRoomTypePrice(row);

    $('#RoGr_Id' + row).val(room_group_id);

  }

}



function getRoomTypePrice(row) {

  var start_date = $('#OrDr_CheckInExpectDate').val();

  var end_date = $('#OrDr_CheckOutExpectDate').val();

  var room_type_id = $('#RoTy_Id' + row).val();

  if (room_type_id != '') {

    $.getJSON(base_url + 'get_json_data/getUnitTypePrice',{ 'room_type_id': room_type_id, 'start_date': start_date, 'end_date': end_date }, function(json) {

      var returnData = json;

      $('#Rb_RoomPrice' + row).val(returnData.price);

      $('#Rb_RoomPriceDefault' + row).val(returnData.price);

      $('#Rb_ExtraBed' + row).attr({

        'data-price': returnData.price_extrabed,

        'max': returnData.extrabed,

        'data-id': row

      });

      // calculateRoomPrice();

    });

  }

}



function calculateExtraBedPrice(row) {

  var extrabed_quantity = parseInt($('#Rb_ExtraBed' + row).val());

  var extrabed_price_each = parseInt($('#Rb_ExtraBed' + row).attr('data-price'));

  extrabed_price = extrabed_quantity * extrabed_price_each;

  $('#Rb_ExtraBedPrice' + row).val(extrabed_price);

  $('#Rb_ExtraBedPriceDefault' + row).val(extrabed_price);

}



function calculateRoomPrice() {

  var price_total = 0;

  var room_price_total = 0;

  $('.room_price').each(function(){

    var room_price = parseInt($(this).val());

    room_price_total += room_price;

  });

  price_total += room_price_total;

  // room_price_total = numberWithCommas(room_price_total);

  $('#room_price_total').val(room_price_total);



  var extrabed_price_total = 0;

  $('.extrabed_price').each(function(){

    if ($(this).val() == '') {

      var extrabed_price = 0;

    } else {

      var extrabed_price = parseInt($(this).val());

    }

    extrabed_price_total += extrabed_price;

  });

  price_total += extrabed_price_total;

  // extrabed_price_total = numberWithCommas(extrabed_price_total);

  $('#extrabed_price_total').val(extrabed_price_total);



  $('#price_total').val(price_total);

}



function changeRoomPrice() {

  var price_total = 0;

  var room_price_total = 0;

  $('.room_price').each(function(){

    var room_price = parseInt($(this).val());

    room_price_total += room_price;

  });

  price_total += room_price_total;

  // room_price_total = numberWithCommas(room_price_total);

  $('#room_price_total').val(room_price_total);



  var extrabed_price_total = 0;

  $('.extrabed_price').each(function(){

    var extrabed_price = parseInt($(this).val());

    extrabed_price_total += extrabed_price;



    var data_id = $(this).attr('data-id');

    $('#Rb_ExtraBedPrice' + data_id).val(extrabed_price);

  });

  price_total += extrabed_price_total;



  // extrabed_price_total = numberWithCommas(extrabed_price_total);

  $('#extrabed_price_total').val(extrabed_price_total);



  $('#price_total').val(price_total);

}



function addRowRoom() {

  var check_empty_room = 0;

  $('.room-list').each(function(){

    if ($(this).val() == '') {

      check_empty_room += 1;

    }

  });

  if (check_empty_room > 0) {

    swal({

      icon: 'error',

      title: 'กรุณาเลือกที่พัก',

    });

    return false;

  } else {

    var row = parseInt($('#row_count').val());

    var start_date = $('#OrDr_CheckInExpectDate').val();

    var end_date = $('#OrDr_CheckOutExpectDate').val();

    var room_id_array = $('.room-list').map(function() {

      if (this.value == '') {

        value = 0;

      } else {

        value = this.value;

      }

      return value;

    }).get();



    $.getJSON(base_url + 'get_json_data/getUnitGroupFree',{ 'room_id_dup': room_id_array, 'start_date': start_date, 'end_date': end_date }, function(json) {

      var returnData = json;

      if (typeof returnData != 'undefined' && returnData.length != 0) {

        rogr_data = returnData;

        addRow();

      } else {

        swal({

          icon: 'warning',

          title: 'ไม่มีที่พักว่าง',

        });

        return false;

      }

    });

  }

}



function addRow() {

  var row = parseInt($('#row_count').val());

  var new_row = row + 1;



  var list = '';

  list += '<div class="row" id="div_room_plus' + new_row + '">';

  list += '<div class="col-md-10">';

  list += '<div class="form-group row mb-2">';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="RoGr_Id' + new_row + '">กลุ่มที่พัก</label>';

  list += '<select class="form-control room-group-list" id="RoGr_Id' + new_row + '" name="RoGr_Id[]" data-parsley-group="step-1" data-parsley-required="true" data-parsley-required-message="กรุณาระบุข้อมูล" onchange="changeRoomGroup(' + new_row + ');">';

  list += '<option value="">กรุณาระบุ</option>';

  for(var i = 0; i < rogr_data.length; i++) {

    list += '<option value="' + rogr_data[i].RoGr_Id + '">' + rogr_data[i].RoGr_NameTH + '</option>';

  }

  list += '</select>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="RoTy_Id' + new_row + '">ประเภทที่พัก</label>';

  list += '<select class="form-control room-type-list" id="RoTy_Id' + new_row + '" name="RoTy_Id[]" data-parsley-group="step-1" data-parsley-required="true" data-parsley-required-message="กรุณาระบุข้อมูล" onchange="changeRoomType(' + new_row + ');">';

  list += '<option value="">กรุณาระบุ</option>';

  list += '</select>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="Ro_Id' + new_row + '">ที่พัก</label>';

  list += '<select class="form-control room-list" id="Ro_Id' + new_row + '" name="Ro_Id[]" data-parsley-group="step-1" data-parsley-required="true" data-parsley-required-message="กรุณาระบุข้อมูล">';

  list += '<option value="">กรุณาระบุ</option>';

  list += '</select>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="Rb_ExtraBed' + new_row + '">จำนวนเตียงเสริม</label>';

  list += '<input type="number" class="form-control extrabed_quantity" id="Rb_ExtraBed' + new_row + '" name="Rb_ExtraBed[]" min="0" step="1" data-id="' + new_row + '" data-price="0" data-parsley-type="digits" data-parsley-type-message="กรุณากรอกเป็นตัวเลข" onchange="calculateExtraBedPrice(' + new_row + ');">';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '<div class="col-md-1 mt-4">';

  list += '<button type="button" class="btn btn-danger" onclick="delRowRoom(' + new_row + ');"><i class="fa fa-minus"></i></button>';

  list += '</div>';



  list += '<div class="col-md-10">';

  list += '<div class="form-group row mb-2">';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="Rb_RoomPrice' + new_row + '">ราคาที่พัก</label>';

  list += '<input type="number" class="form-control room_price" id="Rb_RoomPrice' + new_row + '" name="Rb_RoomPrice[]" value="0" data-parsley-type="digits" data-parsley-type-message="กรุณากรอกเป็นตัวเลข" onchange="changeRoomPrice();">';

  list += '<input type="hidden" class="form-control" id="Rb_RoomPriceDefault' + new_row + '" name="Rb_RoomPriceDefault[]" value="0">';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '<div class="col-md-3 col-sm-12 mb-2">';

  list += '<div class="row">';

  list += '<div class="col-12">';

  list += '<label for="Rb_ExtraBedPrice' + new_row + '">ราคาเตียงเสริม</label>';

  list += '<input type="number" class="form-control extrabed_price" id="Rb_ExtraBedPrice' + new_row + '" name="Rb_ExtraBedPrice[]" value="0" data-parsley-type="digits" data-parsley-type-message="กรุณากรอกเป็นตัวเลข" onchange="changeRoomPrice();">';

  list += '<input type="hidden" class="form-control" id="Rb_ExtraBedPriceDefault' + new_row + '" name="Rb_ExtraBedPriceDefault[]" value="0">';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '</div>';

  list += '</div>';



  list += '</div>';



  $('#room_plus').append(list);

  $('#row_count').val(new_row);

}



function delRowRoom(row) {

  $('#div_room_plus' + row).hide('slow', function(){ $(this).remove(); });

  // var row = parseInt($('#row_count').val());

  // var new_row = row - 1;

  // $('#row_count').val(new_row);

}



function selectOptionService(row) {

  if ($('#Ops' + row).is(':checked')) {

    // $('#OpsB_Amount' + row).parsley('addConstraint', '{ required: true }');

    $('#OpsB_Amount' + row).val('');

  } else {

    // $('#OpsB_Amount' + row).atparsleytr('removeConstraint', 'required');

    $('#OpsB_Amount' + row).val('0');

    $('#OpsB_Price' + row).val('');

  }

}



function calculateOptionServicePrice(row) {

  var quantity = parseInt($('#OpsB_Amount' + row).val());

  var price_each = parseInt($('#Ops' + row).attr('data-price'));

  var service_price = quantity * price_each;

  $('#OpsB_Price' + row).val(service_price);

}



function getBookingData(booking_id) {

  if (booking_id != '') {

    $('#modal_booking_detail').load(base_url + 'backend/orderList/getBookingData/' + booking_id, function(){

      $('#modal_booking_detail').modal('show');

    });

  }

}



function updateOrderStatus(status_module, status_type, id, status_val) {

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

    var url = base_url + 'backend/' + status_module + '/updateStatusOrder';

    switch (value) {

      case 'submit':

      $.ajax({

        type: "POST",

        url: url,

        data : { 'OrDr_Id': id, 'type': status_type, 'value': status_val },

        success: function(response) {

          if (response) {

            swal({

              icon: 'success',

              title: 'บันทึกข้อมูลเรียบร้อย'

            });

            // setTimeout(function () { window.location.href = base_url + response; }, 1000);

          } else {

            swal({

              icon: 'warning',

              title: 'ไม่สามารถบันทึกข้อมูลได้',

              html: 'กรุณาตรวจสอบ'

            });

          }

        }

      });

      break;

      default: '';

    }

  });

}
