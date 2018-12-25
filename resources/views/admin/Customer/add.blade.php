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
        </div>
        @endif

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
                    {!! Form::text('denomination', null, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}

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
                    {!! Form::text('adresse', null, ['class' => 'form-control', 'placeholder' => 'Adresse:']) !!}
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
                    {!! Form::text('code_postal', null, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal:']) !!}
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
                    {!! Form::text('ville', null, ['class' => 'form-control mt-2', 'placeholder' => 'Ville:']) !!}
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
                    {!! Form::text('activite', null, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
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
                    {!! Form::text('siren', null, ['class' => 'form-control', 'placeholder' => 'SIREN:']) !!}
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
                    {!! Form::text('contact_nom', null, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
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
                    {!! Form::text('contact_prenom', null, ['class' => 'form-control', 'placeholder' => 'Prénom:']) !!}
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
                    {!! Form::text('contact_telephone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone:']) !!}
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
                    {!! Form::text('contact_poste', null, ['class' => 'form-control', 'placeholder' => 'Poste:']) !!}
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
                    {!! Form::number('nb_events', null, ['class' => 'form-control']) !!}
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