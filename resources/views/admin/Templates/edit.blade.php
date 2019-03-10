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
                                Modifier un gabarit
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
            {!! Form::open(['action' => array('TemplatesController@update'), 'id' => $template->id, 'files' => true,
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
                        {!! Form::text('title', $template->title, ['class' => 'form-control', 'placeholder' => 'Nom'])
                        !!}
                    </div>
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Catégorie
                        </label>
                        <!-- Input -->
                        {!! Form::text('category', $template->category, ['class' => 'form-control', 'placeholder' => 'Catégorie'])
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
                        @if(isset($template->size["width"]))
                            {!! Form::number('width', $template->size["width"], ['class' => 'form-control', 'placeholder' =>
                            'Largeur de la zone :']) !!}
                        @else
                            {!! Form::number('width', $template->size["width"], ['class' => 'form-control', 'placeholder' =>
                            'Largeur de la zone :']) !!}
                        @endif
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
                        @if(isset($template->size["height"]))
                            {!! Form::number('height', $template->size["height"], ['class' => 'form-control', 'placeholder' =>
                            'Hauteur de la zone :']) !!}
                        @else
                            {!! Form::number('height', $template->size["height"], ['class' => 'form-control', 'placeholder' =>
                            'Hauteur de la zone :']) !!}
                        @endif
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
                        @if(isset($template->origin["x"]))
                            {!! Form::number('origin_x', $template->origin["x"], ['class' => 'form-control', 'placeholder' =>
                            'Origine x du plateau :']) !!}
                        @else
                            {!! Form::number('origin_x', $template->origin["x"], ['class' => 'form-control', 'placeholder' =>
                            'Origine x du plateau :']) !!}
                        @endif
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
                        @if(isset($template->origin["y"]))
                            {!! Form::number('origin_y', $template->origin["y"], ['class' => 'form-control', 'placeholder' =>
                            'Origine y du plateau :']) !!}
                        @else
                            {!! Form::number('origin_y', $template->origin["y"], ['class' => 'form-control', 'placeholder' =>
                            'Origine y du plateau :']) !!}
                        @endif
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
                        {!! Form::select('components_ids[]', App\Template_components::pluck('title','_id'), $template->components_ids, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                    </div>
                </div>
                {!! Form::file('thumb', array('id' => 'thumb', 'name' => 'thumb')) !!}
                {!! Form::file('full', array('id' => 'full', 'name' => 'full')) !!}
            </div>

            {!! Form::hidden('template_id', $template->id) !!}
            {!! Form::hidden('actual_title', $template->title) !!}
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