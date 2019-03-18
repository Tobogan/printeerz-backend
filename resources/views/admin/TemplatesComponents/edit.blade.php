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
                                Modifier un composant
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
            {!! Form::open(['action' => array('TemplateComponentsController@update'), 'files' => true,'class' =>
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
                                    Nom du composant
                                </label>
                                <!-- Input -->
                                {!! Form::text('title', $template_component->title, ['class' => 'form-control', 'placeholder' => 'Nom'])
                                !!}
                            </div>
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Type
                                </label>

                                @if($template_component->type == 'input')
                                    <div class="form-group">
                                        <select name="type" id="componentElementType" class="form-control" data-toggle="select">
                                            <option value="none">Aucun</option>
                                            <option value="input" selected>Champ de texte</option>
                                            <option value="image">Image</option>
                                            <option value="text" disabled>Texte fixe</option>
                                            <option value="instagram" disabled>Instagram</option>
                                        </select>
                                    </div>
                                @endif

                                @if($template_component->type == 'image')
                                    <div class="form-group">
                                        <select name="type" id="componentElementType" class="form-control" data-toggle="select">
                                            <option value="none">Aucun</option>
                                            <option value="input">Champ de texte</option>
                                            <option value="image" selected>Image</option>
                                            <option value="text" disabled>Texte fixe</option>
                                            <option value="instagram" disabled>Instagram</option>
                                        </select>
                                    </div>
                                @endif

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
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Hauteur (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('height', $template_component->size["height"], ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            Largeur (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('width', $template_component->size["width"], ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                    <!-- First name -->
                                    <div class="form-group">
                                        <!-- Label -->
                                        <label>
                                            X (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('origin_x', $template_component->origin["x"], ['class' => 'form-control', 'placeholder' =>'0']) !!}
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
                                        {!! Form::number('origin_y', $template_component->origin["y"], ['class' => 'form-control', 'placeholder' => '0']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($template_component->type == 'input')
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
                                        <!-- First name -->
                                        <div class="form-group">
                                            <!-- Label -->
                                            <label>
                                                Minimum
                                            </label>
                                            <!-- Input -->
                                            {!! Form::number('min', $template_component->characters["min"], ['class' => 'form-control', 'placeholder' => '1']) !!} </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <!-- First name -->
                                        <div class="form-group">
                                            <!-- Label -->
                                            <label>
                                                Maximum
                                            </label>
                                            <!-- Input -->
                                            {!! Form::number('max', $template_component->characters["max"], ['class' => 'form-control', 'placeholder' =>
                                            '99']) !!} </div>
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
                                        {!! Form::text('font_name', $template_component->font["name"], ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- First name -->
                                    <div class="custom-file">
                                        {!! Form::file('font_url', array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
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
                                            @if($template_component->font["weight"] == '900')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900" selected>Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '200')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200" selected>Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '300')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300" selected>Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '400')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400" selected>Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '500')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500" selected>Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '600')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600" selected>Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '700')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700" selected>Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @elseif($template_component->font["weight"] == '800')
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100">Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800" selected>Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @else
                                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                                    <option value="100" selected>Thin (100)</option>
                                                    <option value="200">Extra Light (200)</option>
                                                    <option value="300">Light (300)</option>
                                                    <option value="400">Normal (400)</option>
                                                    <option value="500">Medium (500)</option>
                                                    <option value="600">Semi Bold (600)</option>
                                                    <option value="700">Bold (700)</option>
                                                    <option value="800">Extra Bold (800)</option>
                                                    <option value="900">Black (900)</option>
                                                </select>
                                            @endif
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
                                        {{-- choix de transformation --}}
                                        <div class="form-group">
                                            @if($template_component->font["transform"] == 'full-width')
                                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                                    <option value="none">Aucune</option>
                                                    <option value="uppercase">Tout en Majuscules</option>
                                                    <option value="capitalize">Première lettre en Majuscule</option>
                                                    <option value="lowercase">Tout en minuscule</option>
                                                    <option value="full-width" selected>Pleine largeur</option>
                                                </select>
                                            @elseif($template_component->font["transform"] == 'uppercase')
                                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                                    <option value="none">Aucune</option>
                                                    <option value="uppercase" selected>Tout en Majuscules</option>
                                                    <option value="capitalize">Première lettre en Majuscule</option>
                                                    <option value="lowercase">Tout en minuscule</option>
                                                    <option value="full-width">Pleine largeur</option>
                                                </select>
                                            @elseif($template_component->font["transform"] == 'capitalize')
                                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                                    <option value="none">Aucune</option>
                                                    <option value="uppercase">Tout en Majuscules</option>
                                                    <option value="capitalize" selected>Première lettre en Majuscule</option>
                                                    <option value="lowercase">Tout en minuscule</option>
                                                    <option value="full-width">Pleine largeur</option>
                                                </select>
                                            @elseif($template_component->font["transform"] == 'lowercase')
                                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                                    <option value="none">Aucune</option>
                                                    <option value="uppercase">Tout en Majuscules</option>
                                                    <option value="capitalize">Première lettre en Majuscule</option>
                                                    <option value="lowercase" selected>Tout en minuscule</option>
                                                    <option value="full-width">Pleine largeur</option>
                                                </select>
                                            @else
                                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                                    <option value="none" selected>Aucune</option>
                                                    <option value="uppercase">Tout en Majuscules</option>
                                                    <option value="capitalize">Première lettre en Majuscule</option>
                                                    <option value="lowercase">Tout en minuscule</option>
                                                    <option value="full-width" selected>Pleine largeur</option>
                                                </select>
                                            @endif
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
                                        {!! Form::text('font_first_letter', $template_component->font["first_letter"], ['class' => 'form-control',
                                        'placeholder' => '#']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('fonts_total', '3') !!}
            
            <div data-root="componentElement" type="image input">
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
            </div>

            @endif
            {{-- Input Image --}}
            @if($template_component->type == 'image')
            <div data-root="componentElement" type="image">
                <div class="row" >
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-header-title">
                                    Image
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                    <!-- First name -->
                                    <div class="custom-file">
                                        {!! Form::file('image', array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
                                        <label class="custom-file-label" for="photo_profile">Ajouter l'image</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

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