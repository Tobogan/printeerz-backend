@extends('layouts/templateAdmin')

@section('content')

<div class="container">

<h1 class="mt-3" >Ajout d'une zone</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => 'ZoneController@store', 'files' => true]) !!}
        {{csrf_field()}}

        <div class="form-group">
        {!! Form::label('lastname', 'Entrer la zone : ') !!}
        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Nom de la zone:']) !!}
        </div>

        {!! Form::label('image', 'Ajoutez une photo de la zone: ') !!}
        {!! Form::file('image', array('class' => 'form-control')) !!}
       
        <br>
        {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_zone')}}"> Retour </a>

        {!! Form::close() !!}
        <br>
    </div>
</div>
@endsection
