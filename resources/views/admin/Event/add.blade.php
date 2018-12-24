@extends('layouts/templateAdmin')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8">
            
            <!-- Header -->
            <div class="header mt-md-5">
              <div class="header-body">
                <div class="row align-items-center">
                  <div class="col">
                    
                    <!-- Pretitle -->
                    <h6 class="header-pretitle">
                      Nouvel événement
                    </h6>

                    <!-- Title -->
                    <h1 class="header-title">
                      Créer un événement
                    </h1>

                  </div>
                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">
                        
                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                        <li class="nav-item">
                            <a href="#!" class="nav-link active">
                            General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                            Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                            Images
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                            Utilisateurs
                            </a>
                        </li>
                        </ul>

                    </div>
                    </div>
              </div>
            </div>

            <!-- Form -->
            <form class="mb-4">

              <!-- Team name -->
              <div class="form-group">
                    {!! Form::label('nom', 'Nom de l\'événement: ') !!}
                    {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
              </div>

              <!-- Team description -->
              <div class="form-group">
                <label class="mb-1">
                  Description de l'événement
                </label>
                <small class="form-text text-muted">
                  This is how others will learn about the project, so make it good!
                </small>
                <div data-toggle="quill"></div>
              </div>

                <!-- Project cover -->
                <div class="form-group">
                        <label class="mb-1">
                          Ajouter le logo de l'événement
                        </label>
                        <small class="form-text text-muted">
                            Please use an image no larger than 1200px * 600px. 
                        </small>
                        <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://">
        
                            <div class="fallback">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="teamCoverUploads">
                                <label class="custom-file-label" for="teamCoverUploads">Choose file</label>
                            </div>
                            </div>
        
                            <div class="dz-preview dz-preview-single">
                            <div class="dz-preview-cover">
                                <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                            </div>
                            </div>
        
                        </div>
                        </div>
              <!-- Divider -->
              <hr class="mt-4 mb-5">

              <!-- Team members -->
              <div class="form-group">
                <label>
                    Sélectionner les utilisateurs autorisés
                </label>
                {!! Form::select('users_list[]', App\User::pluck('email','id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
              </div>



              <!-- Divider -->
              <hr class="mt-5 mb-5">

              <div class="row">
                <div class="col-12 col-md-6">
                  
                  <!-- Private team -->
                  <div class="form-group">
                    <label class="mb-1">
                      Private team
                    </label>
                    <small class="form-text text-muted">
                      If you are available for hire outside of the current situation, you can encourage others to hire you.
                    </small>
                    <div class="custom-control custom-checkbox-toggle">
                      <input type="checkbox" class="custom-control-input" id="exampleToggle" checked>
                      <label class="custom-control-label" for="exampleToggle"></label>
                    </div>
                  </div>
                  
                </div>
                <div class="col-12 col-md-6">

                  <!-- Warning -->
                  <div class="card bg-light border">
                    <div class="card-body">
                      
                      <h4 class="mb-2">
                        <i class="fe fe-alert-triangle"></i> Warning
                      </h4>

                      <p class="small text-muted mb-0">
                        Once a team is made private, you cannot revert it to a public team.
                      </p>

                    </div>
                  </div>
                  
                </div>
              </div> <!-- / .row -->

              <!-- Divider -->
              <hr class="mt-5 mb-5">

              <!-- Buttons -->
              <a href="#" class="btn btn-block btn-primary">
                Create team
              </a>
              <a href="#" class="btn btn-block btn-link text-muted">
                Cancel this team
              </a>

            </form>

          </div>
        </div> <!-- / .row -->
      </div>

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

        </div>

        <div class="form-group">
            {!! Form::label('annonceur', 'Entrer l\'annonceur : ') !!}
            {!! Form::text('annonceur', null, ['class' => 'form-control', 'placeholder' => 'Annonceur:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('customer_id', 'Sélectionner le client : ') !!}
            {!! Form::select('customer_id', $select, null, ['class' => 'form-control', 'placeholder' => '***************************** Séléctionner le client *****************************']) !!}
        </div>

        {{-- <div class="form-group">
            {!! Form::label('product_id', 'Sélectionner le produit n°1 : ') !!}
            <select  class="form-control input-sm" id="product_id" name="product_id" >
                    <option disabled selected value="">Sélectionner le produit n°1</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->nom}}</option>
                @endforeach
            </select>
        </div>
        
        <div name="variant_colors" id="variant_colors">
            <label for="variant">Choisissez les couleurs pour ce produit :</label>
            <select class="select2 form-control " multiple="multiple" id="variant_id" multiple data-placeholder="Choose ..." name="variant_id[]" style="width: 50%">
                @foreach ($productVariants as $variant)
                <option value="{{$variant->id}}">{{$variant->nom}}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group mt-2">
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
                $('#variant_id').empty();
                // $('#btn_color').append('<button type="button" class="btn btn-primary btn-sm mb-2" id="btn_color_variant">Sélectionner les couleurs</button>');
                $.each(data, function(index, variant){
                    // $('#variant_colors').append('<div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="'+variant.id+'" name="variant_id[]" id="variant_id[]"><label class="form-check-label" for="defaultCheck2">'+variant.nom+'<img src="/uploads/'+variant.pantone+'" class="miniRoundedImage ml-2" alt="pantone" ></label></div>');
                    $('#variant_id').append('<option value="'+variant.id+'">'+variant.nom+'</option>');
                    $('#variant_color_id').append('<input type="hidden" id="variants" name="variants" value="'+variant.couleur_id+'">');
                    console.log(variant);
                });
            });
        });</script>
    @endsection
@endsection