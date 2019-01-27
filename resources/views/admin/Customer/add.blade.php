@extends('layouts/templateAdmin')

@section('content')


<div class="container mt-3">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
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
                                Ajouter un client
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
            <p>Certains champs sont obligatoires</p>
            @foreach ($errors->all() as $error)
                {{ $error }},
            @endforeach
        </ul>
    </div>
    @endif
    @endif

   {{-- {!! Form::open(['action' => 'CustomerController@store', 'files' => true]) !!}
        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('title', 'Entrer la nom : ') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}
            {!! Form::label('location', 'Entrer l\'adresse : ') !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse :']) !!}
            {!! Form::text('postal_code', null, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal :']) !!}
            {!! Form::text('city', null, ['class' => 'form-control mt-2', 'placeholder' => 'Ville :']) !!}
            {!! Form::text('country', null, ['class' => 'form-control mt-2', 'placeholder' => 'Pays :']) !!}
            {!! Form::text('longitude', null, ['class' => 'form-control mt-2', 'placeholder' => 'Longitude :']) !!}
            {!! Form::text('lattitude', null, ['class' => 'form-control mt-2', 'placeholder' => 'Lattitude :']) !!}
            {!! Form::label('activity_type', 'Entrer le type d\'activité : ') !!}
            {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
            {!! Form::label('shows_id[]', 'Sélectionner les évenements de ce client : ') !!}
            {!! Form::select('shows_id[]', App\Event::pluck('name','_id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            {!! Form::label('SIREN', 'Entrer le SIREN/SIRET : ') !!}
            {!! Form::text('SIREN', null, ['class' => 'form-control', 'placeholder' => 'SIREN/SIRET:']) !!}
        </div>

        {!! Form::label('contact_person', 'Entrer le contact : ') !!}
        <div class="row">
            <div class="col-6 mb-2">
                {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom :']) !!}
            </div>
            <div class="col-6 mb-2">
                {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom :']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-2">
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone :']) !!}
            </div>
            <div class="col-6 mb-2">
                {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' => 'Poste :']) !!}
            </div>
            <div class="col-6 mb-2">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email :']) !!}
            </div>
        </div>

        <!--~~~~~~~~~~~___________PHOTO PRINCIPALE__________~~~~~~~~~~~~-->
        <div class="form-group mt-2">
            {!! Form::label('image', 'Ajouter une image/logo: ') !!}
            {!! Form::file('image', array('class' => 'form-control', 'id' => 'image')) !!}
            {!! Form::label('comments', 'Informations : ') !!}
            <textarea class="form-control" name="comments" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
        </div>
        @endif--}}

        {!! Form::open(['action' => array('CustomerController@store'), 'files' => true, 'class' => 'mb-4']) !!}
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
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}

                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="col-12">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    Adresse
                    </label>
                    <!-- Input -->
                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse :']) !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    Code postal
                    </label>
                    <!-- Input -->
                    {!! Form::text('postal_code', null, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal :']) !!}
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
                    {!! Form::text('city', null, ['class' => 'form-control mt-2', 'placeholder' => 'Ville :']) !!}
                </div>
            </div>
        </div>
        <hr class="mt-4 mb-5">
        <div class="row">    
            <div class="col-12 col-md-6">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    Activité
                    </label>
                    <!-- Input -->
                    {!! Form::text('activity_type', null, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    SIREN/SIRET
                    </label>
                    <!-- Input -->
                    {!! Form::text('SIREN', null, ['class' => 'form-control', 'placeholder' => 'SIREN/SIRET:']) !!}
                </div>
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
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom :']) !!}
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
                    {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom :']) !!}
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
                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone :']) !!}
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
                    {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' => 'Poste :']) !!}
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- First name -->
            <div class="form-group">
                <!-- Label -->
                <label>
                Logo du client
                </label>
                <!-- Input -->
                {!! Form::file('image', array('class' => 'form-control', 'id' => 'image')) !!}

            </div>
        </div>
        <hr class="mt-4 mb-5">
        <div class="row">
            <div class="col-12">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    Les événements déjà organisés pour ce client
                    </label>
                    <!-- Input -->
                    {!! Form::select('shows_id[]', App\Event::pluck('name','_id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- First name -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                    Commentaires
                    </label>
                    <!-- Input -->
                    <textarea class="form-control" name="comments" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
                </div>        
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="buttons">
                        {!! Form::submit('Ajouter le client', ['class' => 'btn btn-primary', 'style' => 'float: right']) !!}       
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_customer')}}">Annuler</a> 
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>    
@endsection