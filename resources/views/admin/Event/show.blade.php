@extends('layouts/templateAdmin')

@section('content')

<div id="tabs" class="mb-6">
    @include('admin.Event.includes.header')
    @include('admin.Event.includes.products')
    @include('admin.Event.includes.infos')
    @include('admin.Event.includes.feed')
    @include('admin.Event.includes.users')
</div>

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="element" data-autohide="false">
    <div class="toast-header">
        <strong class="mr-auto">Début de l'évenement</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Votre événement va débuter dans <b>2 jours !</b>
    </div>
</div>

@endsection