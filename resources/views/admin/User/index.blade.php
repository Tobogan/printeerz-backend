@extends('layouts/templateAdmin')

@section('content')
<div class="container">
@if (session('status'))
    <div class="alert alert-success mt-1">
        {{ session('status') }}
    </div>
@endif

  	<a href="{{action('UserController@create')}}"><button type="button" class="btn btn-primary btn-lg right btn-sm mt-2 mb-2" style="float:right"><i class="uikon">add</i> Nouvel utilisateur</button></a>
      <br>
<br>
<table class="display table table-striped datatable" >
    <thead>
		<tr>
            <th>#</th>
            <th></th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Actions</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
@foreach ($users as $user)

<tr><td>{{ $user->id }}</td>
@if($user->imageName)
<td><img src="/uploads/{{$user->imageName}}" class="miniRoundedImage" alt="img_profile" ></td>
@else
<td><img src="/uploads/no_image.jpg" class="miniRoundedImage" alt="img_profile" ></td>
@endif
<td>{{ $user->prenom }}</td>
<td>{{ $user->nom }}</td>
<td>{{ $user->email }}</td>
@if ($user->role == 'admin')
<td> Admin </td>
@elseif ($user->role == 'opérateur')
<td> Opérateur </td>
@else
<td> Technicien </td>
@endif
@if ($user->activate == 1)
<td>Activé</td>
@else
<td>Désactivé</td>
@endif
<td><a class='btn btn-success btn-sm' href="{{route('edit_user', $user->id)}}"><i class="uikon">edit</i> Modifier </a>
@if ($user->activate == 1)
<a class='btn btn-secondary btn-sm' onclick="return confirm('Êtes-vous sûr?')" href="{{route('desactivate_user', $user->id)}}"> Désactiver </a>
@else 
 <a class='btn btn-success btn-sm' href="{{route('activate_user', $user->id)}}"><i class="uikon">check</i>  Réactiver   </a></td>
@endif
<td><a class='btn btn-danger btn-sm' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_user', $user->id)}}"> Supprimer </a></td></tr>

@endforeach
    </tbody>
    </div>

@endsection
