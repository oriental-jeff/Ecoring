$(document).ready(function() {



  

  // $('#table-default').DataTable();

  $(document).on('click', '.del-trans', function(event) {

    event.preventDefault();

    var _this = $(this);

    var id = _this.attr('data-id');

    var mode = _this.attr('data-module');

    var controller = _this.attr('data-controller');



    swal({

      icon: 'warning',
      title: 'คุณต้องการลบข้อมูล ?',
      text: 'กดยืนยันเพื่อทำการลบข้อมูล',
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



        if (mode == 'user') {

          TransectionDel.del_user(_this, id);

        }

        if (mode == 'user_type') {

          TransectionDel.del_user_type(_this, id);

        }

        if (mode == 'unit') {

          TransectionDel.del_unit(_this, id);

        }

        if (mode == 'Del') {

          //console.log(_this + " " + id + " " + controller);

          /*Dellist.init(_this, id ,controller);*/
          _this.closest('form').submit();
          console.log( _this.closest('form'));


        }



        break;

        default: '';

      }



    });



  });



  $(document).on('change', '.update-active-trans', function(event) {

    event.preventDefault();

    var _this = $(this);

    var id = _this.attr('data-id');

    var mode = _this.attr('data-module');

    var value_status = _this.val();



    swal({

      type: 'warning',

      title: 'ยืนยันการยกเลิกข้อมูล',

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

        if (mode == 'user') {

          TransectionUpdate.updatestatus_user(_this, id, value_status);

        }

        if (mode == 'user_type') {

          TransectionUpdate.updatestatus_user_type(_this, id, value_status);

        }

        if (mode == 'unit') {

          TransectionUpdate.updatestatus_unit(_this, id, value_status);

        }

        break;

        default: '';

      }

    });

  });



  $(document).on('change', '.UpdateStatusActive', function(event) {

    event.preventDefault();

    var _this = $(this);

    var id = _this.attr('data-id');

    var mode = _this.attr('data-module');

    var controller = _this.attr('data-controller');



    UpdateStatusActive.init(_this, id ,controller);



  });



});





var Dellist = function (){

  return {

    init:function(_this, id, controller){

      $.post(base_url + '/backend/'+controller+'/del', { id: id }, function(response, textStatus, xhr) {

        console.log(response);

        if (response == 'true') {

          _this.parents('tr').hide('slow');
          //$('#row_' + id).hide('slow');
          $('table').find('[data-id="'+ id + '"]').closest('tr').hide('slow');
          $('.DTFC_LeftBodyLiner').css('height','auto');
          $('.DTFC_LeftBodyWrapper').css('height','auto');
          $('.DTFC_ScrollWrapper').css('height','auto');
          
          return false;

        }else{

         /* swal({

            type: 'warning',

            title: 'เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่ !'

          });*/

          swal("เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่!", "", "warning");
          setTimeout(function () {
          }, 1500); 

        }

      });

    },

  }

}();



var UpdateStatusActive = function (){

  return {

    init:function(_this, id, controller){

      var value = _this.val();



      $.post(base_url + '/backend/'+controller+'/Updatestatus', { id: id, value: value }, function(response, textStatus, xhr) {

        console.log(response);

        if (response == 'true') {

         swal({

          type: 'warning',

          title: 'การเปลื่ยนแปลงข้อมูลสำเร็จ',

        });

       }else{

        swal({

          type: 'warning',

          title: 'เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่ !'

        });

      }

      setTimeout(function () { window.location.href = '/backend/'+controller; }, 1000);

    });

    }

  }

}();



var TransectionDel = function() {

  return {

    del_user: function(_this, id) {

      $.post(base_url + '/backend/manageUser/del', { id: id }, function(response, textStatus, xhr) {

        console.log(response);

        if (response == 'true') {

          _this.parents('tr').hide('slow');

          return false;

        }

      });

    },

    del_user_type: function(_this, id) {

      $.post(base_url + '/backend/manageUserType/del', { id: id }, function(response, textStatus, xhr) {

        console.log(response);

        if (response == 'true') {

          _this.parents('tr').hide('slow');

          return false;

        }

      });

    },

    del_unit: function(_this, id) {

      $.post(base_url + '/backend/manageUnit/del', { id: id }, function(response, textStatus, xhr) {

        console.log(response);

        if (response == 'true') {

          _this.parents('tr').hide('slow');

          return false;

        }

      });

    }

  }

}();



var TransectionUpdate = function() {

  return {

    updatestatus_user: function(_this, id, valueStatus) {

      $.post(base_url + '/backend/ManageUser/updatestatus', { id: id, valueStatus, valueStatus });

    },

    updatestatus_user_type: function(_this, id, valueStatus) {

      $.post(base_url + '/backend/ManageUserType/updatestatus', { id: id, valueStatus, valueStatus });

    },

    updatestatus_unit: function(_this, id, valueStatus) {

      $.post(base_url + '/backend/ManageUser/updatestatus', { id: id, valueStatus, valueStatus });

    }

  }

}();