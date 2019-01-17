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
    <h2 class="mt-3">{{ '#'. $customer->id .' '.$customer->title }}</h2>
    <hr>

    <h5 class="mt-3">Adresse: </h5>
    <div>{{ $customer->location["address"] .' '. $customer->location["postal_code"] .' '. $customer->location["city"] }}</div>

    <h5 class="mt-3">SIREN: </h5>
    <div>{{ $customer->SIREN }}</div>

    <h5 class="mt-3">Activité: </h5>
    <div>{{ $customer->activity_type }}</div>

    <h5 class="mt-3">Contact: </h5>
    <div>{{ $customer->contact_person["firstname"] }}</div>
    <div>{{ $customer->contact_person["lastname"] }}</div>
    <div>{{ $customer->contact_person["job_title"] }}</div>
    <div>{{ $customer->contact_person["email"] }}</div>
    <div>{{ $customer->contact_person["phone"] }}</div>

    <h5 class="mt-3">Liste des événements: </h5>
    
    <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h4 class="card-header-title">
                    Add a member
                  </h4>
                  
                </div>
              </div> <!-- / .row -->
            </div>
            <div class="card-header">
                
            </div>
            <div data-toggle="lists" data-lists-values='["name"]'>
                <input class="form-control search" type="search">
                <ul class="list-group list">
                @if(!empty($customer->event))
                    @foreach($customer->event as $event)
                    <li class="list-group-item">
                        <a href="{{route('show_event', $event->id)}}" class="name">{{ '- '. $event->nom }}</a>
                    </li>
                    @endforeach
                @else
                <li class="list-group-item">
                    <span class="name">Aucun événement</span>
                </li>
                @endif
                </ul>
            </div>


    <h5 class="mt-3">Informations: </h5>

    @if(strlen($customer->comments) != 0)
    <div>{{ $customer->comments }}</div>
    <br>
    @else
    <td>{{ '...' }}</td>
    @endif
    <br>

    <a role="button" class='btn btn-success btn-sm' href="{{route('edit_customer', $customer->id)}}"  title="Modification du produit"><i class="uikon">edit</i> Modifier</a>
    <a role="button" class='btn btn-danger btn-sm' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_customer', $customer->id)}}"  title="Suppression du produit"> Supprimer</a>
    <a class='btn btn-secondary btn-sm' href="{{route('index_customer')}}"> Retour </a>
    <hr>
</div>
</div>
@endsection