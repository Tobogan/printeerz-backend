@extends('layouts/templateAdmin')

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
                                Créer un gabarit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open(['action' => array('TemplatesController@store'), 'files' => true,
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
                                            Nom du gabarit
                                        </label>
                                        {!! Form::text('title', null, ['class' => 'form-control' . $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom'])!!}
                                        @if($errors->has('title'))<div class="invalid-feedback">Veuillez renseigner le nom du gabarit</div>@endif
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Catégorie
                                        </label>
                                        {!! Form::text('category', null, ['class' => 'form-control' . $errors->first('category', ' is-invalid'), 'placeholder' => 'Catégorie']) !!}
                                        @if($errors->has('category'))<div class="invalid-feedback">Veuillez renseigner la catégorie du gabarit</div>@endif
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
                                Taille du template
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Largeur (mm)
                                        </label>
                                        {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' =>
                                        '150']) !!}
                                        {!! $errors->first('width', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (mm)
                                        </label>
                                        {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' =>
                                        '150']) !!}
                                        {!! $errors->first('height', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
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
                                Position du template
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            X (mm)
                                        </label>
                                        {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>
                                        '0']) !!}
                                        {!! $errors->first('origin_x', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Y (mm)
                                        </label>
                                        {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' =>
                                        '0']) !!}
                                        {!! $errors->first('origin_y', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
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
                                Composants
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group m-0">
                                        {!! Form::select('components_ids[]',
                                        App\Template_components::pluck('title','_id'), null, ['id' =>
                                        'componentsSelect', 'class' => '', 'data-toggle' =>'select']) !!}
                                        {!! $errors->first('components_ids', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                    <div id="templateComponentsList" data-type="sortable" class="mt-3">
                                    </div>
                                    {!! Form::hidden('templateComponentsList', "false", ['id' => 'templateComponentsListHidden']) !!}
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
                                Image d'illustration
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="thumb">Ajoutez la miniature</label>
                                        {!! Form::file('thumb', array('class' => 'form-control', 'id'
                                        => 'thumb', 'name' => 'thumb')) !!}
                                        {!! $errors->first('thumb', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="full">Ajoutez l'image</label>
                                        {!! Form::file('full', array('class' => 'form-control', 'id'
                                        => 'full', 'name' => 'full')) !!}
                                        {!! $errors->first('full', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le gabarit', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_templates')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script type="text/Javascript">

$('#templateComponentsList').on('change', function () {
    var comp = $('#hidden_comp').val();
    console.log('comp');
});
</script>
@endsection