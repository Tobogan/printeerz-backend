@extends('layouts/templateAdmin')

@section('content')

<<<<<<< HEAD
<div class="container">
=======
>>>>>>> develop
@if (session('status'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('status') }}
</div>
@endif

<<<<<<< HEAD
  	<a href="{{action('UserController@create')}}"><button type="button" class="btn btn-primary btn-lg right btn-sm mt-2 mb-2" style="float:right"><i class="uikon">add</i> Nouvel utilisateur</button></a>
      <br>
<br>
<table class="display table table-striped datatable" >
    <thead>
		<tr>
            <th></th>
            <th>Username</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Rôle</th>
            <th>Actions</th>
            <th></th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>

@foreach ($users as $user)

<tr>
@if($user->profile_img)
<td><img src="/uploads/{{$user->profile_img}}" class="miniRoundedImage" alt="img_profile" ></td>
@else
<td><img src="/uploads/no_image.jpg" class="miniRoundedImage" alt="img_profile" ></td>
@endif

<td>{{ $user->username }}</td>
<td>{{ $user->firstname }}</td>
<td>{{ $user->lastname }}</td>
<td>{{ $user->email }}</td>

@if ($user->role == 2)
<td> Admin </td>
@elseif ($user->role == 1)
<td> Opérateur </td>
@else
<td> Technicien </td>
@endif
@if ($user->is_active == true)
<td>Activé</td>
@else
<td>Désactivé</td>
@endif

<td><a class='btn btn-success btn-sm' href="{{route('edit_user', $user->id)}}"><i class="uikon">edit</i> Modifier </a>

    @if ($user->is_active == true)
<a class='btn btn-secondary btn-sm' onclick="return confirm('Êtes-vous sûr?')" href="{{route('desactivate_user', $user->id)}}"> Désactiver </a>
@else 
 <a class='btn btn-success btn-sm' href="{{route('activate_user', $user->id)}}"><i class="uikon">check</i>  Réactiver   </a></td>
@endif

<td><a class='btn btn-secondary btn-sm' href="{{route('show_user', $user->id)}}"> Profil </a></td>


<td><a class='btn btn-danger btn-sm' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_user', $user->id)}}"> Supprimer </a></td></tr>
=======
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                Overview
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                Utilisateurs
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{action('UserController@create')}}" class="btn btn-primary">
                                Créer un utilisateur
                            </a>

                        </div>
                </div>
            </div>

            <!-- Card -->
            <div id="userTable" class="card mt-3" data-toggle="lists" data-lists-values='["user-id", "user-lastname", "user-firstname", "user-email", "user-role","user-status", "user-date"]'>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Search -->
                            <form class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <span class="fe fe-search text-muted"></span>
                                </div>
                                <div class="col">
                                    <input type="search" class="form-control form-control-flush search" placeholder="Recherche">
                                </div>
                            </form>

                        </div>
                    </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="user-id">
                                    Id
                                    </a>
                                </th>
                                <th>
                                    <a href="#">
                                        
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="user-lastname">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="user-firstname">
                                        Prénom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="user-email">
                                        Email
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="user-role">
                                        Rôle
                                    </a>
                                </th>
                                <th colspan="2">
                                    <a href="#" class="text-muted sort" data-sort="user-status">
                                        Statut
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="user-id">{{ $user->id }}</td>
                                    <td class="user-avatar">
                                    @if($user->imageName)
                                    <div class="avatar avatar-sm">
                                        <img src="/uploads/{{$user->imageName}}" class="avatar-img rounded-circle" alt="img_profile" >
                                    </div>
                                    @else
                                    <div class="avatar-sm">
                                        <?php 
                                        $avatarLastName = $user->nom; 
                                        $avatarFirstName = $user->prenom; 
                                        $avatarInitials = $avatarLastName[0] . $avatarFirstName[0] ;
                                        ?>
                                        <span class="avatar-title rounded-circle">{{ $avatarInitials }}</span>
                                    </div>
                                    @endif
                                    </td>
                                    <td class="user-lastname">{{ $user->nom }}</td>
                                    <td class="user-firstname">{{ $user->prenom }}</td>
                                    <td class="user-email">{{ $user->email }}</td>
                                    @if ($user->role == 'admin')
                                    <td class="user-role"> Admin </td>
                                    @elseif ($user->role == 'opérateur')
                                    <td class="user-role"> Opérateur </td>
                                    @else
                                    <td class="user-role"> Technicien </td>
                                    @endif
                                    @if ($user->activate == 1)
                                    <td class="user-status"><span class="badge badge-soft-success">Activé</span></td>
                                    @else
                                    <td class="user-status"><span class="badge badge-soft-secondary">Désactivé</span></td>
                                    @endif

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            data-boundary="window">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('edit_user', $user->id)}}" class="dropdown-item">
                                                Modifier l'utilisateur
                                            </a>
                                            @if ($user->activate == 1)
                                            <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')" href="{{route('desactivate_user', $user->id)}}"> Désactiver </a>
                                            @else
                                            <a class="dropdown-item" href="{{route('activate_user', $user->id)}}">Réactiver</a>
                                            @endif
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_user', $user->id)}}"> Supprimer </a>
                                        </div>
                                    </div>
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination">
                    </ul>
                </div>
            </div>
>>>>>>> develop

        </div>
    </div> <!-- / .row -->
</div>

@endsection