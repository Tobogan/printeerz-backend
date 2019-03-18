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
                                Configurer une personnalisation
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
            {!! Form::open(['action' => array('EventsCustomsController@update'), 'files' => true,'class' =>
            'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                {!! Form::text('title', $events_custom->title, ['class' => 'form-control', 'placeholder' => '']) !!}
                <div class="col-12">
                    @foreach($templates as $template)
                    <?php $array_template = $events_custom->template ?>
                        @if($template->id == reset($array_template))
                            @foreach($template_components as $template_component)
                                @foreach($template->components_ids as $component_id)
                                    @if($template_component->id == $component_id)
                                        @if($template_component->type = 'input')
                                        <div class="row">
                                            {{csrf_field()}}
                                            <input type="hidden" class="form-control" name="template_component_id" value="{{$template_component->id}}">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-header-title">
                                                            {{$template_component->title}}
                                                        </h3>
                                                    </div>
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
                                                                    {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                                                    {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                    {!! Form::text('font_title', $template_component->font["name"], ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
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
                                                                        Epaisseur    {{$template_component->font["weight"]}}
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
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
                                                                        Transformation  {{$template_component->font["transform"]}}
                                                                    </label>
                                                                    {{-- choix de transformation --}}
                                                                    <div class="form-group">
                                                                        <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
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
                                                                    {!! Form::text('font_first_letter', $template_component->font["first_letter"], ['class' => 'form-control',
                                                                    'placeholder' => '#']) !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            <?php //dd($events_custom->id); ?>
            <input type="hidden" class="form-control" name="events_custom_id" value="{{$events_custom->id}}">
            <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
            <input type="hidden" class="form-control" name="actual_title" value="{{$events_product->title}}">

            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Configurer', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('show_event', $events_product->event_id)}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

{{-- $('#components').append(
    '@foreach($templates as $template)
        @if($template->id==' + value + ')
            @if($templage->components_ids != null)
                @foreach($template_components as $template_component)
                    @foreach($template->components_ids as $component_id)
                        @if($template_component->id == $component_id)
                            @if($template_component->type =="input")
                                <div class="form-group">
                                    <select name="type" class="form-control" data-toggle="select">
                                        <option value="none">Aucun</option>
                                        <option value="input" selected>Champ de texte</option>
                                        <option value="image">Image</option>
                                        <option value="text" disabled>Texte fixe</option>
                                        <option value="instagram" disabled>Instagram</option>
                                    </select>
                                </div>
                            @endif
                            @if($template_component->type=="image")
                                <div class="form-group">
                                    <select name="type" class="form-control" data-toggle="select">
                                        <option value="none">Aucun</option>
                                        <option value="input">Champ de texte</option>
                                        <option value="image" selected>Image</option>
                                        <option value="text" disabled>Texte fixe</option>
                                        <option value="instagram" disabled>Instagram</option>
                                    </select>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endif
        @endif
    @endforeach'
); --}}