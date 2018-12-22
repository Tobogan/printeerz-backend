@extends('layouts/templateAdmin')

@section('content')

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col">
            {!! Form::open(['action' => 'EventVariantsController@store', 'files' => true]) !!}
                {{csrf_field()}}

                <div class="form-group">
                    {!! Form::label('product_id', 'Sélectionner le produit n°1 : ') !!}
                    <select  class="form-control input-sm" id="product_id" name="product_id" >
                            <option disabled selected value="">Sélectionner le produit :</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->nom}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div name="variant_colors" id="variant_colors">
                    <label for="variant">Choisissez les couleurs pour ce produit :</label>
                    <select class="select2 form-control " multiple="multiple" id="variant_id" multiple data-placeholder="Choose ..." name="variant_id[]" style="width: 50%">
                        @foreach ($productvariants as $variant)
                        <option value="{{$variant->id}}">{{$variant->nom}}</option>
                        @endforeach
                    </select>
                </div>

                <!--    <label for="variant">Choisissez les tailles disponibles :</label>
                    <select class="select2 form-control " multiple="multiple" id="taille_id" multiple data-placeholder="Choose ..." name="taille_id[]" style="width: 50%">
                        @foreach ($productvariants as $taille)
                        <option value="{{$taille->id}}">{{$taille->nom}}</option>
                        @endforeach
                    </select>
                </div> -->

            <input type="hidden" id="event_id" name="event_id" value='{{ $event_id }}'>

            <input type="hidden" id="products" name="products" value='{{ $products }}'>

            <div id="variant_color_id"></div>
            {{-- <input type="hidden" id="couleurs" name="couleurs" value='{{ $couleurs }}'> --}}

            <div>
            {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mt-2 mb-2', 'style' => 'float: right']) !!}       

            <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: left" href="{{route('index_event')}}"> Retour </a>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

     @section('javascripts')
     <script>
        $('#product_id').on('change', function(e){
            var product_id = e.target.value;
            var couleurs = $('#couleurs').val();
            $.get('/select_product?product_id='+product_id, function(data){
                // $('#variant_colors').empty();
                $('#btn_color').empty();
                $('#variant_id').empty();
                $('#taille_id').empty();
                // $('#btn_color').append('<button type="button" class="btn btn-primary btn-sm mb-2" id="btn_color_variant">Sélectionner les couleurs</button>');
                $.each(data, function(index, variant){
                    // $('#variant_colors').append('<div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="'+variant.id+'" name="variant_id[]" id="variant_id[]"><label class="form-check-label" for="defaultCheck2">'+variant.nom+'<img src="/uploads/'+variant.pantone+'" class="miniRoundedImage ml-2" alt="pantone" ></label></div>');
                    $('#variant_id').append('<option value="'+variant.id+'">'+variant.nom+'</option>');
                    $('#taille_id').append('<option value="'+variant.id+'">'+variant.taille_id+'</option>');

                    $('#variant_color_id').append('<input type="hidden" id="variants" name="variants" value="'+variant.couleur_id+'">');
                    $('#variant_color_id').append('<input type="hidden" id="tailles" name="tailles" value="'+variant.taille_id+'">');
                    console.log(variant);
                });
            });
        });</script>
    @endsection
@endsection