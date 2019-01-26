@extends('layouts/templateAdmin')

@section('content')

<div class="container">
<<<<<<< HEAD

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => array('CustomerController@update', 'id' => $customer->id), 'files' => true]) !!}

        {{csrf_field()}}
        <div class="form-group">
            {!! Form::label('title', 'Entrer la nom : ') !!}
            {!! Form::text('title', $customer->title, ['class' => 'form-control', 'placeholder' => 'Nom du client :']) !!}
            @if(isset($customer->location['address']))
                {!! Form::text('address', $customer->location['address'], ['class' => 'form-control', 'placeholder' => 'Adresse :']) !!}
            @else
                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse :']) !!}
            @endif
            @if(isset($customer->location['postal_code']))
                {!! Form::text('postal_code', $customer->location['postal_code'], ['class' => 'form-control', 'placeholder' => 'Code postal :']) !!}
            @else
                {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal :']) !!}
            @endif
            @if(isset($customer->location['city']))
                {!! Form::text('city', $customer->location['city'], ['class' => 'form-control', 'placeholder' => 'Ville :']) !!}
            @else
                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville :']) !!}
            @endif
            @if(isset($customer->location['country']))
                {!! Form::text('country', $customer->location['country'], ['class' => 'form-control', 'placeholder' => 'Pays :']) !!}
            @else
                {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Pays :']) !!}
            @endif
            @if(isset($customer->location['longitude']))
                {!! Form::text('longitude', $customer->location['longitude'], ['class' => 'form-control', 'placeholder' => 'Longitude :']) !!}
            @else
                {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => 'Longitude :']) !!}
            @endif
            @if(isset($customer->location['lattitude']))
                {!! Form::text('lattitude', $customer->location['lattitude'], ['class' => 'form-control', 'placeholder' => 'Lattitude :']) !!}
            @else
                {!! Form::text('lattitude', null, ['class' => 'form-control', 'placeholder' => 'Lattitude :']) !!}
            @endif
            {!! Form::label('activity_type', 'Entrer le type d\'activité : ') !!}
            {!! Form::text('activity_type', $customer->activity_type, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
            {!! Form::label('shows_id[]', 'Sélectionner les évenements de ce client : ') !!}
            {!! Form::select('shows_id[]', App\Event::pluck('name','id'), $customer->events, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            {!! Form::label('SIREN', 'Entrer le SIREN/SIRET : ') !!}
            {!! Form::text('SIREN', $customer->SIREN, ['class' => 'form-control', 'placeholder' => 'SIREN/SIRET:']) !!}
        </div>
        {!! Form::label('contact_person', 'Entrer le contact : ') !!}
        <div class="row">
            <div class="col-6 mb-2">
                @if(isset($customer->contact_person['lastname']))
                    {!! Form::text('lastname', $customer->contact_person['lastname'], ['class' => 'form-control', 'placeholder' => 'Nom :']) !!}
                @else
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom :']) !!}
                @endif
            </div>
            <div class="col-6 mb-2">
                @if(isset($customer->contact_person['firstname']))
                    {!! Form::text('firstname', $customer->contact_person['firstname'], ['class' => 'form-control', 'placeholder' => 'Prénom :']) !!}
                @else
                    {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Prénom :']) !!}
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-2">
                @if(isset($customer->contact_person['phone']))
                    {!! Form::text('phone', $customer->contact_person['phone'], ['class' => 'form-control', 'placeholder' => 'Téléphone :']) !!}
                @else
                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone :']) !!}
                @endif
            </div>
            <div class="col-6 mb-2">
                @if(isset($customer->contact_person['job_title']))
                    {!! Form::text('job_title', $customer->contact_person['job_title'], ['class' => 'form-control', 'placeholder' => 'Poste :']) !!}
                @else
                    {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder' => 'Poste :']) !!}
                @endif
            </div>
            <div class="col-6 mb-2">
                @if(isset($customer->contact_person['email']))
                    {!! Form::text('email', $customer->contact_person['email'], ['class' => 'form-control', 'placeholder' => 'Email :']) !!}
                @else
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email :']) !!}
                @endif
            </div>
        </div>

        <!--~~~~~~~~~~~___________PHOTO PRINCIPALE__________~~~~~~~~~~~~-->
        <div class="form-group mt-2">
            {!! Form::label('image', 'Ajouter une image/logo: ') !!}
            {!! Form::file('image', array('class' => 'form-control', 'id' => 'image')) !!}
            {!! Form::label('comments', 'Informations : ') !!}
        <textarea class="form-control" name="comments" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client.">{{$customer->comments}}</textarea>
        </div>

        <hr>
        <input type="hidden" class="form-control" name="actual_title" value= '{{ $customer->title }}'>

        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_customer')}}"> Retour </a> 

=======
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

        {!! Form::open(['action' => array('CustomerController@update', 'id' => $customer->id), 'files' => true, 'class' => 'mb-4']) !!}
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
                    {!! Form::text('denomination', $customer->denomination, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}

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
                    {!! Form::text('adresse', $customer->adresse, ['class' => 'form-control', 'placeholder' => 'Adresse:']) !!}
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
                    {!! Form::text('code_postal', $customer->code_postal, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal:']) !!}
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
                    {!! Form::text('ville', $customer->ville, ['class' => 'form-control mt-2', 'placeholder' => 'Ville:']) !!}
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
                    {!! Form::text('activite', $customer->activite, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
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
                    {!! Form::text('siren', $customer->siren, ['class' => 'form-control', 'placeholder' => 'SIREN:']) !!}
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
                    {!! Form::text('contact_nom', $customer->contact_nom, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
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
                    {!! Form::text('contact_prenom', $customer->contact_prenom, ['class' => 'form-control', 'placeholder' => 'Prénom:']) !!}
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
                    {!! Form::text('contact_telephone', $customer->contact_telephone, ['class' => 'form-control', 'placeholder' => 'Téléphone:']) !!}
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
                    {!! Form::text('contact_poste', $customer->contact_poste, ['class' => 'form-control', 'placeholder' => 'Poste:']) !!}
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
                    Nombre d'événements déjà organisés
                    </label>
                    <!-- Input -->
                    {!! Form::number('nb_events', $customer->nb_events, ['class' => 'form-control']) !!}
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
                    <textarea class="form-control" name="informations" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
                    <input type="hidden" class="form-control" name="actual_nom" value= '{{ $customer->denomination }}'>
                </div>        
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="buttons">
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary', 'style' => 'float: right']) !!}       
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_customer')}}">Annuler</a> 
                </div>
            </div>
        </div>
>>>>>>> features/update_customer_layout
        {!! Form::close() !!}
    </div>
</div>    
@endsection