@extends('layouts/templateAdmin')
@section('title', $event->title)

@section('content')
@include('admin.Event.includes.show.modalDelete')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            @include('admin.Event.includes.show.status')
            <div id="tabs" class="mb-6">
                @include('admin.Event.includes.show.header')
                @include('admin.Event.includes.show.products')
                @include('admin.Event.includes.show.infos')
                @include('admin.Event.includes.show.feed')
                @include('admin.Event.includes.show.users')
                @include('admin.Event.includes.show.addEventsProducts')
                @include('admin.Event.includes.show.eventReady')
            </div>
        </div>
    </div>
</div>
@endsection