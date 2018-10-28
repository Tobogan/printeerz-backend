@extends('layouts/templateAdmin')

@section('content')
<h2>User management</h2>
<br/>
  	<a href="{{action('UserController@create')}}"><button type="button" class="btn btn-primary btn-lg">Add User</button></a>
<br/>
<table id="datatable" class="display table table-striped">
    <thead>
		<tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
<tr><td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
@if ($user->isAdmin == 1)
<td> Admin </td>
@else
<td> User </td>
@endif
<td><a class='btn btn-primary' href="{{route('edit_user', $user->id)}}"> Edit </a></td>
<td><a class='btn btn-danger' href="{{route('destroy_user', $user->id)}}"> Delete </a></td></tr>
    </tbody>

@endsection