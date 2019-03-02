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
            {!! Form::open(['action' => array('TemplateComponentsController@store'), 'files' => true,'class' =>
            'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="card">
                        <div class="card-body">
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
                                    <div class="form-group">
                                        <select name="font-weight" id="type" class="form-control" data-toggle="select">
                                            <option value="input">Champ de texte</option>
                                            <option value="text">Texte fixe</option>
                                            <option value="image">Image</option>
                                            <option value="instagram" disabled>Instagram</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-4 mb-5">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Taille du gabarit
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
                                        {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                        {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                Position du gabarit
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
                                        {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>'0']) !!}
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
                                        {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' => '0']) !!}
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
                                Nombre de caractères
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Minimum
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('min', null, ['class' => 'form-control', 'placeholder' => '1']) !!} </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Maximum
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('max', null, ['class' => 'form-control', 'placeholder' => '99']) !!} </div>
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
                                Police de caractère par défault
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <!-- First name -->
                                <div class="form-group">
                                    <!-- Label -->
                                    <label>
                                        Nom
                                    </label>
                                    <!-- Input -->
                                    {!! Form::text('font_name_1', null, ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- First name -->
                                <div class="custom-file">
                                    {!! Form::file('font_url_1', array('class' => 'form-control custom-file-input',
                                    'id' =>'photo_profile')) !!}
                                    <label class="custom-file-label" for="photo_profile">Ajouter le fichier de la police</label>
                                </div>
                            </div>
                            <hr class="mt-4 mb-5">
                            <div class="col-12">
                               <div class="form-group">
                                    <!-- Label -->
                                    <label>
                                        Epaisseur
                                    </label>
                                    <div class="form-group">
                                        <select name="font-weight" id="font_weight_1" class="form-control" data-toggle="select">
                                            <option value="100">Thin (100)</option>
                                            <option value="200">Extra Light (200)</option>
                                            <option value="300">Light (300)</option>
                                            <option value="400">Normal (400)</option>
                                            <option value="500">Medium (500)</option>
                                            <option value="600">Semi Bold (600)</option>
                                            <option value="700">Bold (700)</option>
                                            <option value="800">Extra Bold (800)</option>
                                            <option value="900">Black (900)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- First name -->
                                <div class="form-group">
                                    <!-- Label -->
                                    <label>
                                        Transformation
                                    </label>
                                    <div class="form-group">
                                        <select name="text-transform" id="font_transform_1" class="form-control" data-toggle="select">
                                            <option value="none">Aucune</option>
                                            <option value="uppercase">Tout en Majuscules</option>
                                            <option value="capitalize">Première lettre en Majuscule</option>
                                            <option value="lowercase">Tout en minuscule</option>
                                            <option value="full-width">Pleine largeur</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- First name -->
                                <div class="form-group">
                                    <!-- Label -->
                                    <label>
                                        Première lettre ou symbole avant le texte
                                    </label>
                                    <!-- Input -->
                                    {!! Form::text('font_first_letter_1', null, ['class' => 'form-control', 'placeholder' => '#']) !!}
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
                        {!! Form::submit('Créer le composant', ['class' => 'btn btn-primary', 'style' => 'float:
                        right'])
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