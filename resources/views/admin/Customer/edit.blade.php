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
                                Overview
                            </h6>
                            <!-- Title -->
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
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['action' => array('CustomerController@update', 'id' => $customer->id), 'files' => true,
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
                        @if(isset($customer->title))
                        {!! Form::text('title', $customer->title, ['class' => 'form-control', 'placeholder' =>
                        'Titre']) !!}
                        @else
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom du
                        client']) !!}
                        @endif

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
                        {!! Form::text('activity_type', $customer->activity_type, ['class' => 'form-control',
                        'placeholder' => 'Activité:']) !!}
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
                        {!! Form::text('SIREN', $customer->SIREN, ['class' => 'form-control', 'placeholder' =>
                        'SIREN/SIRET:']) !!}
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
                        @if(isset($customer->location['address']))
                        {!! Form::text('address', $customer->location['address'], ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
                        @else
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse'])
                        !!}
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    @if(isset($customer->location['longitude']))
                    {!! Form::hidden('longitude', $customer->location['longitude']) !!}
                    @else
                    {!! Form::hidden('longitude', null) !!}
                    @endif
                    @if(isset($customer->location['lattitude']))
                    {!! Form::hidden('lattitude', $customer->location['lattitude']) !!}
                    @else
                    {!! Form::hidden('lattitude', null) !!}
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Code postal
                        </label>
                        <!-- Input -->
                        @if(isset($customer->location['postal_code']))
                        {!! Form::text('postal_code', $customer->location['postal_code'], ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
                        @else
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal']) !!}
                        @endif
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
                        @if(isset($customer->location['city']))
                        {!! Form::text('city', $customer->location['city'], ['class' => 'form-control',
                        'placeholder' => 'Ville']) !!}
                        @else
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville']) !!}
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <label>
                        Pays
                    </label>
                    @if(isset($customer->location['country']))
                    {!! Form::text('country', $customer->location['country'], ['class' => 'form-control', 'placeholder'=> 'Pays']) !!}
                    @else
                    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays']) !!}
                    @endif
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
                        @if(isset($customer->contact_person['lastname']))
                        {!! Form::text('lastname', $customer->contact_person['lastname'], ['class' =>
                        'form-control', 'placeholder' => 'Nom :']) !!}
                        @else
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                        @endif
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
                        @if(isset($customer->contact_person['lastname']))
                        {!! Form::text('firstname', $customer->contact_person['firstname'], ['class' =>
                        'form-control', 'placeholder' => 'Prénom ']) !!}
                        @else
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom'])
                        !!}
                        @endif
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
                        @if(isset($customer->contact_person['email']))
                        {!! Form::text('phone', $customer->contact_person['email'], ['class' => 'form-control',
                        'placeholder' => 'Email']) !!}
                        @else
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email'])
                        !!}
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Téléphone
                        </label>
                        <!-- Input -->
                        @if(isset($customer->contact_person['phone']))
                        {!! Form::text('phone', $customer->contact_person['phone'], ['class' => 'form-control',
                        'placeholder' => 'Téléphone']) !!}
                        @else
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone', 'data-mask' => '00 00 00 00 00'])
                        !!}
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Poste
                        </label>
                        <!-- Input -->
                        @if(isset($customer->contact_person['job_title']))
                        {!! Form::text('job_title', $customer->contact_person['job_title'], ['class' =>
                        'form-control', 'placeholder' => 'Poste']) !!}
                        @else
                        {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' => 'Poste'])
                        !!}
                        @endif
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
                        {!! Form::select('shows_id[]', App\Event::pluck('name','id'), $customer->events, ['class' =>
                        'form-control', 'multiple', 'data-toggle' => 'select']) !!} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Mettre à jour', ['class' => 'btn btn-primary', 'style' => 'float: right'])
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