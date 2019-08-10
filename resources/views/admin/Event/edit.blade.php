@extends('layouts/templateAdmin')
@section('title', 'Modifier ' . $event->title)

@section('content')

<div class="container mt-md-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      <!-- Header -->
      <div class="header">
        <div class="header-body">
          <div class="row align-items-center">
            <div class="col">
              <!-- Pretitle -->
              <h6 class="header-pretitle">
                Nouvel événement
              </h6>
              <!-- Title -->
              <h1 class="header-title">
                Modifier {{$event->title}}
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

{!! Form::open(['action' => array('EventController@update'),'files' => true]) !!}
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      {{csrf_field()}}
      <div class="card">
        <div class="card-header">
          <h4 class="card-header-title mt-2">
            Informations générales de l'événément.
          </h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>
              Nom de l'événement
            </label>
            {!! Form::text('name', $event->title, ['class' => 'form-control' . $errors->first('name', '
            is-invalid'), 'placeholder' => 'Nom de l\'événement']) !!}
            @if($errors->has('name'))<div class="invalid-feedback">Veuillez renseigner le nom de l'événement</div>@endif
          </div>
          <div class="form-group">
            <label class="mb-1">
              Client
            </label>
            <small class="form-text text-muted">
              Sélectionner le client. S'il n'existe pas, veuillez le créer dans la section Clients
            </small>
            {!! Form::select('customer_id', $select_customers, $event->customer_id, ['class' => 'form-control',
            'data-toggle' =>
            'select']) !!}
          </div>

          <!-- Advertiser -->
          <div class="form-group">
            <label class="mb-1">
              Annonceur
            </label>
            <small class="form-text text-muted">
              Renseigner le nom de l'annonceur.
            </small>
            {!! Form::text('advertiser', $event->advertiser, ['class' => 'form-control' . $errors->first('advertiser', '
            is-invalid'), 'placeholder' => 'Nom de l\'annonceur']) !!}
            @if($errors->has('advertiser'))<div class="invalid-feedback">Veuillez renseigner le nom de l'annonceur</div>
            @endif
          </div>

          <div class="row">
            <div class="col-12 col-md-6">
              <!-- Date -->
              <div class="form-group">
                <label>
                  Date de début
                </label>
                {!! Form::date('start_datetime', $event->start_datetime, ['class' => 'form-control'.
                $errors->first('start_datetime', ' is-invalid'), 'placeholder' => 'Début', 'data-toggle' =>
                'flatpickr']) !!}
                @if($errors->has('start_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire
                  antérieure ou égale à la date de début.</div>@endif
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                <label>
                  Date de fin
                </label>
                {!! Form::date('end_datetime', $event->end_datetime, ['class' => 'form-control'.
                $errors->first('end_datetime', ' is-invalid'), 'placeholder' => 'Fin',
                'data-toggle' => 'flatpickr']) !!}
                @if($errors->has('end_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire
                  antérieure ou égale à la date de début.</div>@endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-6">
              <!-- Heure de début-->
              <div class="form-group">
                <label>
                  Heure de début
                </label>
                {{Form::time('start_time', $event->start_time,['class' => 'form-control'])}}
                {!! $errors->first('start_time', '<p class="help-block mt-2" style="color:red;">
                  <small>:message</small></p>') !!}
              </div>
            </div>

            <div class="col-12 col-md-6">
              <!-- Heure de fin -->
              <div class="form-group">
                <label>
                  Heure de fin
                </label>
                {{Form::time('end_time', $event->end_time,['class' => 'form-control'])}}
                {!! $errors->first('end_time', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
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
            <input class="form-control mt-2" id="formPlacesAuto" placeholder="Renseignez l'adresse"
              name="autocompleteAddress" type="text" autocomplete="false" onFocus="initMap();"
              value="{{ $event->location['address'].$event->location['city'] }}">
            <input class="{{ 'form-control mt-2' . $errors->first('address', ' is-invalid')}}" name="address"
              id="address" type="hidden">
            <input class="form-control mt-2" name="postal_code" id="postal_code" type="hidden">
            <input class="form-control mt-2" name="city" id="city" type="hidden">
            <input class="form-control mt-2" name="country" id="country" type="hidden">
            <input class="form-control mt-2" name="lattitude" id="latitude" type="hidden">
            <input class="form-control mt-2" name="longitude" id="longitude" type="hidden">
          </div>
          @if($errors->has('address'))<div class="invalid-feedback">Le champ "adresse" est obligatoire.</div>@endif
          <div class="form-group">
            <label class="mb-1">
              Type de l'événement
            </label>
            <small class="form-text text-muted">
              De quel type est cet événement ?
            </small>
            {!! Form::text('type', $event->type, ['class' => 'form-control', 'placeholder' => 'Type d\'événement']) !!}
            {!! $errors->first('type', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title mt-2">
                Participants
                <p class="text-muted mt-2">Sélectionnez les participants et utilisateurs autorisées.</p>
              </h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                {!! Form::select('employees[]', App\User::pluck('username','_id'),$event->user_ids, ['class' =>
                'form-control'. $errors->first('employees', ' is-invalid'), 'multiple', 'data-toggle' => 'select']) !!}
                {!! $errors->first('employees', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title mt-2">
                Images et Bon à tirer
              </h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="mb-1">
                  Logo de l'événement
                </label>
                <small class="form-text text-muted">
                  Utilisez une image au format 1:1 avec une taille 400x400 (format: jpeg,jpg,png | max: 4mo).
                </small>
                {!! Form::file('logo_img', array('class' => 'form-control', 'id' => 'logo_img')) !!}
                {!! $errors->first('logo_img', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
              </div>
              <div class="form-group">
                <label class="mb-1">
                  Cover de l'événement
                </label>
                <small class="form-text text-muted">
                  Utilisez une image au format 1:1 avec une taille 400x400 (format: jpeg,jpg,png | max: 4mo).
                </small>
                {!! Form::file('cover_img', array('class' => 'form-control', 'id' => 'cover_img' )) !!}
                {!! $errors->first('cover_img', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
              </div>
              <div class="form-group">
                <label class="mb-1">
                  BAT de l'événement
                </label>
                <small class="form-text text-muted">
                  Utilisez un .pdf de moins de 4mo.
                </small>
                {!! Form::file('BAT', array('class' => 'form-control', 'id' => 'BAT' )) !!}
                {!! $errors->first('BAT', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>')
                !!}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title mt-2">
                Description de l'événement
              </h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                {!! Form::textarea('description', $event->description, ['id' => 'description', 'class' =>
                'form-control','rows' => 4, 'cols' => 54]) !!}
                {!! $errors->first('description', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Input Hidden --}}
      <input type="hidden" name="actual_customer_id" value="{{$event->customer_id}}">
      <input type="hidden" name="id" value="{{$event->id}}">
      <!-- Divider -->
      <hr class="mt-4 mb-5">
      <!-- Buttons -->
      {!! Form::submit('Modifier', ['class' => 'btn btn-block btn-primary']) !!}
      <a href="{{route('show_event', $event->id)}}" class="btn btn-block btn-link text-muted">
        Annuler
      </a>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection