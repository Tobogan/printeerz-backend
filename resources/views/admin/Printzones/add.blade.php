@extends('layouts/templateAdmin')
@section('title', 'Zones d\'impression')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                CREATION
                            </h6>
                            <h1 class="header-title">
                                Créer une zone d'impression
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open([
            'action' => array('PrintzonesController@store'),
            'files' => true,
            'class' => 'mb-4'
            ]) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                            Nom de la zone
                                        </label>
                                        {!! Form::text('name', null, [
                                        'class' => 'form-control'. $errors->first('name','is-invalid'),
                                        'placeholder' => 'Nom de la zone'
                                        ]) !!}
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Zone
                                        </label>
                                        {!! Form::text('zone', null, [
                                        'class' => 'form-control'. $errors->first('zone','is-invalid'),
                                        'placeholder' => 'Zone'
                                        ]) !!}
                                        @if($errors->has('zone'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Taille du plateau
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Largeur (mm)
                                        </label>
                                        {!! Form::number('tray_width', null, [
                                        'class' => 'form-control',
                                        'placeholder' => '250'
                                        ]) !!}
                                        <div>{!! $errors->first('tray_width', '<p class="help-block mt-2"
                                                style="color:red;"><small>Champ obligatoire</small></p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (mm)
                                        </label>
                                        {!! Form::number('tray_height', null, [
                                        'class' => 'form-control',
                                        'placeholder' => '250'
                                        ]) !!}
                                        <div>{!! $errors->first('tray_height', '<p class="help-block mt-2"
                                                style="color:red;"><small>Champ obligatoire</small>
                                            </p>') !!}
                                        </div>
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Taille de la zone d'impression
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Largeur (mm)
                                        </label>
                                        {!! Form::number('size_width', null, ['class' =>
                                        'form-control'.$errors->first('width', ' is-invalid'),
                                        'placeholder' =>'250'
                                        ]) !!}
                                        @if ($errors->has('size_width'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (mm)
                                        </label>
                                        {!! Form::number('size_height', null, [
                                        'class' => 'form-control'.$errors->first('height', ' is-invalid'),
                                        'placeholder' =>'250'
                                        ]) !!}
                                        @if ($errors->has('size_height'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Alignement
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Alignement horizontal</label>
                                        <select name="alignX" id="alignX" class="form-control" data-toggle="select">
                                            <option value="left">Gauche</option>
                                            <option value="right">Droite</option>
                                            <option value="center">Centré</option>
                                            <option value="false">Aucun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Alignement vertical</label>
                                        <select name="alignY" id="alignY" class="form-control" data-toggle="select">
                                            <option value="top">En haut</option>
                                            <option value="middle">Milieu</option>
                                            <option value="bottom">Bas</option>
                                            <option value="false">Aucun</option>
                                        </select>
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Alignement & Ratio
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Position X
                                        </label>
                                        {!! Form::number('position_x', null, [
                                        'class' => 'form-control'.$errors->first('position_x', ' is-invalid'),
                                        'placeholder' =>'0.5',
                                        'step' => 'any'
                                        ]) !!}
                                        @if($errors->has('position_x'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Position Y
                                        </label>
                                        {!! Form::number('position_y', null, [
                                        'class' => 'form-control'.$errors->first('position_y', ' is-invalid'),
                                        'placeholder' =>'0.5', 'step' => 'any'
                                        ]) !!}
                                        @if($errors->has('position_y'))<div class="invalid-feedback">Veuillez renseigner
                                            ce
                                            champ</div>@endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Ratio
                                        </label>
                                        {!! Form::number('ratio', null, [
                                        'class' => 'form-control'.$errors->first('ratio', ' is-invalid'),
                                        'placeholder' =>'0.5',
                                        'step' => 'any'
                                        ]) !!}
                                        @if($errors->has('ratio'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Position de la zone par rapport au plateau
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            X (mm)
                                        </label>
                                        {!! Form::number('origin_x', null, [
                                        'class' => 'form-control',
                                        'placeholder' => '0'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Y (mm)
                                        </label>
                                        {!! Form::number('origin_y', null, [
                                        'class' => 'form-control',
                                        'placeholder' =>'0'
                                        ]) !!}
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
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Description
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="textDescription" type="textarea" class="description"
                                            name="description" rows="3" maxlength="750">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('is_active', 'true', [
            'id'=>'formActive'
            ]) !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer la zone', [
                        'class' => 'btn btn-primary',
                        'style' => 'float: right'
                        ]) !!}
                        <a class='btn btn-secondary' style="float: left"
                            href="{{route('index_printzones')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endsection