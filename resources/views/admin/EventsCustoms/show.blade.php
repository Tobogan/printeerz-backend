@extends('layouts/templateAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col mb-3 ml--3 ml-md--2">
                            <a class="btn btn-link btn-sm mb-3 px-0" href=""><span
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
{!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4']) !!}
{{csrf_field()}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="tab-content" id="myTabContent">
                @include('admin.EventsCustoms.includes.show.tab-content')
            </div>
            {{-- Store Event custom id --}}
            <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
            
            {{-- Store Event product id --}}
            <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">

            {{-- Store Event product title --}}
            <input type="hidden" class="form-control" name="actual_title" value="{{$events_product->title}}">

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
        var array_hexas = [code_hex]
        colors.push([array_colors]);
        hexa.push([array_hexas]);
        document.getElementById("colorsList"+id).value = colors;
        document.getElementById("hexaList"+id).value = hexa;
        console.log(document.getElementById("colorsList"+id).value);
        console.log(document.getElementById("hexaList"+id).value);
        $('#addColorModal').modal('hide');
        $('#submit_modalAddColor').show();
        $('#loading_modalAddColor').addClass('d-none');
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
        var font_tile = $('#ec_font_title').val();
        var font_url = $('#ec_font_url').val();
        var id = $('#tp_id_font').val();
        var fontsList = $('#fontsList'+id).val();
        var font_urlList = document.getElementById("font_urlList"+id).value;
        //console.log(fontsList);
        var fonts = [];
        var url = [];
        fonts.push(fontsList);
        url.push(font_urlList)
        var array_fonts = [font_tile];
        var array_urls = [font_url]
        fonts.push([array_fonts]);
        url.push([array_urls]);
        document.getElementById("fontsList"+id).value = fonts;
        document.getElementById("font_urlList"+id).value = url;
        console.log(document.getElementById("fontsList"+id).value);
        console.log(document.getElementById("font_urlList"+id).value);
        $('#addFontModal').modal('hide');
        $('#submit_modalAddFont').show();
        $('#loading_modalAddFont').addClass('d-none');
        $('#ec_font_title').val('');
        $('#ec_font_url').val('');
    });

</script>
@endsection