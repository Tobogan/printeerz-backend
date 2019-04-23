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
// Tweak Select2 select 
// with new items display and position draggable
// --------------------------------

// Update Form hidden value
function updateFormHidden(list,hiddenValue){
  var list = list;
  var listItem = list.find('li');
  var componentList = [];
  // Get each datas in list item
  $(listItem).each(function(){
    var id = $(this).data('id');
    var name = $(this).text();
    var datas = [];
    var found = false;
    componentList.push({
      id : id,
      name: name
    })
    console.log(componentList);
  });

  // Format value to json
  var json = JSON.stringify(componentList, 'true');
  // Add value to form hidden value
  $(hiddenValue).attr('value', json);
  console.log('jsonCompList='+json);
};

$(function () {
  // Get Select2 item
  var componentsSelect = $('#componentsSelect');
  var componentFormList = $("#templateComponentsList");
  var componentFormListHidden = $("#templateComponentsListHidden");

  // Prepend clear option & new placeholder
  componentsSelect.prepend('<option selected></option>').select2({
    placeholder: "Selectionner un composant pour l'ajouter",
    allowClear: true
  });

  // Add items
  componentsSelect.on('select2:close', function (e) {
    var name = $("#componentsSelect option:selected").text();
    var value = $(this).val();
    if(value) {
      componentFormList.append('<ul class="list-group py-2"><li class="list-group-item ui-state-default" data-id="' + value + '"><div class="row align-items-center"><div class="col ml-n2">' + name + '</div><div class="col-auto"><a data-id="' + value + '" class="deleteComponent" style="cursor:pointer;"><i class="fe fe-trash-2"></i></a></div><div class="col-auto"><a class="handle" style="cursor:grab;"><i class="fe fe-more-vertical"></i></a></div></div></li></ul>');
      // Update Form hidden value
      updateFormHidden(componentFormList,componentFormListHidden);
      componentsSelect.remove();
    };
    // Reset Select2 value
    $(this).val(null).trigger('change.select2')
  });

  // Remove items
  $(document).on('click', '.deleteComponent', function (event) {
    event.preventDefault;
    var a = event.target;
    // Remove ul element
    a.closest('ul').remove();
    // Update Form hidden value
    updateFormHidden(componentFormList,componentFormListHidden);
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

// --------------------------------
// Disable Enter key for submiting form
// --------------------------------
$(document).on("keypress", 'form', function (e) {
  var code = e.keyCode || e.which;
  if (code == 13) {
    e.preventDefault();
    return false;
  }
});
