@extends('layouts/templateAdmin')

@section('content')
<div class="container">
@if (session('status'))
    <div class="alert alert-success mt-1">
        {{ session('status') }}
    </div>
@endif


  	<div><a href="{{action('EventController@create')}}"><button type="button" title="Ajout d'un nouvel événement" class="btn btn-primary right btn-sm mt-2 mb-2" style="float:right"><i class="uikon">add</i> Nouvel événement</button></a></div>
<br>
<br>
<table class="display table table-striped datatable" >
    <thead>
		<tr>
            <th>Avatar</th>
            <th>Noms</th>
            <th>Annonceur</th>
            <th>Client</th>
            <th>Lieu</th>
            <th>Type</th>
            <th>Date</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
@foreach ($events as $event)
    <tr>
    @if($event->logoName)
    <td><a href="{{route('show_event', $event->id)}}"><img src="/uploads/{{$event->logoName}}" class="miniRoundedImage" alt="img_event"></a></td>
    @else
    <td><img src="/uploads/no_image.jpg" class="miniRoundedImage" alt="img_event" ></td>
    @endif
    <td><a style="text-decoration:none;color:black;" href="{{route('show_event', $event->id)}}">{{ $event->nom }}</a></td>
    <td>{{ $event->annonceur }}</td>

    @if($event->customer)
    <td>{{ $event->customer->denomination }}</td>
    @else
    <td><i>Inconnu</i></td>
    @endif

    <td>{{ $event->lieu }}</td>
    <td>{{ $event->type }}</td>
    <td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
    <?php $description = $event->description;
    if(strlen($description) > 50){
        $description = substr($description, 0, 50);
        $description .= '...';
    }
    ?>
    @if(strlen($description) != 0)
    <td>{{ $description }}</td>
    @else
    <td>{{ '...' }}</td>
    @endif
    <td><a class='btn btn-success btn-sm' href="{{route('show_event', $event->id)}}" title="Détails de l'événement"> Détails </a></td></tr>
@endforeach
    </tbody>
    </div>

    
@endsection
