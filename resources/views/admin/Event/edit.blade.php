@extends('layouts/templateAdmin')
@section('title', 'Modifier ' . $event->name)

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
                                Modifier {{$event->name}}
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
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            {!! Form::open(['action' => array('EventController@update'),'files' => true]) !!}
            {{csrf_field()}}
                <!-- Event name -->
                <div class="form-group">
                    <label>
                        Nom de l'événement
                    </label>
                    {!! Form::text('name', $event->name, ['class' => 'form-control'. $errors->first('name', 'is-invalid'), 'placeholder' => 'Nom de l\'événement']) !!}
                    @if($errors->has('name'))<div class="invalid-feedback">Veuillez renseigner le nom de l'événement</div>@endif
                </div>

                <!-- Customer -->
                <div class="form-group">
                    <label class="mb-1">
                        Client
                    </label>
                    <small class="form-text text-muted">
                        Sélectionnez le client. S'il n'existe pas, veuillez le créer dans la section Clients.
                    </small>
                    {!! Form::select('customer_id', $select_customers, $event->customer_id, ['class' => 'form-control', 'data-toggle' => 'select']) !!}
                </div>

                <!-- Advertiser -->
                <div class="form-group">
                    <label class="mb-1">
                        Annonceur
                    </label>
                    <small class="form-text text-muted">
                        This is how others will learn about the project, so make it good!
                    </small>
                    {!! Form::text('advertiser', $event->advertiser, ['class' => 'form-control' . $errors->first('advertiser', 'is-invalid'), 'placeholder' => 'Nom de l\'annonceur']) !!}
                    @if($errors->has('advertiser'))<div class="invalid-feedback">Veuillez renseigner le nom de l'annonceur</div>@endif

                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Date -->
                        <div class="form-group">
                            <label>
                                Date de début
                            </label>
                            {!! Form::date('start_datetime', $event->start_datetime, ['class' => 'form-control'. $errors->first('start_datetime', ' is-invalid'), 'placeholder' => 'Début', 'data-toggle' => 'flatpickr']) !!}
                            @if($errors->has('start_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire antérieure ou égale à la date de début.</div>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Lieu -->
                        <div class="form-group">
                            <label>
                                Date de fin
                            </label>
                            {!! Form::date('end_datetime', $event->end_datetime, ['class' => 'form-control'. $errors->first('end_datetime', ' is-invalid'),
                            'placeholder' => 'Fin',
                            'data-toggle' => 'flatpickr']) !!}
                            @if($errors->has('end_datetime'))<div class="invalid-feedback">La date de début doit être obligatoire antérieure ou égale à la date de début.</div>@endif
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
                        name="autocompleteAddress" type="text" autocomplete="false" onFocus="initMap();" value="{{ $event->location['address']}}">
                    <input class="{{'form-control mt-2' . $errors->first('end_datetime', ' is-invalid')}}" name="address" id="address" type="hidden">
                    <input class="form-control mt-2" name="postal_code" id="postal_code" type="hidden">
                    <input class="form-control mt-2" name="city" id="city" type="hidden">
                    <input class="form-control mt-2" name="country" id="country" type="hidden">
                    <input class="form-control mt-2" name="lattitude" id="latitude" type="hidden">
                    <input class="form-control mt-2" name="longitude" id="longitude" type="hidden">
                </div>
                @if($errors->has('adress'))<div class="invalid-feedback">Le champ "adresse" est obligatoire.</div>@endif

                <!-- Event type -->
                <div class="form-group">
                    <label class="mb-1">
                        Type de l'événement
                    </label>
                    <small class="form-text text-muted">
                        De quel type est cet événement ?
                    </small>
                    {!! Form::text('type', $event->type, ['class' => 'form-control', 'placeholder' => 'Type d\'événement']) !!}
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <p class="h3">Participants</p>
                            <p class="text-muted b-4">Sélectionnez les participants et utilisateurs autorisées.</p>
                            {!! Form::select('employees[]', App\User::pluck('username','_id'),$event->user_ids, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-2 mb-2">

                <!-- Event logo -->
                <div class="form-group">
                    <label class="mb-1">
                        Logo de l'événement
                    </label>
                    <small class="form-text text-muted">
                        Utilisez une image au format 1:1 avec une taille 400x400 maximum de moins de 5mo.
                    </small>
                    <div class="custom-file">
                        {!! Form::file('logo_img', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
                        <label class="custom-file-label" for="logo_img">Charger une image</label>
                    </div>
                </div>

                <!-- Event cover -->
                <div class="form-group">
                    <label class="mb-1">
                        Cover de l'événement
                    </label>
                    <small class="form-text text-muted">
                        Utilisez une image au format 1:1 avec une taille 400x400 maximum de moins de 5mo.
                    </small>
                    <div class="custom-file">
                        {!! Form::file('cover_img', array('class' => 'custom-file-input', 'id' => 'cover_img' )) !!}
                        <label class="custom-file-label" for="cover_img">Charger une image</label>
                    </div>
                </div>
                <div class="form-group">
                <label class="mb-1">
                    BAT de l'événement
                </label>
                <small class="form-text text-muted">
                    Utilisez un .pdf de moins de 5mo.
                </small>
                <div class="custom-file">
                    {!! Form::file('BAT', array('class' => 'custom-file-input', 'id' => 'BAT' )) !!}
                    <label class="custom-file-label" for="BAT">Charger un nouveau BAT</label>
                </div>
                </div>
                <!-- Divider -->
                <hr class="mt-4 mb-5">

                <div class="form-group">
                    <label>Description de l'événement</label>
                    <input id="textDescription" type="textarea" class="description" name="description" rows="3" value="{{ $event->description }}">
                </div>
                {{-- Input Hidden --}}
                <input type="hidden" name="actual_name" value="{{$event->name}}">
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