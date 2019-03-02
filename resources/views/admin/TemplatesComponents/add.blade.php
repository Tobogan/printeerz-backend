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
                                Créer un composant
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
            {!! Form::open(['action' => array('TemplateComponentsController@store'), 'files' => true,
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
                            Type
                        </label>
                        <!-- Input -->
                        <div class="col-12">
                            <div class="form-group">
                                <select name="type" id="type" class="form-control" data-toggle="select">
                                    <option value="input">Input</option>
                                    <option value="image">Image</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-4 mb-5">

                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Image
                        </label>
                        <!-- Input -->
                        {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    </div>
                </div>                

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
                            Nombre minimum de caractères
                        </label>
                        <!-- Input -->
                        {!! Form::number('min', null, ['class' => 'form-control', 'placeholder' =>
                        'Nombre minimum de caractères :']) !!}                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nombre maximum de caractères
                        </label>
                        <!-- Input -->
                        {!! Form::number('max', null, ['class' => 'form-control', 'placeholder' =>
                        'Nombre maximum de caractères :']) !!}                    </div>
                </div>
            </div>
            @for($i=1;$i<=5;$i++)
                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Fichier de la police n° {{$i}}
                            </label>
                            <!-- Input -->
                            {!! Form::file('font_url_'.$i, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>                
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Nom de la police n° {{$i}}
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_name_'.$i, null, ['class' => 'form-control', 'placeholder' =>
                            'Entrer le nom de la police :']) !!}
                        </div>
                    </div>                
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Epaisseur de la police n° {{$i}}
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_weight_'.$i, null, ['class' => 'form-control', 'placeholder' =>
                            'Entrer l\'épaisseur de la police :']) !!}
                        </div>
                    </div>                
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Transformation de la police n° {{$i}}
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_transform_'.$i, null, ['class' => 'form-control', 'placeholder' =>
                            'Entrer le transform de la police :']) !!}
                        </div>
                    </div>                
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Première lettre 
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_first_letter_'.$i, null, ['class' => 'form-control', 'placeholder' =>
                            'Entrer la 1ère lettre :']) !!}
                        </div>
                    </div>
                </div>
            @endfor

            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le composant', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_templatesComponents')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection