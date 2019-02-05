function ConfirmDelete() {
  var x = confirm("Êtes-vous sûr?");
  if (x)
    return true;
  else
    return false;
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
  }
});

$("#tabs").tabs({
  classes: {
    "ui-tabs-tab": "nav-item",
    "ui-tabs-active": "active"
  },
  activate: function activeTab() {
    $('.ui-tabs-tab').each(function () {
      if ($(this).hasClass('ui-tabs-active')) {
        $(this).children().addClass('active')
      } else(
        $(this).children().removeClass('active')
      )
    });
  }
});

$('#element').toast('show');