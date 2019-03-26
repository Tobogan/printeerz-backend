@extends('layouts/templateAdmin')

@section('content')
@include('admin.Event.includes.modalDelete')


<div id="tabs" class="mb-6">
    @include('admin.Event.includes.header')
    @include('admin.Event.includes.products')
    @include('admin.Event.includes.infos')
    @include('admin.Event.includes.feed')
    @include('admin.Event.includes.users')
    @include('admin.Event.includes.addEventsProducts')
</div>

@endsection