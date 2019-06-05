@extends('layouts/templateAdmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                {{$customer->title}}
                            </h6>
                            <h1 class="header-title">
                                Modifier le client
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('CustomerController@update', 'id' => $customer->id), 'files' => true, 'class' => 'mb-4']) !!}
            {{csrf_field()}}
                <div class="row">
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
                                    {!! Form::text('title', $customer->title, ['class' => 'form-control' . $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom du client']) !!}
                                    @if($errors->has('title'))<div class="invalid-feedback">Veuillez renseigner le nom du client</div>@endif
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Activité
                                            </label>
                                            {!! Form::text('activity_type', $customer->activity_type, ['class' => 'form-control'. $errors->first('activity_type', ' is-invalid'), 'placeholder' =>'Activité']) !!}
                                            @if($errors->has('activity_type'))<div class="invalid-feedback">Veuillez renseigner une activité</div>@endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                SIREN
                                            </label>
                                            {!! Form::text('SIREN', $customer->SIREN, ['class' => 'form-control'. $errors->first('SIREN', ' is-invalid'), 'placeholder' => '012345678', 'data-mask' => '000000000' ]) !!}
                                            @if($errors->has('SIREN'))<div class="invalid-feedback">Veuillez renseigner un numéro de SIREN valide</div>@endif
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
                                    <p class="text-muted mt-2">L'adresse va s'autocompléter directement</p>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control mt-2" id="formPlacesAuto" placeholder="Renseigner l'adresse" name="autocompleteAddress"
                                            type="text" autocomplete="false" onFocus="initMap();">
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
                                    Nom du contact
                                    <p class="text-muted mt-2">Entrez les informations de la personne avec laquelle vous êtes en contact.</p>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Nom
                                            </label>
                                            {!! Form::text('lastname', $customer->contact_person['lastname'], ['class' => 'form-control', 'placeholder' => 'Nom'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Prénom
                                            </label>
                                            {!! Form::text('firstname', $customer->contact_person['firstname'], ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Email
                                            </label>
                                            {!! Form::email('email', $customer->contact_person['email'], ['class' => 'form-control', 'placeholder' => 'user@email.com']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Téléphone
                                            </label>
                                            {!! Form::text('phone', $customer->contact_person['phone'], ['class' => 'form-control', 'placeholder' => '0123456789',
                                            'data-mask' => '00 00 00 00 00']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Poste
                                            </label>
                                            {!! Form::text('job_title', $customer->contact_person['job_title'], ['class' => 'form-control', 'placeholder' =>
                                            'Poste'])!!}
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
                                    <p class="text-muted mt-2">Ajoutez le logo du client de préférence en format 1:1 (format: jpeg,jpg,png | max: 4mo)</p>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            {!! Form::file('image', array('class' => 'custom-file-input', 'id' => 'logo_img'))
                                            !!}
                                            <label class="custom-file-label" for="projectCoverUploads">Télécharger le logo</label>
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
                                    Evénements déjà organisés
                                    <p class="text-muted mt-2">Seulement si vous souhaitez ajouter des événements passés avec ce nouveau client</p>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::select('shows_id[]', App\Event::pluck('name','_id'), null, ['class' =>
                                    'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('is_active', "true") !!}
                {!! Form::hidden('is_deleted', "false") !!}
                <div class="row">
                    <div class="col-12">
                        <div class="buttons">
                            {!! Form::submit('Mettre à jour', ['class' => 'btn btn-primary', 'style' => 'float: right']) !!}
                            <a class='btn btn-secondary' style="float: left" href="{{route('index_customer')}}">Annuler</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection