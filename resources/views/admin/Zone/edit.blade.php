@extends('layouts/templateAdmin')

@section('content')


<div class="container">

<h1 class="mt-3" >Modification d'une zone</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => array('ZoneController@update', 'id' => $zone->id), 'files' => true]) !!}

        {{csrf_field()}}
        <div class="form-group">
        <div class="form-group">
        {!! Form::label('nom', 'Entrer la zone : ') !!}
        {!! Form::text('nom', $zone->nom, ['class' => 'form-control', 'placeholder' => 'Nom de la zone:']) !!}
        </div>

        {!! Form::label('image', 'Ajouter une photo de la zone: ') !!}
        {!! Form::file('image', array('class' => 'form-control')) !!}
       
        </div>
        <input type="hidden" class="form-control" name="actual_nom" value= '{{ $zone->nom }}'>

        <br>
        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_zone')}}"> Retour </a>

        {!! Form::close() !!}
    </div>
</div>
@endsection