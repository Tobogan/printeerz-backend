@extends('layouts/templateAdmin')

@section('content')


<div class="container">

<h1 class="mt-3" >Modification d'une taille</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => array('TailleController@update', 'id' => $taille->id), 'files' => true]) !!}

        {{csrf_field()}}
        <div class="form-group">
        {!! Form::label('nom', 'Entrer la taille : ') !!}
        {!! Form::text('nom', $taille->nom, ['class' => 'form-control', 'placeholder' => 'Taille:']) !!}
        </div>
        <input type="hidden" class="form-control" name="actual_nom" value= '{{ $taille->nom }}'>

        <br>
        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_couleur')}}"> Retour </a>

        {!! Form::close() !!}

    </div>
</div>
@endsection