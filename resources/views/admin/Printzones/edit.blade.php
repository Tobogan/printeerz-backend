@extends('layouts/templateAdmin')
@section('title', 'Zones d\'impression')

@section('content')
          @php
    dd($event);
@endphp
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
                                {{$printzone->name}}
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('PrintzonesController@update'), 'id' => $printzone->id, 'files' => true,
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
                                            Nom de la zone
                                        </label>
                                        {!! Form::text('name', $printzone->name, [
                                        'class' => 'form-control'.$errors->first('name', ' is-invalid'),
                                        'placeholder' => 'Nom de la zone'
                                        ])
                                        !!}
                                        @if($errors->has('name'))<div class="invalid-feedback">Veuillez renseigner ce
                                            champ</div>@endif
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Zone
                                        </label>
                                        {!! Form::text('zone', $printzone->zone, [
                                        'class' => 'form-control'.$errors->first('name', ' is-invalid'),
                                        'placeholder' => 'Zone'
                                        ])
                                        !!}
                                        @if($errors->has('zone'))<div class="invalid-feedback">Veuillez renseigner ce
                                            champ</div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- PRINTZONE SIZE --}}
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
                                        {!! Form::number('size_width', $printzone->size['width'], [
                                        'class' => 'form-control'.$errors->first('size_width', ' is-invalid'),
                                        'placeholder' =>'250'
                                        ])
                                        !!}
                                        @if($errors->has('size_width'))<div class="invalid-feedback">Veuillez renseigner ce
                                            champ</div>@endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (mm)
                                        </label>
                                        {!! Form::number('size_height', $printzone->size_height, [
                                        'class' => 'form-control'.$errors->first('size_height', ' is-invalid'),
                                        'placeholder' =>'250'
                                        ])
                                        !!}
                                        @if($errors->has('size_height'))<div class="invalid-feedback">Veuillez renseigner ce
                                            champ</div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TRAY SIZE --}}
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
                                        {!! Form::number('tray["width"]', $printzone->tray["width"], [
                                        'class' => 'form-control',
                                        'placeholder' => '250'
                                        ]) !!}
                                        <div>{!! $errors->first('tray["width"]', '<p class="help-block mt-2"
                                                style="color:red;"><small>Champ obligatoire</small></p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (mm)
                                        </label>
                                        {!! Form::number('tray["height"]', $printzone->tray["height"], [
                                        'class' => 'form-control',
                                        'placeholder' => '250'
                                        ]) !!}
                                        <div>{!! $errors->first('tray["height"]', '<p class="help-block mt-2"
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

            {{-- Printzone position on the screen --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Position de la zone sur l'écran
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            X (mm)
                                        </label>
                                        {!! Form::number('screen_pos_x', $printzone->product_position['x'], [
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
                                        {!! Form::number('screen_pos_y', $printzone->product_position['y'], [
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
                                Alignement & ratio de la zone d'impression sur l'écran
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Alignement horizontal</label>
                                        <select name="screen_pos_align_x" id="screen_pos_align_x" class="form-control" data-toggle="select">
                                            @if ($printzone->product_position['align_x'] == "left")
                                            <option value="left" selected>Gauche</option>
                                            <option value="right">Droite</option>
                                            <option value="center">Centré</option>
                                            <option value="false">Aucun</option>
                                        @elseif ($printzone->product_position['align_x'] == "right")
                                            <option value="left">Gauche</option>
                                            <option value="right" selected>Droite</option>
                                            <option value="center">Centré</option>
                                            <option value="false">Aucun</option>
                                        @elseif ($printzone->product_position['align_x'] == "center")
                                            <option value="left">Gauche</option>
                                            <option value="right">Droite</option>
                                            <option value="center" selected>Centré</option>
                                            <option value="false">Aucun</option>
                                        @else
                                            <option value="left">Gauche</option>
                                            <option value="right">Droite</option>
                                            <option value="center">Centré</option>
                                            <option value="false" selected>Aucun</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Alignement vertical</label>
                                        <select name="screen_pos_align_y" id="screen_pos_align_y" class="form-control" data-toggle="select">
                                            @if ($printzone->product_position['align_y'] == "top")
                                                <option value="top" selected>En haut</option>
                                                <option value="middle">Milieu</option>
                                                <option value="bottom">Bas</option>
                                                <option value="false">Aucun</option>
                                            @elseif ($printzone->product_position['align_y'] == "middle")
                                                <option value="top">En haut</option>
                                                <option value="middle" selected>Milieu</option>
                                                <option value="bottom">Bas</option>
                                                <option value="false">Aucun</option>
                                            @elseif ($printzone->product_position['align_y'] == "bottom")
                                                <option value="top">En haut</option>
                                                <option value="middle">Milieu</option>
                                                <option value="bottom" selected>Bas</option>
                                                <option value="false">Aucun</option>
                                            @elseif ($printzone->product_position['align_y'] == "middle")
                                                <option value="top">En haut</option>
                                                <option value="middle">Milieu</option>
                                                <option value="bottom">Bas</option>
                                                <option value="false" selected>Aucun</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Ratio
                                        </label>
                                        {!! Form::number('screen_pos_ratio', $printzone->product_position['ratio'], [
                                        'class' => 'form-control'.$errors->first('screen_pos_ratio', ' is-invalid'),
                                        'placeholder' =>'0.5',
                                        'step' => 'any'
                                        ]) !!}
                                        @if($errors->has('screen_pos_ratio'))
                                        <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Printzone position on tray --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Position de la zone d'impression par rapport au plateau
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Position X
                                        </label>
                                        {!! Form::number('tray_position_x', $printzone->tray['x'], [
                                        'class' => 'form-control'.$errors->first('tray_position_x', 'is-invalid'),
                                        'placeholder' =>'0'
                                        ]) !!}
                                        @if($errors->has('tray_position_x'))
                                            <div class="invalid-feedback">Veuillez renseigner ce champ</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Position Y
                                        </label>
                                        {!! Form::number('tray_position_y', $printzone->tray['y'], [
                                        'class' => 'form-control'.$errors->first('tray_position_y', 'is-invalid'),
                                        'placeholder' =>'0'
                                        ]) !!}
                                        @if($errors->has('tray_position_y'))
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
                                Description
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="textDescription" type="textarea" class="description"
                                            name="description" rows="3" value="{{ $printzone->description }}">
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
                                        <input name="is_active" type="checkbox" class="custom-control-input"
                                            id="isActive" value="$printzone->is_active">
                                        <label class="custom-control-label" for="isActive">Ce composant est-il actif
                                            ?</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('is_active', $printzone->is_active, [ 'id'=>'formActive']) !!}
            {!! Form::hidden('printzones_id', $printzone->id) !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier la zone', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left"
                            href="{{route('index_printzones')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection