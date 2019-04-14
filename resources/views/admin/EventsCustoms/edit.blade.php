@extends('layouts/templateAdmin')

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
                    </div>
                </div>
    
                {{-- Body --}}
    
                {!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4']) !!}
                {{csrf_field()}}
    
                {{-- Custom title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>
                                        Nom du produit
                                    </label>
                                    {!! Form::text('title', $events_custom->title, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <?php $i=0; ?>
                @foreach($templates as $template)
                <?php $array_template = $events_custom->template ?>
                    @if($template->id == reset($array_template))
                        @foreach($template_components as $template_component)
                            @foreach($template->components_ids as $component_id)
                                @if($template_component->id == $component_id)
                                    @if($template_component->type = 'input')
                                        <?php $i++; ?>
                                        {{-- Store template_composant id --}}
                                        <input type="hidden" class="form-control" name="{{'template_component_id'.$i}}" value="{{$template_component->id}}">
    
                                        {{-- Custom size --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Taille du composant
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Hauteur (cm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('height'.$i, $template_component->size["height"],
                                                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Largeur (cm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('width'.$i, $template_component->size["width"],
                                                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        {{-- Custom position --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Position du composant
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        X (cm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('origin_x'.$i, $template_component->origin["x"], ['class' =>
                                                                    'form-control', 'placeholder' =>'0']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Y (cm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('origin_y'.$i, $template_component->origin["y"], ['class' =>
                                                                    'form-control', 'placeholder' => '0']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        {{-- Custom option --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-header-title">
                                                            {{$template_component->title}}
                                                        </h3>
                                                    </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <!-- Label -->
                                                                <label>
                                                                    Nom
                                                                </label>
                                                                <!-- Input -->
                                                                @if(isset($template_component->font["name"]))
                                                                {!! Form::text('font_title'.$i, $template_component->font["name"], ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                                                @else
                                                                {!! Form::text('font_title'.$i, null, ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                                                @endif
                                                            </div>
                                                            <hr class="mt-4 mb-5">
    
                                                            <p class="h3">Nombre de caractères</p>
                                                            <div class="row">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Minimum</label>
                                                                        {!! Form::number('min'.$i, $template_component->characters["min"],['class' => 'form-control', 'placeholder' => '1']) !!} 
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Maximum</label>
                                                                        {!! Form::number('max'.$i, $template_component->characters["max"],['class' => 'form-control', 'placeholder' => '99']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-4 mb-5">
    
                                                            <p class="h3">Police de caractère par défault</p>
                                                            <div class="row">
                                                                <div class="col-12 mt-3">
                                                                    <div>
                                                                        <a href="#" style="float:right" class="buttonFont btn btn-sm btn-primary mb-2"
                                                                            data-toggle="modal" data-target="#addFontModal"
                                                                            data-id="{{$template_component->id}}">
                                                                            Ajouter une police
                                                                        </a>
                                                                    </div>
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Polices du composant
                                                                    </label>
                                                                    <div id="fontTable" class="card mt-3" data-toggle="lists"
                                                                    data-lists-values='["font-name"]'>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-sm table-nowrap card-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <a href="#" class="text-muted" data-sort="font-name">
                                                                                                Nom
                                                                                            </a>
                                                                                        </th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                        
                                                                                <tbody class="list" id="{{'font_name_list'.$template_component->id}}">
                                                                                    <tr>
                                                                                        <td class="font-name">
                                                                                            Roboto-Black
                                                                                        </td>
                                                                                        <td>
                                                                                            <a class="fontsDeleteRow" data-id="Roboto-Black" style="float:right">
                                                                                                Supprimer 
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="{{'newsFonts'.$template_component->id}}">
                                                                    <input type="hidden" name="{{'fontsList'.$template_component->id.'[]'}}" id="{{'fontsList'.$template_component->id}}" value="Roboto-Black">
                                                                    <input type="hidden" name="{{'font_urlList'.$template_component->id.'[]'}}" id="{{'font_urlList'.$template_component->id}}" value="/uploads/Roboto-Black.ttf">
                                                                    <input type="hidden" name="{{'url_'.$template_component->id.'[]'}}" id="{{'url_'.$template_component->id}}" value="Black">
                                                                </div>
                                                                <div id="fontsToDelete">
                                                                    <input type="hidden" name="{{'fontsToDeleteList'.$template_component->id.'[]'}}" id="{{'fontsToDeleteList'.$template_component->id}}">
                                                                </div>
                                                                <hr class="mt-4 mb-5">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <!-- Label -->
                                                                        <label>
                                                                            Epaisseur {{$template_component->font["weight"]}}
                                                                        </label>
                                                                        <div class="form-group">
                                                                            <select name="{{'font_weight'.$i}}" id="font_weight" class="form-control"
                                                                                data-toggle="select">
                                                                                <option value="100">Thin (100)</option>
                                                                                <option value="200">Extra Light (200)</option>
                                                                                <option value="300">Light (300)</option>
                                                                                <option value="400">Normal (400)</option>
                                                                                <option value="500">Medium (500)</option>
                                                                                <option value="600">Semi Bold (600)</option>
                                                                                <option value="700">Bold (700)</option>
                                                                                <option value="800">Extra Bold (800)</option>
                                                                                <option value="900">Black (900)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Transformation {{$template_component->font["transform"]}}</label>
                                                                        <div class="form-group">
                                                                            <select name="{{'font_transform'.$i}}" id="font_transform"
                                                                                class="form-control" data-toggle="select">
                                                                                <option value="none">Aucune</option>
                                                                                <option value="uppercase">Tout en Majuscules</option>
                                                                                <option value="capitalize">Première lettre en Majuscule</option>
                                                                                <option value="lowercase">Tout en minuscule</option>
                                                                                <option value="full-width">Pleine largeur</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Première lettre ou symbole avant le texte</label>
                                                                        {!! Form::text('font_first_letter'.$i, $template_component->font["first_letter"], ['class' => 'form-control', 'placeholder' => '#']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div>
                                                                            <a href="#" style="float:right" class="buttonColor btn btn-sm btn-primary mb-2"
                                                                                data-toggle="modal" data-target="#addColorModal"
                                                                                data-id="{{$template_component->id}}">
                                                                                Ajouter une couleur
                                                                            </a>
                                                                        </div>
                                                                        <!-- Label -->
                                                                        <label>
                                                                            Couleurs de police
                                                                        </label>
                                                                        
                                                                        <div id="colorTable" class="card mt-3" data-toggle="lists"
                                                                        data-lists-values='["color-name", "color-code_hex"]'>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-sm table-nowrap card-table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>
                                                                                                <a href="#" class="text-muted" data-sort="color-name">
                                                                                                    Nom
                                                                                                </a>
                                                                                            </th>
                                                                                            <th>
                                                                                                <a href="#" class="text-muted" data-sort="color-code_hex">
                                                                                                    Code hexa
                                                                                                </a>
                                                                                            </th>
                                                                                            <th></th>
                                                                                        </tr>
                                                                                    </thead>
                                                            
                                                                                    <tbody class="list" id="{{'color_name_list'.$template_component->id}}">
                                                                                        <tr>
                                                                                            <td class="color-name">
                                                                                                Black
                                                                                            </td>
                                                                                            <td class="color-code_hex">
                                                                                                000000
                                                                                            </td>
                                                                                            <td>
                                                                                                <a class="colorsDeleteRow" data-color="Black" style="float:right">
                                                                                                    Supprimer 
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div id="newsColors">
                                                                                <input type="hidden" name="{{'colorsList'.$template_component->id.'[]'}}" id="{{'colorsList'.$template_component->id}}" value="Black">
                                                                                <input type="hidden" name="{{'hexaList'.$template_component->id.'[]'}}" id="{{'hexaList'.$template_component->id}}" value="000000">
                                                                            </div>
                                                                            <div id="colorsToDelete">
                                                                                <input type="hidden" name="{{'colorsToDeleteList'.$template_component->id.'[]'}}" id="{{'colorsToDeleteList'.$template_component->id}}">
                                                                                <input type="hidden" name="{{'hexasToDeleteList'.$template_component->id.'[]'}}" id="{{'hexasToDeleteList'.$template_component->id}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                        {{-- Store Event custom event_id --}}
                        <input type="hidden" class="form-control" id="events_custom_event_id" name="events_custom_event_id" value="{{$events_custom->event_id}}">
            
                        {{-- Store Event custom id --}}
                        <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
            
                        {{-- Store Event product id --}}
                        <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
            
                        {{-- Store Event product title --}}
                        <input type="hidden" class="form-control" name="actual_title" value="{{$events_product->title}}">

                        <input type="hidden" name="countJS" id="countJS" value="{{$i}}">
            
                        {{-- Custom actions --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="buttons">
                                    {!! Form::submit('Configurer', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                                    <a class='btn btn-secondary' style="float: left"
                                        href="{{route('show_event', $events_product->event_id)}}">Annuler</a>
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
        var colorsList = $('#colorsList'+id).val();
        var hexaList = $('#hexaList'+id).val();
        console.log(colorsList);
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
        // colors_str = document.getElementById("colorsList"+id).value;
        // var color_name = colors_str.split(",");
        $('#color_name_list'+id).append('<tr><td class="color-name">'+color+'</td><td class="color-code_hex">'+code_hex+'</td><td class="text-right"><a data-color="'+color+'" data-hexa="'+code_hex+'" onclick="var color=$(this).attr(\'data-color\');var hexa=$(this).attr(\'data-hexa\');deleteColorRow(color);deleteHexaRow(hexa);$(this).closest(\'tr\').remove();" style="float:right">Supprimer</a></td></tr>');
        //$('#color_hexa_list'+id).append('<td class="color-code_hexa">'+hexa+'</td>');
        $('#ep_color').val('');
        $('#ep_code_hex').val('');
    });

    $('.buttonFont').on('click', function(e) {
        var id = $(this).attr('data-id');
        $('#idTPFont').html('<input type="hidden" name="tp_id_font" id="tp_id_font" value="'+id+'">');
    });

    $('#AddFont').on('submit', function (e) {
        e.preventDefault();
        $('#submit_modalAddFont').hide();
        $('#loading_modalAddFont').removeClass('d-none');
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-success');
        var font_title = $('#ec_font_title').val();
        var font_url = $('#ec_font_url').val();
        var font_name = font_url.replace('C:\\fakepath\\','');
        var events_custom_event_id = $('#events_custom_event_id').val();
        console.log('event-id=> '+events_custom_event_id);
        console.log('font_name=>'+font_name);
        console.log('font_url_val=>'+font_url);
        var events_custom_id = $('#events_custom_id').val();
        var new_path = '/event/'+events_custom_id+'/fonts/'+font_title+'/';
        var font_url_replaced = font_url.replace('C:\\fakepath\\', new_path);
        var id = $('#tp_id_font').val();
        var fontsList = $('#fontsList'+id).val();
        var font_urlList = document.getElementById("font_urlList"+id).value;
        console.log(fontsList);
        var fonts = [];
        var url = [];
        fonts.push(fontsList);
        url.push(font_urlList);
        var array_fonts = [font_title];
        var array_urls = [font_url_replaced];
        fonts.push([array_fonts]);
        url.push([array_urls]);
        document.getElementById("fontsList"+id).value = fonts;
        document.getElementById("font_urlList"+id).value = url;
        $('#newsFonts'+id).append('<input type="hidden" name="url_'+id+'[]" value="'+font_url_replaced+'">');
        console.log(document.getElementById("fontsList"+id).value);
        console.log(document.getElementById("font_urlList"+id).value);
        $('#addFontModal').modal('hide');
        $('#submit_modalAddFont').show();
        $('#loading_modalAddFont').addClass('d-none');
        console.log('font_url= '+font_url_replaced);
        $('#font_name_list'+id).append('<tr><td class="font-name">'+font_title+'</td><td class="text-right"><a class="fontsDeleteRow" style="float:right" data-url="'+font_url_replaced+'" data-font="'+font_title+'" onclick="var font=$(this).attr(\'data-font\');var url=$(this).attr(\'data-url\');deleteFontRow(font);deleteFile('+'\''+font_title+'\',\''+font_name+'\',\''+events_custom_event_id+'\');$(this).closest(\'tr\').remove();">Supprimer</a></td></tr>');
    });

    function deleteColorRow(color){
        var id = $('#tp_id').val();
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

    function deleteHexaRow(hexa){
        var id = $('#tp_id').val();
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

    function deleteFontRow(font){
        console.log(font);
        var id = $('#tp_id_font').val();
        var fontsList = $('#fontsList'+id).val();
        var fonts = [];
        var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
        fonts.push(fontsToDeleteList);
        var array_fonts = [font];
        fonts.push([array_fonts]);
        document.getElementById("fontsToDeleteList"+id).value = fonts;
        var fontsToDeleteList = $('#fontsToDeleteList'+id).val();
        var finalColors = fontsList.replace(fontsToDeleteList, "");
        document.getElementById("fontsList"+id).value = finalColors;
        console.log('finalColors= '+document.getElementById("fontsList"+id).value);
        document.getElementById("fontsToDeleteList"+id).value = "";
    }

    function deleteFile(font_title, font_name, events_custom_event_id) {
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        $.ajax({
            type: 'delete',
            url: "/admin/EventsCustoms/deleteFile/event/"+events_custom_event_id+'/fonts/'+font_title+'/'+font_name,
            dataType: "JSON",
            data: {
                "events_custom_event_id": events_custom_event_id,
                "font_name": font_name,
                "font_title": font_title,
                _token: '{!! csrf_token() !!}',
            },
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response.msg);
                //$('#' + id).remove();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }

</script>
@endsection