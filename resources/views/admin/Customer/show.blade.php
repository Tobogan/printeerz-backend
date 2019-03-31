@extends('layouts/templateAdmin')
@section('title', $customer->title)
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div id="tabs">
                @include('admin.Customer.includes.header')
                @include('admin.Customer.includes.overview')
                @include('admin.Customer.includes.informations')
                @include('admin.Customer.includes.comments')
            </div>
        </div>
    </div>
</div>

@include('admin.Customer.includes.modalDelete')
@endsection