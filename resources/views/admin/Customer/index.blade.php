@extends('layouts/templateAdmin')

@section('content')
<div class="container">
@if (session('status'))
    <div class="alert alert-success mt-1">
        {{ session('status') }}
    </div>
@endif

  	<a href="{{action('CustomerController@create')}}"><button type="button" title="Ajout d'un nouveau client" class="btn btn-primary right btn-sm mt-2 mb-2" style="float:right"><i class="uikon">add</i> Nouveau client</button></a>

<br>
<br>
<table class="display table table-striped datatable">
    <thead>
		<tr>
            <th>Nom</th>
            <th>Contact</th>
            <th>Adresse</th>
            <th>Code Postal</th>
            <th>Ville</th>
            <th>Nombre événement</th>
            <th>Information</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
@foreach ($customers as $customer)

    <tr>
        <td>{{ $customer->denomination }}</td>
        <td>{{ $customer->contact_prenom . ' ' . $customer->contact_nom }}</td>
        <td>{{ $customer->adresse }}</td>
        <td>{{ $customer->code_postal }}</td>
        <td>{{ $customer->ville }}</td>
        <td>{{ $customer->nb_events }}</td>

            <?php 
            $informations = $customer->informations;
            if(strlen($informations) > 50){
                $informations = substr($informations, 0, 50);
                $informations .= '...';
            }
            ?>
            @if(strlen($informations) != 0)
            <td>{{ $informations }}</td>
            @else
            <td>{{ '...' }}</td>
            @endif
            
        <td><a class='btn btn-success btn-sm' href="{{route('show_customer', $customer->id)}}"  title="Détails du produit"><i class="uikon">search_left</i> Détails </a></td>
    </tr>
@endforeach
    </tbody>
    </div>

@endsection
