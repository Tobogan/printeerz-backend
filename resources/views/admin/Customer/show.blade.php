@extends('layouts/templateAdmin')

@section('content')
<div id="tabs">
    @include('admin.Customer.includes.header')
    @include('admin.Customer.includes.overview')
    @include('admin.Customer.includes.informations')
    @include('admin.Customer.includes.comments')
</div>

@include('admin.Customer.includes.modalDelete')
@endsection