@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3">
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
              {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de l\'événement:']) !!}
              {!! Form::text('advertiser', null, ['class' => 'form-control', 'placeholder' => 'Annonceur :']) !!}
              {!! Form::select('customer_id', $select_customers, null, ['class' => 'form-control']) !!}
              {!! Form::text('address', null, ['class' => 'form-control mt-2', 'placeholder' => 'Adresse :']) !!} 
              {!! Form::text('postal_code', null, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal :']) !!}
              {!! Form::text('city', null, ['class' => 'form-control mt-2', 'placeholder' => 'Ville :']) !!}
              {!! Form::text('country', null, ['class' => 'form-control mt-2', 'placeholder' => 'Pays :']) !!}
              {!! Form::text('longitude', null, ['class' => 'form-control mt-2', 'placeholder' => 'Longitude :']) !!}
              {!! Form::text('lattitude', null, ['class' => 'form-control mt-2', 'placeholder' => 'Lattitude :']) !!}
              {!! Form::date('start_datetime', new \DateTime(), ['class' => 'form-control', 'placeholder' => 'Date de départ :']) !!}
              {!! Form::date('end_datetime', new \DateTime(), ['class' => 'form-control', 'placeholder' => 'Date de fin :']) !!}
              {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type d\'événement :']) !!}
              {!! Form::label('event_products_id[]', 'Sélectionner les produits : ') !!}
              {!! Form::select('event_products_id[]', App\Product::pluck('title','_id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
              {!! Form::label('employees[]', 'Sélectionner l\'équipe : ') !!}
              {!! Form::select('employees[]', App\User::pluck('username','_id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!}
              {!! Form::label('logo_img', 'Ajouter une image/logo : ') !!}
              {!! Form::file('logo_img', array('class' => 'form-control mb-3', 'id' => 'logo_img')) !!}
              {!! Form::label('cover_img', 'Ajouter une image de couverture : ') !!}
              {!! Form::file('cover_img', array('class' => 'form-control mb-3', 'id' => 'cover_img')) !!}
              {!! Form::label('BAT', 'Ajouter le BAT: ') !!}
              {!! Form::file('BAT', array('class' => 'form-control mb-3', 'id' => 'BAT')) !!}
              <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici une description de l'événement."></textarea>
          </div>
  
          {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       
  
          <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_event')}}"> Retour </a>
  
          {!! Form::close() !!}
  
      </div>
  </div>
  @endsection

{{--<div class="container-fluid">
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
            {!! Form::open(['action' => 'EventController@store', 'files' => true, 'class' => 'mb-5']) !!}
            {{csrf_field()}}

              <!-- Team name -->
              <div class="form-group">
                {!! Form::label('name', 'Nom de l\'événement: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
                {!! Form::label('adverstiser', 'Entrer l\'annonceur : ') !!}
                {!! Form::text('advertiser', null, ['class' => 'form-control', 'placeholder' => 'Annonceur:']) !!}
              </div>

              <!-- Team description -->
              <div class="form-group">
                <label class="mb-1">
                  Description de l'événement
                </label>
                <small class="form-text text-muted">
                  This is how others will learn about the project, so make it good!
                </small>
                <div data-toggle="quill" data-quill-placeholder="Description"></div>
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

              {!! Form::close() !!}

          </div>
        </div> <!-- / .row -->
      </div>--}}