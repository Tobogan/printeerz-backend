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
                                CREATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Créer une police
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('FontsController@store'), 'files' => true, 'class' => 'mb-4']) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                            Nom de la police
                                        </label>
                                        {!! Form::text('title', null, ['class' => 'form-control'. $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom'])!!}
                                        @if($errors->has('title'))<div class="invalid-feedback">Nom de police incorrect ou déjà connu.</div>@endif
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Epaisseur de la police
                                        </label>
                                        {!! Form::select('weight', $font_weights, null, ['class' => 'form-control'. $errors->first('weight', ' is-invalid')])!!}
                                        @if($errors->has('weight'))<div class="invalid-feedback">Veuillez renseigner ce champ</div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <p class="h3">Fichier de la police</p>
                                    <p class="text-muted mb-4">Ajoutez le fichier de la police au format .ttf, .otf, .woff, .eot, .svg. (max 4mo)</p>
                                </div>
                                <div class="col-12">
                                    <!-- First name -->
                                    <div class="form-group">
                                            <label >Charger un fichier</label>
                                        {!! Form::file('file_font', array( 'class' => 'form-control', 'id' => 'file_font')) !!}
                                        {!! $errors->first('file_font', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::hidden('is_active', 'true') !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer la police', ['class' => 'btn btn-primary', 'style' => 'float: right']) !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_fonts')}}">Annuler</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection