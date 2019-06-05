@extends('layouts/templateAdmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                MODIFICATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Modifier un composant
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('TemplateComponentsController@update'), 'files' => true,'class' =>
            'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom</label>
                                {!! Form::text('title', $template_component->title, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                                @if($errors->has('title'))<div class="invalid-feedback">Veuillez renseigner le nom du composant</div>@endif
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <p class="text-muted b-4">Vous ne pouvez pas modifier le type de ce composant. Merci de le supprimer et de le recréer.</p> 
                                {!! Form::text('type', $template_component->comp_type, ['class' => 'form-control text-muted b-2', 'placeholder' => 'Type', 'disabled' => ''])!!}
                                {!! $errors->first('type', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- size position --}}
            <div class="row" type="input image">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Taille du composant
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (cm)
                                        </label>
                                        {!! Form::number('height', $template_component->size["height"], ['class' => 'form-control', 'placeholder' => '']) !!}
                                        {!! $errors->first('height', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Largeur (cm)
                                        </label>
                                        {!! Form::number('width', $template_component->size["width"], ['class' => 'form-control', 'placeholder' => '']) !!}
                                        {!! $errors->first('width', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" type="input image">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Position du composant
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            X (cm)
                                        </label>
                                        {!! Form::number('origin_x', $template_component->origin["x"], ['class' => 'form-control', 'placeholder' =>'0']) !!}
                                        {!! $errors->first('origin_x', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Y (cm)
                                        </label>
                                        {!! Form::number('origin_y', $template_component->origin["y"], ['class' => 'form-control', 'placeholder' => '0']) !!}
                                        {!! $errors->first('origin_y', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($template_component->comp_type == 'input')
            <div type="input">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-header-title">
                                    Nombre de caractères
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Minimum
                                            </label>
                                            {!! Form::number('min', $template_component->characters["min"], ['class' => 'form-control', 'placeholder' => '1']) !!}
                                            {!! $errors->first('min', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Maximum
                                            </label>
                                            {!! Form::number('max', $template_component->characters["max"], ['class' => 'form-control', 'placeholder' =>
                                            '99']) !!} 
                                            {!! $errors->first('max', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('fonts_total', '3') !!}
            @endif
            {{-- Input Image --}}
            @if($template_component->comp_type == 'image')
                @include('admin.TemplatesComponents.includes.edit.image')
            @endif
            {{-- <div data-root="componentElement" type="image input">
                <div class="row" >
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="custom-control custom-switch">
                                        <input name="is_active" type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Ce composant est-il actif ?</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- hidden for edit --}}
            <input type="hidden" class="form-control" name="actual_title" value="{{$template_component->title}}">
            <input type="hidden" class="form-control" name="template_component_id" value="{{$template_component->id}}">
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier le composant', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_templatesComponents')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection