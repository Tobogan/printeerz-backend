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
                                CREATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Créer un client
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open(['action' => array('CustomerController@store'), 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Informations générales du client.
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>
                                    Nom du client
                                </label>
                                {!! Form::text('title', null, ['class' => 'form-control',
                                'placeholder' => 'Nom du client']) !!}
                                {!! $errors->first('title', '<p class="help-block mt-2" style="color:red;">
                                    <small>:message</small></p>') !!}
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Activité
                                        </label>
                                        {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder'
                                        =>'Activité']) !!}
                                        {!! $errors->first('activity_type', '<p class="help-block mt-2"
                                            style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            SIREN
                                        </label>
                                        {!! Form::text('SIREN', null, ['class' => 'form-control', 'placeholder' =>
                                        '012345678', 'data-mask' => '000000000' ]) !!}
                                        {!! $errors->first('SIREN', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
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
                                Adresse de la société
                                <p class="text-muted mt-2"><small>L'adresse va s'autocompléter.</small></p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control mt-2" id="formPlacesAuto"
                                        placeholder="Renseigner l'adresse" name="autocompleteAddress" type="text"
                                        autocomplete="false" onFocus="initMap();">
                                    <input class="form-control mt-2" name="address" id="address" type="hidden">
                                    <input class="form-control mt-2" name="postal_code" id="postal_code" type="hidden">
                                    <input class="form-control mt-2" name="city" id="city" type="hidden">
                                    <input class="form-control mt-2" name="country" id="country" type="hidden">
                                    <input class="form-control mt-2" name="lattitude" id="latitude" type="hidden">
                                    <input class="form-control mt-2" name="longitude" id="longitude" type="hidden">
                                </div>
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
                                Contact
                                <p class="text-muted mt-2"><small>Entrez les informations de la personne avec laquelle
                                        vous êtes en contact.</small></p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Nom
                                        </label>
                                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' =>
                                        'Nom'])
                                        !!}
                                        {!! $errors->first('lastname', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Prénom
                                        </label>
                                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' =>
                                        'Prénom']) !!}
                                        {!! $errors->first('firstname', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Email
                                        </label>
                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' =>
                                        'user@email.com']) !!}
                                        {!! $errors->first('email', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Téléphone
                                        </label>
                                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' =>
                                        '0123456789',
                                        'data-mask' => '00 00 00 00 00']) !!}
                                        {!! $errors->first('phone', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Poste
                                        </label>
                                        {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' =>
                                        'Poste'])!!}
                                        {!! $errors->first('job_title', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
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
                                Logo
                                <p class="text-muted mt-2"><small>Ajoutez le logo du client de préférence en format 1:1
                                        (format: jpeg,jpg,png | format: jpeg,jpg,png | max: 4mo)</small></p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="image">Télécharger le logo</label>
                                        {!! Form::file('image', array('class' => 'form-control', 'id' => 'logo_img'))
                                        !!}
                                        {!! $errors->first('image', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Evénements déjà organisés
                                <p class="text-muted mt-2"><small>Seulement si vous souhaitez ajouter des événements
                                        passés avec ce nouveau client</small> </p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::select('shows_id[]', App\Event::pluck('name','_id'), null, ['class' =>
                                'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                                {!! $errors->first('shows_id', '<p class="help-block mt-2" style="color:red;">
                                    <small>:message</small></p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le client', ['class' => 'btn btn-primary', 'style' => 'float:
                        right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_customer')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection