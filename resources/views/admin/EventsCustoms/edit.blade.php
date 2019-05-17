@extends('layouts/templateAdmin')
@section('alerts')
@if (session('status'))
    <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert"
        data-dismiss="alert">
        {{ session('status') }}
    </div>
@endif
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header -->
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                CONFIGURATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Configurer une personnalisation
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-auto mt-2 mt-md-0">
                            <ul class="nav nav-tabs nav-overflow header-tabs" id="myTab" role="tablist">
                                @include('admin.EventsCustoms.includes.edit.nav-tabs')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}

            {!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4']) !!}
            {{csrf_field()}}
            {{-- Custom title --}}
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
    @include('admin.EventsCustoms.includes.edit.tab-content')
                    </div>
                    {{-- Store Event custom event_id --}}
                    <input type="hidden" class="form-control" id="events_custom_event_id" name="events_custom_event_id"
                        value="{{$events_custom->event_id}}">
                    {{-- Store Event custom id --}}
                    <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
                    {{-- Store Event product id --}}
                    <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
                    {{-- Store Event product title --}}
                    <input type="hidden" class="form-control" name="actual_title" value="{{$events_custom->title}}">
                    {{-- Custom actions --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="buttons">
                                {!! Form::submit('Configurer', ['class' => 'btn btn-primary', 'style' => 'float:right'])
                                !!}
                                <a class='btn btn-secondary' style="float: left"
                                    href="{{route('show_eventsProducts', $events_product->id)}}">Annuler</a>
                            </div>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>{{-- /container --}}
@endsection

    @include('admin.EventsCustoms.includes.modal_addColor')
    @include('admin.EventsCustoms.includes.modal_addFont')
    @include('admin.EventsCustoms.includes.modal_selectFont')




@section('javascripts')
@parent()
<script type="text/Javascript">
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
        // console.log(gettype(colors));
        // colors_str = document.getElementById("colorsList").value;
        // var color_name = colors_str.split(",");
        $('#color_name_list'+id).append('<tr><td class="color-name">'+color+'</td><td class="color-code_hex">'+code_hex+'</td><td><a data-id="'+id+'"data-color="'+color+'" data-hexa="'+code_hex+'" onclick="var id=$(this).attr(\'data-id\');var color=$(this).attr(\'data-color\');var hexa=$(this).attr(\'data-hexa\');deleteColorRow(id,color);deleteHexaRow(id,hexa);$(this).closest(\'tr\').remove();" style="float:right">Supprimer</a></td></tr>');
        //$('#color_hexa_list').append('<td class="color-code_hexa">'+hexa+'</td>');
        $('#ep_color').val('');
        $('#ep_code_hex').val('');
    });

    $('.buttonFont').on('click', function(e) {
        var id = $(this).attr('data-id');
        $('#idTPFont').html('<input type="hidden" name="tp_id_font" id="tp_id_font" value="'+id+'">');
    });

    // $('#AddFont').on('submit', function (e) {
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
        var font_title = $('#ec_font_title').val();
        var font_transform = $('#font_transform').val();
        var font_id = $('#font_id').val();
        var events_custom_event_id = $('#events_custom_event_id').val();
        var fontsList = $('#fontsList'+id).val();
        var fontTransformList = document.getElementById("fontsTransformList"+id).value;
        var fontsFileNameList = document.getElementById("fontsFileNameList"+id).value;
        var fontsIdsList = document.getElementById("fontsIdsList"+id).value;
        var fonts = [];
        var fonts_transform = [];
        var fonts_file_name = [];
        var fonts_ids = [];
        fonts_transform.push(fontTransformList);
        fonts.push(fontsList);  
        fonts_file_name.push(fontsFileNameList);
        fonts_ids.push(fontsIdsList);
        var array_fonts = [font_title];
        var array_fonts_transform = [font_transform];
        var array_fonts_file_name = [font_name];
        var array_fonts_ids = [font_id];
        fonts.push([array_fonts]);
        fonts_transform.push([array_fonts_transform]);
        fonts_file_name.push([array_fonts_file_name]);
        fonts_ids.push([array_fonts_ids]);
        document.getElementById("fontsList"+id).value = fonts;
        document.getElementById("fontsTransformList"+id).value = fonts_transform;
        document.getElementById("fontsFileNameList"+id).value = fonts_file_name;
        document.getElementById("fontsIdsList"+id).value = fonts_ids;
        console.log('fontsIdsList = '+ document.getElementById("fontsIdsList"+id).value);

        $('#selectFontModal').modal('hide');
        $('#submit_modalSelectFont').show();
        $('#loading_modalSelectFont').addClass('d-none');
        $('#font_name_list'+id).append('<tr><td class="font-name">'+font_title+'</td><td><a style="float:right" data-id="'+id+'"data-url="'+font_url_replaced+'" data-font_id="'+font_id+'" data-font="'+font_title+'" data-font_name="'+font_name+'" onclick="var id=$(this).attr(\'data-id\');var font_id=$(this).attr(\'data-font_id\');var font=$(this).attr(\'data-font\');font_name=$(this).attr(\'data-font_name\');var url=$(this).attr(\'data-url\');deleteFontRow(id,font,font_id,font_name,url);deleteFile('+'\''+font_title+'\',\''+font_name+'\');$(this).closest(\'tr\').remove();">Supprimer</a></td></tr>');
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
        // var finalFonts = fontsList.replace(fontsToDeleteList, "");
        // var finalIdsFonts = fontsIdsList.replace(fontsIdsToDeleteList, "");
        // var finalFileNamesFonts = fontsFileNameList.replace(fontsFileNameToDeleteList, "");
        // var finalUrlsFonts = font_urlList.replace(font_urlToDeleteList, "");
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
</script>
@endsection