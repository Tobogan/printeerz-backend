@extends('layouts/templateAdmin')
@section('title', 'Composants')

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
                                Créer un composant
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('TemplateComponentsController@store'), 'files' => true,'class' =>
            'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>
                                    Nom du composant
                                </label>
                                {!! Form::text('title', null, [
                                'class' => 'form-control' . $errors->first('title', 'is-invalid'),
                                'placeholder' => 'Nom'
                                ])
                                !!}
                                @if($errors->has('title'))<div class="invalid-feedback">Veuillez renseigner le nom du
                                    composant</div>@endif
                            </div>
                            <div class="form-group">
                                <label>
                                    Type
                                </label>
                                <div class="form-group">
                                    <select name="type" id="componentElementType" class="form-control"
                                        data-toggle="select">
                                        <option value="none">Aucun</option>
                                        <option value="input">Champ de texte</option>
                                        <option value="image">Image</option>
                                        <option value="text" disabled>Texte fixe</option>
                                        <option value="instagram" disabled>Instagram</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.TemplatesComponents.includes.sizeposition')
            @include('admin.TemplatesComponents.includes.input')
            @include('admin.TemplatesComponents.includes.image')
            {!! Form::hidden('is_deleted', "false") !!}
            {!! Form::hidden('is_active', "true") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le composant', [
                        'class' => 'btn btn-primary',
                        'style' => 'float:right'
                        ])
                        !!}
                        <a class='btn btn-secondary' style="float: left"
                            href="{{route('index_templatesComponents')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection