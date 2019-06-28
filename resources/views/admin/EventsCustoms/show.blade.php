@extends('layouts/templateAdmin')
@section('title', 'Personnalisations')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col mb-3 ml--3 ml-md--2">
                            <a class="btn btn-link btn-sm mb-3 px-0"
                                href="{{route('show_eventsProducts', $events_custom->events_product_id)}}"><span
                                    class="fe fe-chevron-left"></span>Retour</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                MODIFICATION DU GABARIT
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                {{$events_custom->title}}
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-auto mt-2 mt-md-0">
                            <ul class="nav nav-tabs nav-overflow header-tabs" id="myTab" role="tablist">
                                @include('admin.EventsCustoms.includes.show.nav-tabs')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4', 'onsubmit' =>
'return checkErrorsEditEventsCustom()']) !!}
{{csrf_field()}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="tab-content" id="myTabContent">
                @include('admin.EventsCustoms.includes.show.tab-content')
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
            {!! Form::hidden('is_active', $events_custom->is_active, [ 'id'=>'formActive']) !!}
            {{-- Custom actions --}}
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' style="float: left"
                            href="{{route('show_eventsProducts', $events_product->id)}}">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
{{-- Modals includes --}}
@include('admin.EventsCustoms.includes.modal_addColor')
@include('admin.EventsCustoms.includes.modal_addSmode')
@include('admin.EventsCustoms.includes.modal_addFont')
@include('admin.EventsCustoms.includes.modal_selectFont')

@section('javascripts')
@parent()
<script type="text/Javascript">
    $('#AddColorSmode').on('submit', function (e) {
        e.preventDefault();
        var color = $('#smode_color').val();
        var code_hex = $('#smode_code_hex').val();
        var bg_color = $('#smode_bg_color').val();
        var bg_code_hex = $('#smode_bg_code_hex').val();
        var id = $('#tp_id').val();
        var colorsList = $('#smodeColorsList' + id).val();
        var hexaList = $('#smodeHexaList' + id).val();
        var bgColorsList = $('#smodeBgColorsList' + id).val();
        var bgHexaList = $('#smodeBgHexaList' + id).val();
        var colors = [];
        var hexa = [];
        var bg_colors = [];
        var bg_hexa = [];
        $('#submit_modalAddSmodeColor').hide();
        $('#loading_modalAddSmodeColor').removeClass('d-none');
        $(this).removeClass('btn-primary');
        // $(this).addClass('btn-success');
        colors.push(colorsList);
        hexa.push(hexaList);
        bg_colors.push(bgColorsList);
        bg_hexa.push(bgHexaList);
        var array_colors = [color];
        var array_hexas = [code_hex];
        var array_bg_colors = [bg_color];
        var array_bg_hexas = [bg_code_hex];
        colors.push([array_colors]);
        hexa.push([array_hexas]);
        bg_colors.push([array_bg_colors]);
        bg_hexa.push([array_bg_hexas]);
        document.getElementById('smodeColorsList' + id).value = colors;
        document.getElementById('smodeHexaList' + id).value = hexa;
        document.getElementById('smodeBgColorsList' + id).value = bg_colors;
        document.getElementById('smodeBgHexaList' + id).value = bg_hexa;
        $('#addColorSmodeModal').modal('hide');
        $('#submit_modalAddSmodeColor').show();
        $('#loading_modalAddSmodeColor').addClass('d-none');
        $('#smode_color_name_list' + id).append(
            '<tr><td><div class="colorSquare" style="background-color:#' +
            code_hex +
            ';"></div></td></td><td class="smode-color-name">' +
            color +'</td><td><div class="colorSquare" style="background-color:#' +
            bg_code_hex +
            ';"></div></td><td class="smode-color-code_hex">' +
            bg_color +
            '</td><td><a data-id="' +
            id +
            '" data-color="' +
            color +
            '" data-bg_color="' +
            bg_color +
            '" data-bg_hexa="' +
            bg_code_hex +
            '" data-code_hex="' +
            code_hex +
            " \" onclick=\"var id=$(this).attr('data-id');var bg_hexa=$(this).attr('data-bg_hexa');var code_hex=$(this).attr('data-code_hex');var color=$(this).attr('data-color');var bg_color=$(this).attr('data-bg_color');"+ 
            "deleteShowSmodeColor(id,color);deleteShowSmodeHexa(id,code_hex);deleteShowSmodeBgHexa(id,bg_hexa);deleteShowSmodeBgColor(id,bg_color);$(this).closest('tr').remove();"
            + "\" style=\"float:right\">Supprimer</a></td></tr>"
        );
        $('#smode_color').val('');
        $('#smode_code_hex').val('');
        $('#smode_bg_color').val('');
        $('#smode_bg_code_hex').val('');
    });

    function deleteShowSmodeColorRow(id, color) {
        var colorsList = $('#smodeColorsList' + id).val();
        var colors = [];
        colors.push(colorsToDeleteList);
        var array_colors = [color];
        colors.push([array_colors]);
        document.getElementById('smodeColorsToDeleteList' + id).value = colors;
        var colorsToDeleteList = $('#smodeColorsToDeleteList' + id).val();
        var finalColors = colorsList.replace(colorsToDeleteList.substring(1), '');
        document.getElementById('smodeColorsList' + id).value = finalColors;
        document.getElementById('smodeColorsToDeleteList' + id).value = '';
    }

    function deleteShowSmodeHexaRow(id, hexa) {
        var hexaList = $('#smodeHexaList' + id).val();
        var hexas = [];
        var hexasToDeleteList = $('#smodeHexasToDeleteList' + id).val();
        hexas.push(hexasToDeleteList);
        var array_hexas = [hexa];
        hexas.push([array_hexas]);
        document.getElementById('smodeHexasToDeleteList' + id).value = hexas;
        var hexasToDeleteList = $('#smodeHexasToDeleteList' + id).val();
        var finalHexas = hexaList.replace(hexasToDeleteList.substring(1), '');
        document.getElementById('smodeHexaList' + id).value = finalHexas;
        document.getElementById('smodeHexasToDeleteList' + id).value = '';
    }

    function deleteShowSmodeBgColorRow(id, color) {
        var colorsList = $('#smodeBgColorsList' + id).val();
        var colors = [];
        colors.push(colorsToDeleteList);
        var array_colors = [color];
        colors.push([array_colors]);
        document.getElementById('smodeBgColorsToDeleteList' + id).value = colors;
        var colorsToDeleteList = $('#smodeBgColorsToDeleteList' + id).val();
        var finalColors = colorsList.replace(colorsToDeleteList.substring(1), '');
        document.getElementById('smodeBgColorsList' + id).value = finalColors;
        document.getElementById('smodeBgColorsToDeleteList' + id).value = '';
    }
        
    function deleteShowSmodeBgHexaRow(id, hexa) {
        var hexaList = $('#smodeBgHexaList' + id).val();
        var hexas = [];
        var hexasToDeleteList = $('#smodeBgHexasToDeleteList' + id).val();
        hexas.push(hexasToDeleteList);
        var array_hexas = [hexa];
        hexas.push([array_hexas]);
        document.getElementById('smodeBgHexasToDeleteList' + id).value = hexas;
        var hexasToDeleteList = $('#smodeBgHexasToDeleteList' + id).val();
        var finalHexas = hexaList.replace(hexasToDeleteList.substring(1), '');
        document.getElementById('smodeBgHexaList' + id).value = finalHexas;
        document.getElementById('smodeBgHexasToDeleteList' + id).value = '';
    }
</script>
@endsection