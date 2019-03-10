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

// --------------------------------
// Tabs
// --------------------------------
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

$('#addVariante').on('keypress', function (e) {
  if (e.keyCode === 13) {
    e.preventDefault();
    $(this).trigger('submit');
  }
});

$('input[data-role="tagsinput"]').tagsinput({
  tagClass: 'badge badge-primary'
});

$(".bootstrap-tagsinput").addClass('form-control');

$(function () {
  // Get an element
  var componentElement = $('[data-root="componentElement"]');
  // Hide all elements 
  componentElement.hide();
  // When the type changed
  $('#componentElementType').change(function () {
    // Get type value
    var value = $(this).val();
    // Hide all elements when changed type
    componentElement.hide();
    // Show elements who matched the type 
    $('div[type *= ' + value + ']').fadeIn();
  });
});

// --------------------------------
// Initialise the sortable plugin
// --------------------------------

$(function () {
  $("div[data-type='sortable']")
    .sortable({
      containment: "parent",
      handle: '.handle',
      cancel: 'button',
      start: function (event, ui) {
        console.log('start: ' + ui.item.index())
      },
      update: function (event, ui) {
        console.log('end ' + ui.item.index())
      }
    });

  $("div[data-type='sortable']").disableSelection();
});

// --------------------------------
// Remove Component form list
// --------------------------------

$(document).on('click', '.deleteComponent', function (event) {
  var a = event.target;
  a.closest('ul').remove();
});

// --------------------------------
// Tweak Template form with capabilites for Components to be add in list, sortable
// --------------------------------

$(function () {
  var componentsSelect = $('#componentsSelect');
  componentsSelect.prepend('<option selected></option>').select2({
    placeholder: "Selectionner un composant pour l'ajouter",
    allowClear: true
  });
  componentsSelect.on('select2:close', function (e) {
    // Get option value
    var value = $(this).val();
    // Get option name
    var name = $("#componentsSelect option:selected").text();
    // Add new selected option in list
    var list = $('#templateComponentsList');
    list.append('<ul class="list-group py-2"><li class="list-group-item ui-state-default" data-id="' + value + '"><div class="row align-items-center"><div class="col ml-n2">' + name + '</div><div class="col-auto"><a class="deleteComponent" style="cursor:pointer;"><i class="fe fe-trash-2"></i></a></div><div class="col-auto"><a class="handle" style="cursor:grab;"><i class="fe fe-more-vertical"></i></a></div></div></li></ul>');
    // Reset Select2 value
    $(this).val(null).trigger('change.select2')
  });
});

// --------------------------------
// Initialise Google Address autocomplete
// --------------------------------

function initMap() {
  var input = document.getElementById('formPlacesAuto');

  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace();
    var addressComponents = place.address_components;

    console.log(addressComponents);
    document.getElementById('address').value = addressComponents[0]["long_name"] + ' ' + addressComponents[1]["long_name"];
    document.getElementById('postal_code').value = addressComponents[6]["long_name"];
    document.getElementById('city').value = addressComponents[2]["long_name"];
    document.getElementById('country').value = addressComponents[5]["long_name"];
    document.getElementById('latitude').value = place.geometry.location.lat();
    document.getElementById('longitude').value = place.geometry.location.lng();
  });
}

// --------------------------------
// Filename to Upload label
// --------------------------------
$('.custom-file-input').on('change', function () {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

// --------------------------------
// TinyMCE initialization
// --------------------------------
$(function () {
  tinymce.init({
    selector: '#textDescription',
    height: 300,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor textcolor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code'
    ],
    toolbar: 'formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify',
  });
});

// --------------------------------
// Make checkboxes values TRUE/FALSE
// --------------------------------
$(function () {
  var isActive = $('#isActive');
  var formActive = $('#formActive');
  // Active the checkbox if his value is True
  if ($(formActive).val() == "true") {
    $(isActive).attr('checked', true);
  };
  // Trigger True/False when click on the checkbox
  $(isActive).on('click', function () {
    if ($(this).is(":checked")) {
      $(formActive).val(true)
    } else {
      $(formActive).val(false)
    }
  });
});
