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
{!! Form::open(['action' => 'EventController@store', 'files' => true]) !!}
{{csrf_field()}}
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
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
            {!! Form::text('name', null, ['class' => 'form-control' . $errors->first('name', '
            is-invalid'), 'placeholder' => 'Nom de l\'événement']) !!}
            @if($errors->has('name'))<div class="invalid-feedback">Veuillez renseigner le nom de l'événement</div>@endif
          </div>
          <div class="form-group">
            <label class="mb-1">
              Client
            </label>
            <small class="form-text text-muted">
              Sélectionnez le client. S'il n'existe pas, veuillez le créer dans la section Clients
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
              Renseignez le nom de l'annonceur.
            </small>
            {!! Form::text('advertiser', null, ['class' => 'form-control' . $errors->first('advertiser', '
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
                {!! Form::date('start_datetime', new \DateTime(), ['class' => 'form-control'.
                $errors->first('start_datetime', ' is-invalid'), 'placeholder' => 'Début', 'data-toggle' =>
                'flatpickr']) !!}
                @if($errors->has('start_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire
                  antérieure ou égale à la date de début.</div>@endif
              </div>
            </div>

            <div class="col-12 col-md-6">
              <!-- Lieu -->
              <div class="form-group">
                <label>
                  Date de fin
                </label>
                {!! Form::date('end_datetime', new \DateTime(), ['class' => 'form-control'.
                $errors->first('end_datetime', ' is-invalid'), 'placeholder' => 'Fin',
                'data-toggle' => 'flatpickr']) !!}
                @if($errors->has('end_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire
                  antérieure ou égale à la date de début.</div>@endif

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-6">
              <!-- heure de début-->
              <div class="form-group">
                <label>
                  Heure de début
                </label>
                {{Form::time('start_time', '08:00:00',['class' => 'form-control'])}}
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
                {{Form::time('end_time', '18:00:00',['class' => 'form-control'])}}
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
            <input class="form-control mt-2" id="formPlacesAuto" placeholder="Renseigner l'adresse"
              name="autocompleteAddress" type="text" autocomplete="false" onFocus="initMap();">
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
            {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type d\'événement']) !!}
            {!! $errors->first('type', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
            </p>') !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-header-title mt-2">
                Participants
                <small class="form-text text-muted my-2">Sélectionnez les participants et utilisateurs
                  autorisées.</small>
              </h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                {!! Form::select('employees[]', App\User::pluck('username','_id'),null, ['class' => 'form-control'.
                $errors->first('employees', ' is-invalid'), 'multiple', 'data-toggle' => 'select']) !!}
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
                <p><small class="form-text text-muted">
                    Vous pouvez décrire l'événement (max: 750 caractères)
                  </small></p>
              </h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control','rows' => 4,
                'cols' => 54, 'maxlength' => '750']) !!}
                {!! $errors->first('description', '<p class="help-block mt-2" style="color:red;"><small>:message</small>
                </p>') !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      {!! Form::submit('Créer l\'événement', ['class' => 'btn btn-block btn-primary']) !!}
      <a href="{{route('index_event')}}" class="btn btn-block btn-link text-muted">
        Annuler
      </a>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('javascripts')
<script type="text/Javascript">
  // $('#datetimepicker3').datetimepicker({
  //   format: 'LT'
  //   });
</script>
@endsection