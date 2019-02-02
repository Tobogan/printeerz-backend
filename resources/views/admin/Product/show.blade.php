@extends('layouts/templateAdmin')

@section('content')

<div id="tabs">
    @include('admin.Product.includes.header')
    @include('admin.Product.includes.informations')
</div>

@include('admin.Product.includes.modalDelete')

    @section('javascripts')
    <script type="text/Javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        });</script>
    {{--<script> var host = "{{URL::to('/')}}";</script>--}}
    @endsection
@endsection