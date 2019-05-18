@extends('layouts/templateAdmin')
@section('alerts')
@if (session('status'))
    <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert"
        data-dismiss="alert">
        {{ session('status') }}
    </div>
@endif
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Header -->
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col mb-3 ml--3 ml-md--2">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                CONFIGURATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Configurer une personnalisation
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-auto mt-2 mt-md-0">
                            <ul class="nav nav-tabs nav-overflow header-tabs" id="myTab" role="tablist">
                                @include('admin.EventsCustoms.includes.edit.nav-tabs')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}

            {!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' => 'mb-4']) !!}
            {{csrf_field()}}
            {{-- Custom title --}}
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
    @include('admin.EventsCustoms.includes.edit.tab-content')
                    </div>
                    {{-- Store Event custom event_id --}}
                    <input type="hidden" class="form-control" id="events_custom_event_id" name="events_custom_event_id"
                        value="{{$events_custom->event_id}}">
                    {{-- Store Event custom id --}}
                    <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
                    {{-- Store Event product id --}}
                    <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
                    {{-- Store Event product title --}}
                    <input type="hidden" class="form-control" name="actual_title" value="{{$events_custom->title}}">
                    {{-- Custom actions --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="buttons">
                                {!! Form::submit('Configurer', ['class' => 'btn btn-primary', 'style' => 'float:right'])
                                !!}
                                <a class='btn btn-secondary' style="float: left"
                                    href="{{route('show_eventsProducts', $events_product->id)}}">Annuler</a>
                            </div>
                        </div>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>{{-- /container --}}
@endsection

    @include('admin.EventsCustoms.includes.modal_addColor')
    @include('admin.EventsCustoms.includes.modal_addFont')
    @include('admin.EventsCustoms.includes.modal_selectFont')




@section('javascripts')
@parent()
<script type="text/Javascript">
</script>
@endsection