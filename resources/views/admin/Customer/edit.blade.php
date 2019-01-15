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
        {!! Form::label('name', 'Entrer la nom : ') !!}
        {!! Form::text('name', $customer->name, ['class' => 'form-control', 'placeholder' => 'Dénomination:']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('adress_complete', 'Entrer l\'adress : ') !!}
            {!! Form::text('adress', $customer->adress, ['class' => 'form-control', 'placeholder' => 'Adresse:']) !!}
            {!! Form::text('postal_code', $customer->postal_code, ['class' => 'form-control mt-2', 'placeholder' => 'Code postal:']) !!}
            {!! Form::text('city', $customer->city, ['class' => 'form-control mt-2', 'placeholder' => 'Ville:']) !!}
        </div>


        <div class="form-group">
        {!! Form::label('activity', 'Entrer l\'activité : ') !!}
        {!! Form::text('activity', $customer->activity, ['class' => 'form-control', 'placeholder' => 'Activité:']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('siren', 'Entrer le SIREN : ') !!}
        {!! Form::text('siren', $customer->siren, ['class' => 'form-control', 'placeholder' => 'SIREN:']) !!}
        </div>

        {!! Form::label('contact', 'Entrer le contact : ') !!}
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_lastname', $customer->contact_lastname, ['class' => 'form-control', 'placeholder' => 'Nom:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_firstname', $customer->contact_firstname, ['class' => 'form-control', 'placeholder' => 'Prénom:']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-2">
                {!! Form::text('contact_phone', $customer->contact_phone, ['class' => 'form-control', 'placeholder' => 'Téléphone:']) !!}
                </div>
                <div class="col-6 mb-2">
                {!! Form::text('contact_job', $customer->contact_job, ['class' => 'form-control', 'placeholder' => 'Poste:']) !!}
                </div>
                <div class="col-6 mb-2">
                    {!! Form::text('contact_email', $customer->contact_email, ['class' => 'form-control', 'placeholder' => 'Email:']) !!}
                    </div>
            </div>
        <div class="form-group">
        {!! Form::label('event_qty', 'Entrer le nombre d\'événements déjà organisés : ') !!}
        {!! Form::number('event_qty', $customer->event_qty, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('informations', 'Informations : ') !!}
        <textarea class="form-control" name="informations" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant le client."></textarea>
        </div>
        <hr>
        <input type="hidden" class="form-control" name="actual_title" value= '{{ $customer->title }}'>

        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_customer')}}"> Retour </a> 

        {!! Form::close() !!}
    </div>
</div>
@endsection