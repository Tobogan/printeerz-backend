@extends('layouts/templateAdmin')

@section('content')


<div class="container">

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
        {!! Form::label('denomination', 'Entrer la dénomination : ') !!}
        {!! Form::text('denomination', $customer->denomination, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('adresse_complete', 'Entrer l\'adresse : ') !!}
            {!! Form::text('adresse', $customer->adresse, ['class' => 'form-control', 'placeholder' => 'Adresse:']) !!}
            {!! Form::text('code_postal', $customer->code_postal, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal:']) !!}
            {!! Form::text('ville', $customer->ville, ['class' => 'form-control mt-2', 'placeholder' => 'Ville:']) !!}
        </div>


        <div class="form-group">
        {!! Form::label('activite', 'Entrer l\'activité : ') !!}
        {!! Form::text('activite', $customer->activite, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('siren', 'Entrer le SIREN : ') !!}
        {!! Form::text('siren', $customer->siren, ['class' => 'form-control', 'placeholder' => 'SIREN:']) !!}
        </div>

        {!! Form::label('contact', 'Entrer le contact : ') !!}
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_nom', $customer->contact_nom, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_prenom', $customer->contact_prenom, ['class' => 'form-control', 'placeholder' => 'Prénom:']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_telephone', $customer->contact_telephone, ['class' => 'form-control', 'placeholder' => 'Téléphone:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_poste', $customer->contact_poste, ['class' => 'form-control', 'placeholder' => 'Poste:']) !!}
                </div>
            </div>
        <div class="form-group">
        {!! Form::label('nb_events', 'Entrer le nombre d\'événements déjà organisés : ') !!}
        {!! Form::number('nb_events', $customer->nb_events, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('informations', 'Informations : ') !!}
        <textarea class="form-control" name="informations" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
        </div>
        <hr>
        <input type="hidden" class="form-control" name="actual_nom" value= '{{ $customer->denomination }}'>

        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_customer')}}"> Retour </a> 

        {!! Form::close() !!}
    </div>
</div>
@endsection