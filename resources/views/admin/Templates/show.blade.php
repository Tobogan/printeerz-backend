@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3 mb-3">
    <div class="row">
    <div class="col-lg-5 ml-3">
        <h6 class="mb-2"> <small>{{ $printzone->name }}</small></h6>

        <h6 class="mb-2"> <small>{{ $printzone->zone }}</small></h6>

        <h6 class="mb-2"> <small>{{ $printzone->width }}</small></h6>

        <h6 class="mb-2"><small>{{ $printzone->height }}</small></h6>

        <h6 class="mb-2"><small>{{ $printzone->origin_x }}</small></h6>

        <h6 class="mb-2"><small>{{ $printzone->origin_y }}</small></h6>

        <h6 class="mb-2"><small>{{ $printzone->tray_width }}</small></h6>

        <h6 class="mb-2"><small>{{ $printzone->tray_height }}</small></h6>

        <h5 class="mt-2">Description: </h5>

        @if(strlen($printzone->description) != 0)
            <div><small>{{ $printzone->description }}</small></div>
        @else
            <td>{{ '...' }}</td>
        @endif
        <br>
        <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_printzones', $printzone->id)}}" title="Modification du produit">Modifier</a>
        <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_printzones', $printzone->id)}}" title="Suppression du produit">Supprimer</a>
    
       <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_printzones')}}"> Retour </a>
        <hr>
    </div>
</div>

@endsection