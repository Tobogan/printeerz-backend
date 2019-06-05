@extends('layouts/templateAdmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                MODIFICATION
                            </h6>
                            <h1 class="header-title">
                                {{$font->title}}
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('FontsController@update'), 'id' => $font->id, 'files' => true,
            'class' => 'mb-4']) !!}
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
                                        {!! Form::text('title', $font->title, ['class' => 'form-control'.
                                        $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom'])!!}
                                        @if($errors->has('title'))<div class="invalid-feedback">Nom de police incorrect ou déjà connu.</div>@endif
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Epaisseur de la police
                                        </label>
                                        {!! Form::select('weight', $font_weights, $font->weight, ['class' => 'form-control'])!!}
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
                                    <div class="custom-control custom-switch">
                                        <input name="is_active" type="checkbox" class="custom-control-input" id="isActive" value="{{ $font->is_active }}">
                                        <label class="custom-control-label" for="isActive">Cette police est-elle active
                                            ?</label>
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
                                    <p class="text-muted mb-4">Ajoutez un nouveau fichier de police au format .ttf, .otf, .woff, .eot, .svg. (max 4mo)</p>
                                </div>
                                <div class="col-12">
                                    <!-- First name -->
                                    <div class="form-group">
                                            <label >Charger un nouveau fichier</label>
                                        {!! Form::file('file_font', array( 'class' => 'form-control', 'id' => 'file_font')) !!}
                                        {!! $errors->first('file_font', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::hidden('is_active', $font->is_active, [ 'id'=>'formActive']) !!}
            {!! Form::hidden('font_id', $font->id) !!}
            {!! Form::hidden('actual_title', $font->title) !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier la police', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left"
                            href="{{route('index_fonts')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection