@extends('layouts/templateAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col mb-3 ml--3 ml-md--2">
                            <a class="btn btn-link btn-sm mb-3 px-0" href="{{route('show_eventsProducts', $events_custom->events_product_id)}}"><span
                                    class="fe fe-chevron-left"></span>Retour</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                MODIFICATION DU GABARIT
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                {{$events_custom->title}}
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-auto mt-2 mt-md-0">
                            <ul class="nav nav-tabs nav-overflow header-tabs" id="myTab" role="tablist">
                                @include('admin.EventsCustoms.includes.show.nav-tabs')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4']) !!}
{{csrf_field()}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="tab-content" id="myTabContent">
                @include('admin.EventsCustoms.includes.show.tab-content')
            </div>
            {{-- Store Event custom id --}}
            <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
            
            {{-- Store Event product id --}}
            <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">

            {{-- Store Event product title --}}
            <input type="hidden" class="form-control" name="actual_title" value="{{$events_product->title}}">

            {{-- Custom actions --}}
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' style="float: left"
                        href="{{route('show_eventsProducts', $events_product->id)}}">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@include('admin.EventsCustoms.includes.modal_addColor')
@include('admin.EventsCustoms.includes.modal_addFont')

@section('javascripts')
@parent()
<script type="text/Javascript">


</script>
@endsection