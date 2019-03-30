@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-md-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      <div class="header">
        <div class="header-body">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="header-pretitle">
                Nouvel événement
              </h6>
              <h1 class="header-title">
                Créer un événement
              </h1>
            </div>
            <div class="col-auto">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      {!! Form::open(['action' => 'EventController@store', 'files' => true]) !!}
      {{csrf_field()}}
        <div class="form-group">
          <label>
            Nom de l'événement
          </label>
          {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de l\'événement']) !!}
        </div>
        <div class="form-group">
          <label class="mb-1">
            Client
          </label>
          <small class="form-text text-muted">
            Sélectionner le client. S'il n'existe pas, veuillez le créer dans la section Clients
          </small>
          {!! Form::select('customer_id', $select_customers, null, ['class' => 'form-control', 'data-toggle' =>
          'select']) !!}
        </div>

        <!-- Advertiser -->
        <div class="form-group">
          <label class="mb-1">
            Annonceur
          </label>
          <small class="form-text text-muted">
            This is how others will learn about the project, so make it good!
          </small>
          {!! Form::text('advertiser', null, ['class' => 'form-control', 'placeholder' => 'Nom de l\'annonceur'])
          !!}
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
            <!-- Date -->
            <div class="form-group">
              <label>
                Date de début
              </label>
              {!! Form::date('start_datetime', new \DateTime(), ['class' => 'form-control', 'placeholder' =>
              'Début', 'data-toggle' => 'flatpickr']) !!}
            </div>
          </div>

          <div class="col-12 col-md-6">
            <!-- Lieu -->
            <div class="form-group">
              <label>
                Date de fin
              </label>
              {!! Form::date('end_datetime', new \DateTime(), ['class' => 'form-control', 'placeholder' => 'Fin',
              'data-toggle' => 'flatpickr']) !!}
            </div>
          </div>
        </div>

        <!-- Lieu -->
        <div class="form-group">
          <label class="mb-1">
            Lieu de l'événement
          </label>
          <small class="form-text text-muted">
            Où se déroule l'événement?
          </small>
          <input class="form-control mt-2" id="formPlacesAuto" placeholder="Renseigner l'adresse"
            name="autocompleteAddress" type="text" autocomplete="false" onFocus="initMap();">
          <input class="form-control mt-2" name="address" id="address" type="hidden">
          <input class="form-control mt-2" name="postal_code" id="postal_code" type="hidden">
          <input class="form-control mt-2" name="city" id="city" type="hidden">
          <input class="form-control mt-2" name="country" id="country" type="hidden">
          <input class="form-control mt-2" name="lattitude" id="latitude" type="hidden">
          <input class="form-control mt-2" name="longitude" id="longitude" type="hidden">
        </div>
        <div class="form-group">
          <label class="mb-1">
            Type de l'événement
          </label>
          <small class="form-text text-muted">
            De quel type est cet événement ?
          </small>
          {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type d\'événement']) !!}
        </div>
        <hr class="mt-4 mb-5">
        <div class="form-group">
          <label class="mb-1">
            Logo de l'événement
          </label>
          <small class="form-text text-muted">
            Utilisez une image au format 1:1 avec une taille 400x400 maximum
          </small>
          <div class="custom-file">
            {!! Form::file('logo_img', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
            <label class="custom-file-label" for="logo_img">Charger une image</label>
          </div>
        </div>
        <div class="form-group">
          <label class="mb-1">
            Cover de l'événement
          </label>
          <small class="form-text text-muted">
            Utilisez une image au format 1:1 avec une taille 400x400 maximum
          </small>
          <div class="custom-file">
            {!! Form::file('cover_img', array('class' => 'custom-file-input', 'id' => 'cover_img' )) !!}
            <label class="custom-file-label" for="cover_img">Charger une image</label>
          </div>
        </div>
        <hr class="mt-4 mb-5">
        <div class="form-group">
          <label>Description de l'événement</label>
          <input id="textDescription" type="textarea" class="description" name="description" rows="3">
        </div>
        <hr class="mt-4 mb-5">
        {!! Form::submit('Créer l\'événement', ['class' => 'btn btn-block btn-primary']) !!}
        <a href="{{route('index_event')}}" class="btn btn-block btn-link text-muted">
          Annuler
        </a>
        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection