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
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['action' => array('TemplatesController@store'), 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom du gabarit
                        </label>
                        <!-- Input -->
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom'])
                        !!}
                    </div>
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Catégorie
                        </label>
                        <!-- Input -->
                        {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Catégorie'])
                        !!}
                    </div>
                </div>
                <hr class="mt-4 mb-5">
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Largeur du gabarit
                        </label>
                        <!-- Input -->
                        {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' =>
                        'Largeur de la zone :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Hauteur du gabarit
                        </label>
                        <!-- Input -->
                        {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => 'Hauteur de la zone']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Position X d'origine sur le plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>
                        'Position X d\'origine sur le plateau :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Position Y d'origine sur le plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' =>
                        'Position y d\'origine sur le plateau :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Composants
                        </label>
                        <!-- Input -->
                        {!! Form::select('components_ids[]', App\Template_components::pluck('title','_id'), null, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                    </div>
                </div>
                {!! Form::file('thumb', array('id' => 'thumb', 'name' => 'thumb')) !!}
                {!! Form::file('full', array('id' => 'full', 'name' => 'full')) !!}
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