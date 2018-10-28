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
    {!! Form::open(['action' => array('UserController@update', 'id' => $user->id), 'files' => true]) !!}

        {{csrf_field()}}
        <div class="form-group">

        {!! Form::label('prenom', 'Entrer le prénom : ') !!}
        {!! Form::text('prenom', $user->prenom, ['class' => 'form-control'] )!!}

        {!! Form::label('nom', 'Entrer le nom : ') !!}
        {!! Form::text('nom', $user->nom, ['class' => 'form-control']) !!}

        {!! Form::label('email', 'Entrer le mail : ') !!}
        {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}

        {!! Form::label('password', 'Entrer le mot de passe : ') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}

        {!! Form::label('password_confirmation', 'Confirmer le mot de passe : ') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

       {!! Form::label('role', 'Sélectionner le rôle : ') !!}
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="opérateur" checked>
            <label class="form-check-label" for="exampleRadios1">
                Opérateur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="technicien">
            <label class="form-check-label" for="exampleRadios2">
                Technicien
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="admin">
            <label class="form-check-label" for="exampleRadios2">
                Admin
            </label>
        </div>

        <div class="form-group">
            <label for="image">Ajouter une image de profil:</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
        </div>


        <input type="hidden" class="form-control" name="actual_email" value= '{{$user->email}}'>

        
        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('user_index')}}"> Retour </a>

    {!! Form::close() !!}
    </div>

@endsection