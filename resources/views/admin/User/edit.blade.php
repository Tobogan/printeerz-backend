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

        {!! Form::label('username', 'Entrer le nom d\'utilisateur : ') !!}
        {!! Form::text('username', $user->username, ['class' => 'form-control'] )!!}
        
        {!! Form::label('firstname', 'Entrer le prénom : ') !!}
        {!! Form::text('firstname', $user->firstname, ['class' => 'form-control'] )!!}

        {!! Form::label('lastname', 'Entrer le nom : ') !!}
        {!! Form::text('lastname', $user->lastname, ['class' => 'form-control']) !!}

        {!! Form::label('email', 'Entrer le mail : ') !!}
        {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}

        {!! Form::label('password', 'Entrer le mot de passe : ') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}

        {!! Form::label('password_confirmation', 'Confirmer le mot de passe : ') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

       {!! Form::label('role', 'Sélectionner le rôle : ') !!}
       @if($user->role == "1")
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Opérateur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="3">
            <label class="form-check-label" for="exampleRadios2">
                Technicien
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="2">
            <label class="form-check-label" for="exampleRadios2">
                Admin
            </label>
        </div>
        @elseif($user->role == "2")
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="1" >
            <label class="form-check-label" for="exampleRadios1">
                Opérateur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="3">
            <label class="form-check-label" for="exampleRadios2">
                Technicien
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="2" checked>
            <label class="form-check-label" for="exampleRadios2">
                Admin
            </label>
        </div>

        @else
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="1" >
            <label class="form-check-label" for="exampleRadios1">
                Opérateur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="3" checked>
            <label class="form-check-label" for="exampleRadios2">
                Technicien
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="2" >
            <label class="form-check-label" for="exampleRadios2">
                Admin
            </label>
        </div>

        @endif

        <div class="form-group">
            <label for="profile_img">Ajouter une image de profil:</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="profile_img">
        </div>


        <input type="hidden" class="form-control" name="actual_email" value= '{{$user->email}}'>
        
        <!--~~~~~~~~~~~___________Hidden input for is_deleted & is_active value by default__________~~~~~~~~~~~~-->
        <input type="hidden" class="form-control" name="is_active" value='true'>
        <input type="hidden" class="form-control" name="is_deleted" value='false'>

        
        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('user_index')}}"> Retour </a>

    {!! Form::close() !!}
    </div>

@endsection