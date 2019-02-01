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
            {{-- Body --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['action' => array('CustomerController@store'), 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom du client
                        </label>
                        <!-- Input -->
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom du client'])
                        !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Activité
                        </label>
                        <!-- Input -->
                        {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder' =>
                        'Activité:']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            SIREN
                        </label>
                        <!-- Input -->
                        {!! Form::text('SIREN', null, ['class' => 'form-control', 'placeholder' => 'SIREN/SIRET']) !!}
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Adresse</p>
                    <p class="mb-4">Entrez les informations de la personne avec laquelle vous êtes en contact.</p>
                </div>
                <div class="col-12">
                    <!-- Address  -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Adresse
                        </label>
                        <!-- Input -->
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse'])
                        !!}
                    </div>
                </div>
                <div class="col-12">
                    {!! Form::hidden('longitude', null) !!}
                    {!! Form::hidden('lattitude', null) !!}
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Code postal
                        </label>
                        <!-- Input -->
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Ville
                        </label>
                        <!-- Input -->
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville :']) !!}
                    </div>
                </div>
                <div class="col-12">
                    <label>
                        Pays
                    </label>
                    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays :']) !!}
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Nom du contact</p>
                    <p class="mb-4">Entrez les informations de la personne avec laquelle vous êtes en contact.</p>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom
                        </label>
                        <!-- Input -->
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Prénom
                        </label>
                        <!-- Input -->
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Email
                        </label>
                        <!-- Input -->
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Téléphone
                        </label>
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone',
                        'data-mask' => '00 00 00 00 00']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Poste
                        </label>
                        {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' => 'Poste'])!!}
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Logo</p>
                    <p class="mb-4">Ajouter le logo du client en format 1:1</p>
                </div>
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://" id="logo_event_upload">
                            <div class="fallback">
                                <div class="custom-file">
                                    {!! Form::file('image', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
                                    <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
                                </div>
                            </div>
                            <div class="dz-preview dz-preview-single">
                                <div class="dz-preview-cover">
                                    <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Evénements déjà organisés
                        </label>
                        <!-- Input -->
                        {!! Form::select('shows_id[]', App\Event::pluck('name','_id'), null, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                    </div>
                </div>
            </div>
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le client', ['class' => 'btn btn-primary', 'style' => 'float: right'])
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