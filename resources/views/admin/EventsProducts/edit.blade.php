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
                                {{$events_product->title}}
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open(['action' => array('EventsProductsController@update'), 'id' => $events_product->id, 'files' => true, 'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="form-group">
                        <label>
                            Nom du produit
                        </label>
                        {!! Form::text('title', $events_product->title, ['class' => 'form-control', 'placeholder' => 'Nom du produit']) !!}
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Image</p>
                    <p class="text-muted b-4">Ajouter l'image du produit en format 1:1</p>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div class="custom-file">
                            {!! Form::file('image', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
                            <label class="custom-file-label" for="logo_img">Télécharger l'image du produit</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <p class="h3">Description</p>
                        <p class="text-muted b-4">Ecriver une description rapide du produit (max: 750 caractères)</p>
                        <input id="textDescription" type="textarea" class="description" name="description" rows="3" value="{{ $events_product->description }}">
                    </div>
                </div>
            </div>
            {{-- Custom actions --}}
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' href="{{route('show_event', $events_product->event_id)}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection