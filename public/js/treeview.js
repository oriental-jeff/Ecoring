$('.permission-tree').jstree({
  'plugins': ["wholerow", "checkbox", "types", "changed"],
      'core': {
        "themes": {
          "responsive": false
        }
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-primary fa-lg"
        },
        "file": {
          "icon": "fa fa-file text-success fa-lg"
        }
      }
});
$('.permission-tree').on("changed.jstree", function (e, data) {
      if (data.changed.selected) {
        getSelectPremission();
      }
      /* console.log(data.changed.selected); // newly selected
       console.log(data.changed.deselected); // newly deselected*/
    });
  try {
  $('.permission-tree').jstree(true).open_all();
    $('li[data-checkstate="checked"]').each(function() {
      $('.permission-tree').jstree('check_node', $(this));
    });
    $('.permission-tree').jstree(true).close_all();
  }catch {
  }
function getSelectPremission() {
  var selectedData = [];
  var selectedIndexes;
  selectedIndexes = $('.permission-tree').jstree('get_selected', true);
  jQuery.each(selectedIndexes, function (index, value) {
    selectedData.push(selectedIndexes[index].id);
  });
  
  $('#permission').val(selectedData.join(','));
  //console.log( $('#permisstion').val());
}
$(function() {
  $('.permission-custom-view').jstree({
  "core" : {
    "multiple" : false,
    "animation" : 0
  }
});
$('.permission-custom-view-top').jstree({
  "core" : {
    "multiple" : false,
    "animation" : 0
  }
});

})
