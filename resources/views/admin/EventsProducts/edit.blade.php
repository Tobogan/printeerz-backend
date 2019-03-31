@extends('layouts/templateAdmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header -->
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                MODIFICATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Modifier un produit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['action' => array('EventsProductsController@update'), 'id' => $events_product->id, 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom du produit
                        </label>
                        <!-- Input -->
                        {!! Form::text('title', $events_product->title, ['class' => 'form-control', 'placeholder' => 'Nom du produit'])
                        !!}
                    </div>
                </div>
                <div class="col-12">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Type de produit
                            </label>
                            <!-- Input -->
                            {{ Form::select('product_id', $select_products, $events_product->product_id, array('id' => 'addEventProductSelect', 'data-toggle' => 'select')) }}
                        </div>
                    </div>
                    <hr class="mt-4 mb-5">
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Description
                        </label>
                        <!-- Input -->
                        <div class="form-group">
                            <input type="textarea" id="textDescription" name="product_description" rows="3">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="form-control" name="actual_title" value="{{$events_product->title}}">
            <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier le produit', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_event')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection