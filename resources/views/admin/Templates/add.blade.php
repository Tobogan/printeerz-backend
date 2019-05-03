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
                                Créer un gabarit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('TemplatesController@store'), 'files' => true,
            'class' => 'mb-4']) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Nom du gabarit
                                        </label>
                                        <!-- Input -->
                                        {!! Form::text('title', null, ['class' => 'form-control' . $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom'])!!}
                                        @if($errors->has('title'))<div class="invalid-feedback">Veuillez renseigner le nom du gabarit</div>@endif
                                    </div>
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Catégorie
                                        </label>
                                        <!-- Input -->
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
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Largeur (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' =>
                                        '']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Hauteur (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' =>
                                        '']) !!}
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
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            X (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>
                                        '0']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Y (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' =>
                                        '0']) !!}
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
                                    <!-- First name -->
                                    <p class="text-muted">Attention! Vous ne devez pas créer un gabarit avec deux composants identiques.</p>
                                    <div class="form-group m-0">
                                        <!-- Input -->
                                        {!! Form::select('components_ids[]',
                                        App\Template_components::pluck('title','_id'), null, ['id' =>
                                        'componentsSelect', 'class' => '', 'data-toggle' =>'select']) !!}
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
                                    <!-- First name -->
                                    <div class="custom-file">
                                        {!! Form::file('thumb', array('class' => 'form-control custom-file-input', 'id'
                                        => 'thumb', 'name' => 'thumb')) !!}
                                        <label class="custom-file-label" for="thumb">Ajouter la miniature</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="custom-file">
                                        {!! Form::file('full', array('class' => 'form-control custom-file-input', 'id'
                                        => 'full', 'name' => 'full')) !!}
                                        <label class="custom-file-label" for="full">Ajouter l'image</label>
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