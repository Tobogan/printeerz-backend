@extends('layouts/templateAdmin')

@section('content')
<div class="container">
@if (session('status'))
    <div class="alert alert-success mt-1">
        {{ session('status') }}
    </div>
@endif


  	<a href="{{action('TailleController@create')}}"><button type="button" title="Ajout d'une nouvelle taille" class="btn btn-primary right btn-sm mt-2">Nouvelle taille</button></a>

<table class="display table table-striped datatable" >
    <thead>
		<tr>
            <th>Nom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
@foreach ($tailles as $taille)

    <tr>
        <td>{{ $taille->nom }}</td>
        <td><a class='btn btn-success btn-sm' href="{{route('edit_taille', $taille->id)}}"> Modifier </a>
        <a class='btn btn-danger btn-sm' href="{{route('destroy_taille', $taille->id)}}"> Supprimer </a></td></tr>

    </tr>
@endforeach
    </tbody>
</table>
</div>

@endsection
