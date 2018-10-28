@extends('layouts/templateAdmin')

@section('content')



<div class="container mt-3">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => 'CustomerController@store', 'files' => true]) !!}
        {{csrf_field()}}

        <div class="form-group">
        {!! Form::label('denomination', 'Entrer la dénomination : ') !!}
        {!! Form::text('denomination', null, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('adresse_complete', 'Entrer l\'adresse : ') !!}
            {!! Form::text('adresse', null, ['class' => 'form-control', 'placeholder' => 'Adresse:']) !!}
            {!! Form::text('code_postal', null, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal:']) !!}
            {!! Form::text('ville', null, ['class' => 'form-control mt-2', 'placeholder' => 'Ville:']) !!}
        </div>


        <div class="form-group">
        {!! Form::label('activite', 'Entrer l\'activité : ') !!}
        {!! Form::text('activite', null, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('siren', 'Entrer le SIREN : ') !!}
        {!! Form::text('siren', null, ['class' => 'form-control', 'placeholder' => 'SIREN:']) !!}
        </div>

        {!! Form::label('contact', 'Entrer le contact : ') !!}
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_nom', null, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_prenom', null, ['class' => 'form-control', 'placeholder' => 'Prénom:']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_telephone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_poste', null, ['class' => 'form-control', 'placeholder' => 'Poste:']) !!}
                </div>
            </div>
        <div class="form-group">
        {!! Form::label('nb_events', 'Entrer le nombre d\'événements déjà organisés : ') !!}
        {!! Form::number('nb_events', 0, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('informations', 'Informations : ') !!}
        <textarea class="form-control" name="informations" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
        </div>

        {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_customer')}}"> Retour </a>

        {!! Form::close() !!}

    </div>
</div>
@endsection
