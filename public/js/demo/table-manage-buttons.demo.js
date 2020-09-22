/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3 & 4
Version: 4.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v4.0/admin/
*/

var handleDataTableButtons = function() {
	"use strict";
    
    if ($('#data-table-buttons').length !== 0) {
      $('#data-table-buttons').DataTable({
        dom: 'Bfrtip',
        buttons: [
          { extend: 'copy', className: 'btn-sm' },
          { extend: 'csv', className: 'btn-sm' },
          { extend: 'excel', className: 'btn-sm' },
          { extend: 'pdf', className: 'btn-sm' },
          { extend: 'print', className: 'btn-sm' }
        ],
        responsive: true,
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
        }
      });
    }

    if ($('#data-table-default').length !== 0) {
      var t = $('#data-table-default').DataTable({
        searching: true,
        ordering: true,
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: true,
        // fixedColumns: {
        //   leftColumns: 1
        // },
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
        "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
      });

      // t.on( 'order.dt search.dt', function () {
      //   t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
      //     cell.innerHTML = i+1;
      //   } );
      // } ).draw();
    }

    if ($('#data-table-report').length !== 0) {
      var t = $('#data-table-report').DataTable({
        dom: 'Bfrtip',
        buttons: [
          { extend: 'excel', className: 'btn-sm' }
          // { extend: 'pdf', className: 'btn-sm' }
        ],
        responsive: true,
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
        // "scrollX": true,
        "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
      });

      t.on( 'order.dt', function () {
        t.column(0, {order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      } ).draw();
    }
};

var TableManageButtons = function () {
	"use strict";
    return {
      //main function
      init: function () {
          handleDataTableButtons();
      }
    };
}();