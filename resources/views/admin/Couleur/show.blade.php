@extends('layouts/templateAdmin')

@section('content')
<!-- <div class="container mt-3">
<div class="row">
    <div class="col-sm" style="width: 18rem;">
    @if ($customer->logoName)
        <img class="card-img-top right" src="/uploads/{{$customer->logoName}}" alt="logo_event">
    @else
        <img src="/img/tee-shirt-blanc-gildan.jpg" class="card-img-top right" alt="img_default">
    @endif
    </div> -->
    <div class="container">
    <div class="col-sm">
    <h2 class="mt-3">{{ '#'. $customer->id .' '.$customer->denomination }}</h2>
    <hr>

    <h5 class="mt-3">Adresse: </h5>
    <div>{{ $customer->adresse .' '. $customer->code_postal .' '. $customer->ville }}</div>

    <h5 class="mt-3">SIREN: </h5>
    <div>{{ $customer->siren }}</div>

    <h5 class="mt-3">Contact: </h5>
    <div>{{ $customer->contact_poste .'- '. $customer->contact_prenom .' '. $customer->contact_nom .' '. $customer->contact_telephone }}</div>

    <h5 class="mt-3">Liste des événements: </h5>
    @foreach($customer->event as $event)
    <div>{{ '- '. $event->nom }}</div>
    @endforeach
    
    
    <h5 class="mt-3">Informations: </h5>

    @if(strlen($customer->informations) != 0)
    <div>{{ $customer->informations }}</div>
    <br>
    @else
    <td>{{ '...' }}</td>
    @endif
    <br>

    <a role="button" class='btn btn-success btn-sm' href="{{route('edit_customer', $customer->id)}}"  title="Modification du produit">Modifier</a>
    <a role="button" class='btn btn-danger btn-sm' href="{{route('destroy_customer', $customer->id)}}"  title="Suppression du produit">Supprimer</a>
    <a class='btn btn-secondary btn-sm' href="{{route('index_customer')}}"> Retour </a>
    <hr>
</div>
</div>
@endsection