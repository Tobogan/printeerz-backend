@extends('layouts/templateAdmin')

@section('content')
<!-- <div class="container mt-3">
<div class="row">
    <div class="col-sm" style="width: 18rem;">
    @if ($zone->logoName)
        <img class="card-img-top right" src="/uploads/{{$customer->logoName}}" alt="logo_event">
    @else
        <img src="/img/tee-shirt-blanc-gildan.jpg" class="card-img-top right" alt="img_default">
    @endif
    </div> -->
    <div class="container mt-3">
<div class="row">
    <div class="col-sm" style="width: 18rem;">
    @if ($zone->imageName)
        <img class="card-img-top right" src="/uploads/{{$zone->imageName}}" alt="image de l'événement">
    @else
        <img src="/img/tee-shirt-blanc-gildan.jpg" class="card-img-top right" alt="img_default">
    @endif
    </div>

    <div class="col-sm">
    <h2 class="mt-3">{{ $zone->nom }}</h2>
    <hr>

    

    <a role="button" class='btn btn-success btn-sm' href="{{route('edit_zone', $zone->id)}}"  title="Modification du produit">Modifier</a>
    <a role="button" class='btn btn-danger btn-sm' href="{{route('destroy_zone', $zone->id)}}"  title="Suppression du produit">Supprimer</a>
    <a class='btn btn-secondary btn-sm' href="{{route('index_zone')}}"> Retour </a>
    <hr>
</div>
    <div class="col-sm">
    </div>
</div>
@endsection