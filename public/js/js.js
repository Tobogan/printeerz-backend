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
  });
  // Format value to json
  var json = JSON.stringify(componentList, 'true');
  // Add value to form hidden value
  $(hiddenValue).attr('value', json);
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
      componentFormList.append('<ul class="list-group py-2"><li class="list-group-item ui-state-default" data-id="' + value + '"><div class="row align-items-center"><div id="hidden_comp" class="col ml-n2">' + name + '</div><div class="col-auto"><a data-id="' + value + '" class="deleteComponent" style="cursor:pointer;"><i class="fe fe-trash-2"></i></a></div><div class="col-auto"><a class="handle" style="cursor:grab;"><i class="fe fe-more-vertical"></i></a></div></div></li></ul>');
      // Update Form hidden value
      updateFormHidden(componentFormList,componentFormListHidden);
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

$('.buttonColor').on('click', function(e) {
  var id = $(this).attr('data-id');
  $('#idTP').html('<input type="hidden" name="tp_id" id="tp_id" value="'+id+'">');
});

$('#AddColor').on('submit', function (e) {
  e.preventDefault();
  $('#submit_modalAddColor').hide();
  $('#loading_modalAddColor').removeClass('d-none');
  $(this).removeClass('btn-primary');
  $(this).addClass('btn-success');
  var color = $('#ep_color').val();
  var code_hex = $('#ep_code_hex').val();
  var id = $('#tp_id').val();
  // var i = $('#countJS'+id).val();
  var colorsList = $('#colorsList'+id).val();
  var hexaList = $('#hexaList'+id).val();
  console.log(id);
  var colors = [];
  var hexa = [];
  colors.push(colorsList);
  hexa.push(hexaList);
  var array_colors = [color];
  var array_hexas = [code_hex];
  colors.push([array_colors]);
  hexa.push([array_hexas]);
  document.getElementById("colorsList"+id).value = colors;
  document.getElementById("hexaList"+id).value = hexa;
  console.log(document.getElementById("colorsList"+id).value);
  console.log(document.getElementById("hexaList"+id).value);
  $('#addColorModal').modal('hide');
  $('#submit_modalAddColor').show();
  $('#loading_modalAddColor').addClass('d-none');
  $('#color_name_list'+id).append('<tr><td class="color-name">'+color+'</td><td class="color-code_hex">'+code_hex+'</td><td><a data-id="'+id+'"data-color="'+color+'" data-hexa="'+code_hex+'" onclick="var id=$(this).attr(\'data-id\');var color=$(this).attr(\'data-color\');var hexa=$(this).attr(\'data-hexa\');deleteColorRow(id,color);deleteHexaRow(id,hexa);$(this).closest(\'tr\').remove();" style="float:right">Supprimer</a></td></tr>');
  $('#ep_color').val('');
  $('#ep_code_hex').val('');
});

$('.buttonFont').on('click', function(e) {
  var id = $(this).attr('data-id');
  $('#idTPFont').html('<input type="hidden" name="tp_id_font" id="tp_id_font" value="'+id+'">');
});

function addDeleteBtn(font_title, id, font_url_replaced,font_id, font_name){
  $('#font_name_list'+id).append('<tr><td class="font-name">'+font_title+'</td><td><a style="float:right" data-id="'+id+'"data-url="'+font_url_replaced+'" data-font_id="'+font_id+'" data-font="'+font_title+'" data-font_name="'+font_name+'" onclick="var id=$(this).attr(\'data-id\');var font_id=$(this).attr(\'data-font_id\');var font=$(this).attr(\'data-font\');font_name=$(this).attr(\'data-font_name\');var url=$(this).attr(\'data-url\');deleteFontRow(id,font,font_id,font_name,url);deleteFile('+'\''+font_title+'\',\''+font_name+'\');$(this).closest(\'tr\').remove();">Supprimer</a></td></tr>');
}
$('#AddFont').on('submit', function (e) {
  e.preventDefault();
  $('#submit_modalAddFont').hide();
  $('#loading_modalAddFont').removeClass('d-none');
  $(this).removeClass('btn-primary');
  $(this).addClass('btn-success');
  var id = $('#tp_id_font').val();
  var font_title = $('#ec_font_title').val();
  var font_url = $('#ec_font_url').val();
  var font_weight = $('#font_weight').val();
  var font_transform = $('#font_transform').val();
  var font_name = font_url.replace('C:\\fakepath\\','');
  var events_custom_id = $('#events_custom_id').val();
  var new_path = '/fonts/'+font_title+'/';
  var font_url_replaced = font_url.replace('C:\\fakepath\\', new_path);
  var fontsList = $('#fontsList'+id).val();
  var fontWeightList = document.getElementById("fontsWeightList"+id).value;
  var fontTransformList = document.getElementById("fontsTransformList"+id).value;
  var font_urlList = document.getElementById("font_urlList"+id).value;
  var fontsFileNameList = document.getElementById("fontsFileNameList"+id).value;
  var fonts = [];
  var url = [];
  var fonts_weight = [];
  var fonts_transform = [];
  var fonts_file_name = [];
  fonts_weight.push(fontWeightList);
  fonts_transform.push(fontTransformList);
  fonts.push(fontsList);  
  url.push(font_urlList);
  fonts_file_name.push(fontsFileNameList);
  var array_fonts = [font_title];
  var array_urls = [font_url_replaced];
  var array_fonts_weight = [font_weight];
  var array_fonts_transform = [font_transform];
  var array_fonts_file_name = [font_name];
  fonts.push([array_fonts]);
  url.push([array_urls]);
  fonts_weight.push([array_fonts_weight]);
  fonts_transform.push([array_fonts_transform]);
  fonts_file_name.push([array_fonts_file_name]);
  document.getElementById("fontsList"+id).value = fonts;
  document.getElementById("font_urlList"+id).value = url;
  document.getElementById("fontsWeightList"+id).value = fonts_weight;
  document.getElementById("fontsTransformList"+id).value = fonts_transform;
  document.getElementById("fontsFileNameList"+id).value = fonts_file_name;
  $('#addFontModal').modal('hide');
  $('#submit_modalAddFont').show();
  $('#loading_modalAddFont').addClass('d-none');
});

$('#SelectFont').on('submit', function (e) {
  e.preventDefault();
  $('#submit_modalSelectFont').hide();
  $('#loading_modalSelectFont').removeClass('d-none');
  $(this).removeClass('btn-primary');
  $(this).addClass('btn-success');
  var id = $('#tp_id_font').val();
  var font_transform = $('#font_transform').val();
  var font_weight = 'default';// ici
  var font_id = $('#font_id').val();
  var font_title = $('#font_id option:selected').text();
  var fontsList = $('#fontsList'+id).val();
  var fontTransformList = document.getElementById("fontsTransformList"+id).value;
  var fontsIdsList = document.getElementById("fontsIdsList"+id).value;
  var fontWeightList = document.getElementById("fontsWeightList"+id).value;
  var fonts = [];
  var fonts_transform = [];
  var fonts_ids = [];
  var fonts_weight = [];
  fonts_transform.push(fontTransformList);
  fonts.push(fontsList);
  fonts_ids.push(fontsIdsList);
  fonts_weight.push(fontWeightList);
  var array_fonts = [font_title];
  var array_fonts_transform = [font_transform];
  var array_fonts_ids = [font_id];
  var array_fonts_weight = [font_weight];
  fonts.push([array_fonts]);
  fonts_transform.push([array_fonts_transform]);
  fonts_ids.push([array_fonts_ids]);
  fonts_weight.push([array_fonts_weight]);
  document.getElementById("fontsList"+id).value = fonts;
  document.getElementById("fontsTransformList"+id).value = fonts_transform;
  document.getElementById("fontsIdsList"+id).value = fonts_ids;
  document.getElementById("fontsWeightList"+id).value = fonts_weight;

  $('#selectFontModal').modal('hide');
  $('#submit_modalSelectFont').show();
  $('#loading_modalSelectFont').addClass('d-none');
  $('#font_name_list'+id).append('<tr><td class="font-name">'+font_title+'</td><td><a style="float:right" data-id="'+id+'" data-font_id="'+font_id+'" data-font="'+font_title+'" onclick="var id=$(this).attr(\'data-id\');var font_id=$(this).attr(\'data-font_id\');var font=$(this).attr(\'data-font\');deleteSelectedFontRow(id,font,font_id);$(this).closest(\'tr\').remove();">Supprimer</a></td></tr>');
});

function deleteColorRow(id,color){
  var colorsList = $('#colorsList'+id).val();
  var colors = [];
  colors.push(colorsToDeleteList);
  var array_colors = [color];
  colors.push([array_colors]);
  document.getElementById("colorsToDeleteList"+id).value = colors;
  var colorsToDeleteList = $('#colorsToDeleteList'+id).val();
  var finalColors = colorsList.replace(colorsToDeleteList, "");
  document.getElementById("colorsList"+id).value = finalColors;
  console.log('finalColors= '+document.getElementById("colorsList"+id).value);
  document.getElementById("colorsToDeleteList"+id).value = "";
}

function deleteHexaRow(id,hexa){
  var hexaList = $('#hexaList'+id).val();
  var hexas = [];
  var hexasToDeleteList = $('#hexasToDeleteList'+id).val();
  hexas.push(hexasToDeleteList);
  var array_hexas = [hexa];
  hexas.push([array_hexas]);
  document.getElementById("hexasToDeleteList"+id).value = hexas;
  var hexasToDeleteList = $('#hexasToDeleteList'+id).val();
  var finalHexas = hexaList.replace(hexasToDeleteList, "");
  document.getElementById("hexaList"+id).value = finalHexas;
  console.log('finalHexas= '+document.getElementById("hexaList"+id).value);
  document.getElementById("hexasToDeleteList"+id).value = "";
}

function deleteFontRow(id,font,font_id,font_name,font_url){
  var fontsList = $('#fontsList'+id).val();
  var fontsIdsList = $('#fontsIdsList'+id).val();
  var fontsFileNameList = $('#fontsFileNameList'+id).val();
  var font_urlList = $('#font_urlList'+id).val();

  var fonts = [];
  var fonts_ids = [];
  var fonts_file_names = [];
  var fonts_urls = [];

  var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
  var fontsIdsToDeleteList = $('#fontsIdsToDeleteList'+id).val();
  var fontsFileNameToDeleteList = $('#fontsFileNameToDeleteList'+id).val();
  var font_urlToDeleteList = $('#font_urlToDeleteList'+id).val();

  fonts.push(fontsToDeleteList);
  fonts_ids.push(fontsIdsToDeleteList);
  fonts_file_names.push(fontsFileNameToDeleteList);
  fonts_urls.push(font_urlToDeleteList);

  var array_fonts = [font];
  var array_fonts_ids = [font_id];
  var array_fonts_file_names = [font_name];
  var array_fonts_urls = [font_url];

  fonts.push([array_fonts]);
  fonts_ids.push([array_fonts_ids]);
  fonts_file_names.push([array_fonts_file_names]);
  fonts_urls.push([array_fonts_urls]);

  document.getElementById("fontsToDeleteList"+id).value = fonts;
  document.getElementById("fontsIdsToDeleteList"+id).value = fonts_ids;
  document.getElementById("fontsFileNameToDeleteList"+id).value = fonts_file_names;
  document.getElementById("font_urlToDeleteList"+id).value = fonts_urls;

  var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
  var fontsIdsToDeleteList = $('#fontsIdsToDeleteList'+id).val();
  var fontsFileNameToDeleteList = $('#fontsFileNameToDeleteList'+id).val();
  var font_urlToDeleteList = $('#font_urlToDeleteList'+id).val();

  console.log('font to delete = '+fontsToDeleteList);
  console.log('ids to delete = '+fontsIdsToDeleteList);
  console.log('file_names to delete = '+fontsFileNameToDeleteList);
  console.log('urls to delete = '+font_urlToDeleteList);
  // Here I replace the values by the final value after the delete
  document.getElementById("fontsList"+id).value = fontsList.replace(fontsToDeleteList, "");
  document.getElementById("fontsIdsList"+id).value = fontsIdsList.replace(fontsIdsToDeleteList, "");
  document.getElementById("fontsFileNameList"+id).value = fontsFileNameList.replace(fontsFileNameToDeleteList, "");
  document.getElementById("font_urlList"+id).value = font_urlList.replace(font_urlToDeleteList, "");

  // Here I delete input content
  document.getElementById("fontsToDeleteList"+id).value = "";
  document.getElementById("fontsIdsToDeleteList"+id).value = "";
  document.getElementById("fontsFileNameToDeleteList"+id).value = "";
  document.getElementById("font_urlToDeleteList"+id).value = "";
}

function deleteSelectedFontRow(id,font,font_id){
  var fontsList = $('#fontsList'+id).val();
  var fontsIdsList = $('#fontsIdsList'+id).val();

  var fonts = [];
  var fonts_ids = [];

  var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
  var fontsIdsToDeleteList = $('#fontsIdsToDeleteList'+id).val();

  fonts.push(fontsToDeleteList);
  fonts_ids.push(fontsIdsToDeleteList);

  var array_fonts = [font];
  var array_fonts_ids = [font_id];

  fonts.push([array_fonts]);
  fonts_ids.push([array_fonts_ids]);

  document.getElementById("fontsToDeleteList"+id).value = fonts;
  document.getElementById("fontsIdsToDeleteList"+id).value = fonts_ids;

  var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
  var fontsIdsToDeleteList = $('#fontsIdsToDeleteList'+id).val();

  console.log('font to delete = '+fontsToDeleteList);
  console.log('ids to delete = '+fontsIdsToDeleteList);

  // Here I replace the values by the final value after the delete
  document.getElementById("fontsList"+id).value = fontsList.replace(fontsToDeleteList, "");
  document.getElementById("fontsIdsList"+id).value = fontsIdsList.replace(fontsIdsToDeleteList, "");

  // Here I delete input content
  document.getElementById("fontsToDeleteList"+id).value = "";
  document.getElementById("fontsIdsToDeleteList"+id).value = "";
}

function deleteFile(font_title, font_name) {
  $.ajaxSetup({
      beforeSend: function (xhr, type) {
          if (!type.crossDomain) {
              xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
          }
      },
  });
  $.ajax({
      type: 'delete',
      url: "/admin/EventsCustoms/deleteFile/fonts/"+font_title+'/'+font_name,
      dataType: "JSON",
      data: {
          "font_name": font_name,
          "font_title": font_title,
          _token: '{!! csrf_token() !!}',
      },
      contentType: false,
      processData: false,
      success: function (response) {
          console.log(response.msg);
      },
      error: function (xhr) {
          console.log(xhr.responseText);
      }
  });
}
