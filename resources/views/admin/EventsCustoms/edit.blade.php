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
            <?php $i=0; ?>
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
                                        <?php $i++; ?>
                                        <div class="row">
                                            {{csrf_field()}}
                                            <input type="hidden" class="form-control" name="{{'template_component_id'.$i}}" value="{{$template_component->id}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Taille du composant
                                                        </h4>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- First name -->
                                                        <div class="form-group">
                                                            <!-- Label -->
                                                            <label>
                                                                Hauteur (cm)
                                                            </label>
                                                            <!-- Input -->
                                                            {!! Form::number('height'.$i, $template_component->size["height"], ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                                            {!! Form::number('width'.$i,  $template_component->size["width"], ['class' => 'form-control', 'placeholder' => '']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Position du composant
                                                        </h4>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- First name -->
                                                        <div class="form-group">
                                                            <!-- Label -->
                                                            <label>
                                                                X (cm)
                                                            </label>
                                                            <!-- Input -->
                                                            {!! Form::number('origin_x'.$i,  $template_component->origin["x"], ['class' => 'form-control', 'placeholder' =>'0']) !!}
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
                                                            {!! Form::number('origin_y'.$i, $template_component->origin["y"], ['class' => 'form-control', 'placeholder' => '0']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-header-title">
                                                            {{$template_component->title}}
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-header">
                                                            <h4 class="card-header-title">
                                                                Nom de l'option
                                                            </h4>
                                                        </div>
                                                        <div class="form-group">
                                                                <!-- Label -->
                                                                <label>
                                                                    Nom
                                                                </label>
                                                                <!-- Input -->
                                                                @if(isset($template_component->font["name"]))
                                                                    {!! Form::text('font_title'.$i, $template_component->font["name"], ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                                                @else
                                                                    {!! Form::text('font_title'.$i, null, ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                                                @endif
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
                                                                        {!! Form::number('min'.$i, $template_component->characters["min"], ['class' => 'form-control', 'placeholder' => '1']) !!} </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <!-- First name -->
                                                                    <div class="form-group">
                                                                        <!-- Label -->
                                                                        <label>
                                                                            Maximum
                                                                        </label>
                                                                        <!-- Input -->
                                                                        {!! Form::number('max'.$i, $template_component->characters["max"], ['class' => 'form-control', 'placeholder' =>
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
                                                                    {!! Form::text('font_title'.$i, $template_component->font["name"], ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <!-- First name -->
                                                                <div class="custom-file">
                                                                    {!! Form::file('font_url'.$i, array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
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
                                                                        <select name="{{'font_weight'.$i}}" id="font_weight" class="form-control" data-toggle="select">
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
                                                                        <select name="{{'font_transform'.$i}}" id="font_transform" class="form-control" data-toggle="select">
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
                                                                    {!! Form::text('font_first_letter'.$i, $template_component->font["first_letter"], ['class' => 'form-control',
                                                                    'placeholder' => '#']) !!}
                                                                </div>

                                                                <hr>
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Couleur
                                                                    </label>
                                                                    <a href="#" style="float:right" class="buttonColor btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#addColorModal" data-id="{{$template_component->id}}">
                                                                        Ajouter une couleur
                                                                    </a>
                                                                            <?php //dd($template_component->id) ?>
                                                                    <!-- Input text title-->
                                                                    {!! Form::text('color'.$i, null, ['class' => 'form-control', 'placeholder' => 'Couleur'])
                                                                    !!}
                                                                    {{--<input type="hidden" name="hiddenTemplate_component_id" id="{{'hiddenTemplate_component_id'.$id}}" value="{{ $template_component->id }}">--}}
                                                                    <div id="newsColors">
                                                                        <input type="hidden" name="{{'colorsList'.$template_component->id.'[]'}}" id="{{'colorsList'.$template_component->id}}">
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                            {{--<input type="hidden" name="tp_id" id="{{'tp_id'.$i}}" value="{{$template_component->id}}">--}}
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Code hex
                                                                    </label>
                                                                    <!-- Input text title-->
                                                                    {!! Form::text('code_hex'.$i, null, ['class' => 'form-control', 'placeholder' => '00000'])
                                                                    !!}
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
            <input type="hidden" name="events_custom_id" value="{{$events_custom->id}}">
            <input type="hidden" name="events_product_id" value="{{$events_product->id}}">
            <input type="hidden" name="actual_title" value="{{$events_product->title}}">
            <input type="hidden" id="countJS" value="{{$i}}">
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

{{-- Add color modal --}}
<div class="modal fade" id="addColorModal" tabindex="-1" role="dialog" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ajouter une variante</h2>
                @if (session('status'))
                    <div class="alert alert-success mt-1 mb-2">
                        {{ session('status') }}
                    </div>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Vous pouvez une couleur et son code hex.</p>
                {!! Form::open(['id' => 'AddColor', 'files' => true, 'class' => 'mt-5']) !!}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="events_custom_id" id="events_custom_id" value="{{$events_custom->id}}">
                <div class="form-group">
                    <label>
                        Couleur
                    </label>
                    {{ Form::text('color', null, array('class' => 'form-control mb-3','id' => 'ep_color')) }}
                </div>
                <div class="form-group">
                    <label>
                        Code hex
                    </label>
                    {{ Form::text('code_hex', null, array('class' => 'form-control mb-3','id' => 'ep_code_hex')) }}
                </div>
                <div id="idTP">
                </div>

            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalAddColor')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modalAddColor">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div> {{-- /modal --}}

@section('javascripts')
<script type="text/Javascript">
        $('.buttonColor').on('click', function(e) {
        var id = $(this).attr('data-id');
        $('#idTP').html('<input type="hidden" name="tp_id" id="tp_id" value="'+id+'">');
    });
</script>
@endsection