@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-2">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => 'EventController@store', 'files' => true]) !!}
        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('nom', 'Entrer le nom : ') !!}
            {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('annonceur', 'Entrer l\'annonceur : ') !!}
            {!! Form::text('annonceur', null, ['class' => 'form-control', 'placeholder' => 'Annonceur:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('customer_id', 'Sélectionner le client : ') !!}
            {!! Form::select('customer_id', $select, null, ['class' => 'form-control', 'placeholder' => '***************************** Séléctionner le client *****************************']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('product_id', 'Sélectionner les produits : ') !!}
            {{-- {!! Form::select('product_id',$select_products, null, ['class' => 'form-control', 'name' =>'product_id', 'id' => 'product_id', 'placeholder' => '**************************** Séléctionner le produit ****************************']) !!}  --}}
            <select  class="form-control input-sm" id="product_id" name="product_id" >
                @foreach($products as $product)
                    <option  placeholder="ajouter variante" value="{{$product->id}}">{{$product->nom}}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group">
             <select class="form-control input-sm" id="variants" name="variants" placeholder="ajouter variante">
                <option value=""></option>
            </select>
        </div> --}}
        <div id="btn_color"></div>
        
        <div name="variant_colors" id="variant_colors">
            <label for="variant">Variants</label>
            <select class="select2 form-control " multiple="multiple" id="variant_id" multiple data-placeholder="Choose ..." name="variant_id[]" style="width: 50%">
                {{-- @foreach ($productVariants as $variant)
                <option value="{{$variant->id}}">{{$variant->nom}}</option>
                @endforeach --}}
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('users_list[]', 'Sélectionner les utilisateurs autorisés : ') !!}
            {!! Form::select('users_list[]', App\User::pluck('email','id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
        </div>

        <div class="form-group mt-2">
            {!! Form::label('lieu', 'Entrer le lieu : ') !!}
            {!! Form::text('lieu', null, ['class' => 'form-control', 'placeholder' => 'Lieu:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('type', 'Entrer le type d\'événement : ') !!}
            {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('date', 'Entrer la date de l\'événement : ') !!}
            {{ Form::date('date', new \DateTime(), ['class' => 'form-control', 'placeholder' => 'Date:']) }}
        </div>

        <div class="form-group">
            {!! Form::label('image', 'Ajouter le logo de l\'événement: ') !!}
            {!! Form::file('image', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('BAT', 'Ajouter le BAT de l\'événement: ') !!}
            {!! Form::file('BAT', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!}
            <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant l'événement."></textarea>
            <br>
        </div>

        <input type="hidden" id="products" name="products" value='{{ $products }}'>

        <div id="variant_color_id"></div>
        <input type="hidden" id="couleurs" name="couleurs" value='{{ $couleurs }}'>
        @foreach($couleurs as $couleur) 
            <input type="hidden" id="couleur" name="couleur" value='{{ $couleur->id }}'>
        @endforeach

        {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mb-2 mt-2', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm mt-2' style="float: left" href="{{route('index_event')}}"> Retour </a>      

        {!! Form::close() !!}
</div>

    @section('javascripts')
    <script>
        $('#product_id').on('change', function(e){
            var product_id = e.target.value;
            var couleurs = $('#couleurs').val();
            $.get('/select_product?product_id='+product_id, function(data){
                // $('#variant_colors').empty();
                $('#btn_color').empty();
                // $('#variant_id').empty();
                // $('#btn_color').append('<button type="button" class="btn btn-primary btn-sm mb-2" id="btn_color_variant">Sélectionner les couleurs</button>');
                $.each(data, function(index, variant){
                    // $('#variant_colors').append('<div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="'+variant.id+'" name="variant_id[]" id="variant_id[]"><label class="form-check-label" for="defaultCheck2">'+variant.nom+'<img src="/uploads/'+variant.pantone+'" class="miniRoundedImage ml-2" alt="pantone" ></label></div>');
                    $('#variant_id').append('<option value="'+variant.id+'">'+variant.nom+'</option>');
                    $('#variant_color_id').append('<input type="hidden" id="variants" name="variants" value="'+variant.couleur_id+'">');
                    
                    console.log(variant);
                });
            });
        });

        // $('#btn_color_variant').live('click', function(e){
        //     $.get('/colors', function(data){
        //         success: function(data){
        //             console.log(data);
        //             $('#variant_colors').append('<input class="form-check-input" type="checkbox" value="'+data.id+'" id="variant"><label class="form-check-label" for="defaultCheck2">'+data.nom+'</label> <img src="/uploads/'+data.pantoneName+'" class="miniRoundedImage" alt="pantone" ><div class="form-check"> </div>');
        //         }
        //     });
        // });

        //     $('#btn_color_variant').live('click', function(e) {
        //     e.preventDefault(); 
        //     // var couleur_id = $('#variants').val();
        //     $.ajax({
        //         type: "GET",
        //         url: '/admin/Couleur/index_productVariants',
        //         success: function(data){
        //             console.log(data);
        //             // $('#variant_colors').append('<input class="form-check-input" type="checkbox" value="'+data.id+'" id="variant"><label class="form-check-label" for="defaultCheck2">'+data.nom+'</label> <img src="/uploads/'+data.pantoneName+'" class="miniRoundedImage" alt="pantone" ><div class="form-check"> </div>');
        //         }
        //     });
        // });

                
    //     $('#btn_color_variant').live('click', function(e){
    //     var color_id =  $('#variants').val();
    //     $.get('/select_color?color_id='+color_id, function(data){
    //         $.each(data, function(index, couleur){
    //             console.log();
    //             $('#variant_colors').append('<div class="form-check"><input class="form-check-input" type="checkbox" value="'+variant.couleur_id+'" id="variants"><label class="form-check-label" for="defaultCheck2">'+variant.couleur_id+'</label></div>');
    //             // $('#variant_colors').append('<div>'+variant.zone1+'</div>');
    //         });
    //     });
    // });</script>

    {{-- <script>
    $('#variants').on('change', function(e){
        var color_id = e.target.value;
        var couleur_id = $('#variants').val();
        $.get('/select_color?color_id='+color_id, function(data){
            $('#variants').empty();

            console.log(couleur_id);
                $('#variants').append('<div class="form-check"><input class="form-check-input" type="checkbox" value="'+couleur.id+'" id="variants"><label class="form-check-label" for="defaultCheck2">'+couleur.nom+'</label></div>');
        });
    });</script> --}}
    @endsection
@endsection