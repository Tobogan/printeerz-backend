@extends('layouts/templateAdmin')

@section('content')
@include('admin.Product.includes.modalDelete')

<div id="tabs">
    @include('admin.Product.includes.header')
    @include('admin.Product.includes.informations')
</div>

@endsection