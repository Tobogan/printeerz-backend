<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label>
                    Nom de la personnalisation
                </label>
                {!! Form::text('title', $events_custom->title, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
        </div>
        <div class="col-4">
            Image
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Description de l'événement</label>
                <input id="textDescription" type="textarea" class="description" name="description" rows="3">
            </div>
        </div>
    </div>
</div>
<?php $i=1;?>
@foreach($templates as $template)
    <?php $array_template = $events_custom->template ?>
    @if($template->id == reset($array_template))
        @foreach($template_components as $template_component)
            @foreach($template->components_ids as $component_id)
                @if($template_component->id == $component_id['id'])
                <?php $name = $component_id['name']; ?>
                    <input type="hidden" name="{{'template_component_id'.$i}}" value="{{$template_component->id}}">
                    <input type="hidden" name="{{'comp_type_'.$i}}" value="{{$template_component->comp_type}}">
                    <input type="hidden" name="{{$name}}" id="{{$name}}" value="{{$i}}">
                    <?php  ?>
                    <div class="tab-pane fade show" id="template_component_{{$template_component->id}}" role="tabpanel"
                        aria-labelledby="template_component_{{$template_component->id}}-tab">
                        {{-- Store template_composant id --}}
                        <div class="row">
                            <div class="col-8">
                                {{-- Custom option --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-header-title">
                                                    Nom du composant
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <!-- Input -->
                                                    {!! Form::text('option_title'.$i, $name, ['class' => 'form-control','placeholder' => 'Entrer le nom']) !!}
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-muted">Vous pouvez changer le nom de ce composant pour cette personnalisation.</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Custom size --}}
                                        <div class="row">
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
                                                                        Largeur (mm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('width'.$i, $template_component->size["width"],
                                                                    ['class' => 'form-control', 'placeholder' => '', 'step' => 'any']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Label -->
                                                                    <label>
                                                                        Hauteur (mm)
                                                                    </label>
                                                                    <!-- Input -->
                                                                    {!! Form::number('height'.$i, $template_component->size["height"],
                                                                    ['class' => 'form-control', 'placeholder' => '', 'step' => 'any']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-muted">La taille par défault est de {{$template_component->size["width"]}} x {{$template_component->size["height"]}} mm</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($template_component->comp_type == 'input')
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-header-title">
                                                        Polices de caractères
                                                        </h4>
                                                    </div>
                                                    <div class="col-auto">
                                                            <a href="#" style="float:right" class="buttonFont btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#addFontModal"
                                                            data-id="{{$template_component->id}}">
                                                            Ajouter une police
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div id="fontTable" class="card mt-2" data-toggle="lists"
                                                        data-lists-values='["font-name"]'>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-nowrap card-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <a href="#" class="text-muted" data-sort="font-name">
                                                                                    Nom
                                                                                </a>
                                                                            </th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                            
                                                                    <tbody class="list" id="{{'font_name_list'.$i}}">
                                                                        <tr>
                                                                            <td class="font-name">
                                                                                Roboto-Black
                                                                            </td>
                                                                            <td>
                                                                                <a class="fontsDeleteRow" style="float:right" onclick="var font='Roboto-Black';deleteFontRow(font);$(this).closest('tr').remove();">Supprimer</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="{{'newsFonts'.$i}}">
                                                        <input type="hidden" name="{{'fontsList'.$i.'[]'}}" id="{{'fontsList'.$i}}" value="Roboto-Black">
                                                        <input type="hidden" name="{{'font_urlList'.$i.'[]'}}" id="{{'font_urlList'.$i}}" value="/events/Roboto-Black.ttf">
                                                        <input type="hidden" name="{{'url_'.$i.'[]'}}" id="{{'url_'.$i}}" value="Roboto-Black.ttf">
                                                        <input type="hidden" name="tp_id_font" id="tp_id_font" value="{{$template_component->id}}">

                                                    </div>
                                                    <div id="fontsToDelete">
                                                        <input type="hidden" name="{{'fontsToDeleteList'.$i.'[]'}}" id="{{'fontsToDeleteList'.$i}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-muted">Vous pouvez ajouter de nouvelles polices pour cet événement.</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Font_weight --}}
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Epaisseur
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Input -->
                                                                    <select name="{{'font_weight'.$i}}" id="font_weight" class="form-control"
                                                                    data-toggle="select">
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
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Transformation font --}}
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-header-title">
                                                            Transformation
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <!-- First name -->
                                                                <div class="form-group">
                                                                    <!-- Input -->
                                                                    <select name="{{'font_transform'.$i}}" id="font_transform"
                                                                        class="form-control" data-toggle="select">
                                                                        <option value="none">Aucune</option>
                                                                        <option value="uppercase">Tout en Majuscules</option>
                                                                        <option value="capitalize">Première lettre en Majuscule</option>
                                                                        <option value="lowercase">Tout en minuscule</option>
                                                                        <option value="full-width">Pleine largeur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-header-title">
                                                        Couleurs de la police yo
                                                        </h4>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="buttonColor btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#addColorModal"
                                                            data-id="{{$template_component->id}}">
                                                            Ajouter une couleur
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">    
                                                    <div class="col-12">
                                                        <div id="colorTable" class="card mt-2" data-toggle="lists"
                                                        data-lists-values='["color-name", "color-code_hex"]'>
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-nowrap card-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <a href="#" class="text-muted" data-sort="color-name">
                                                                                    Nom
                                                                                </a>
                                                                            </th>
                                                                            <th>
                                                                                <a href="#" class="text-muted" data-sort="color-code_hex">
                                                                                    Code hexa
                                                                                </a>
                                                                            </th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                            
                                                                    <tbody class="list" id="{{'color_name_list'.$i}}">
                                                                        <tr>
                                                                            <td class="color-name">
                                                                                Black
                                                                            </td>
                                                                            <td class="color-code_hex">
                                                                                000000
                                                                            </td>
                                                                            <td>
                                                                                <a class="colorsDeleteRow" data-color="Black" style="float:right" onclick="var color='Black';var hexa='000000';deleteColorRow(color);deleteHexaRow(hexa);$(this).closest('tr').remove();">
                                                                                    Supprimer 
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div id="newsColors">
                                                                <input type="hidden" name="{{'colorsList'.$i.'[]'}}" id="{{'colorsList'.$i}}" value="Black">
                                                                <input type="hidden" name="{{'hexaList'.$i.'[]'}}" id="{{'hexaList'.$i}}" value="000000">
                                                            </div>
                                                            <div id="colorsToDelete">
                                                                <input type="hidden" name="{{'colorsToDeleteList'.$i.'[]'}}" id="{{'colorsToDeleteList'.$i}}">
                                                                <input type="hidden" name="{{'hexasToDeleteList'.$i.'[]'}}" id="{{'hexasToDeleteList'.$i}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($template_component->comp_type == 'image')
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-header-title">
                                                        Image du composant
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            {!! Form::file('comp_image'.$i, array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
                                                            <label class="custom-file-label" for="photo_profile">Ajouter l'image</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <p class="text-muted">Ajoutez ici l'image correspondant à ce composant.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif {{-- Component type condition --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                Composant de type : {{ $template_component->comp_type }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <b>Nombre de caractères</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Minimum</label>
                                                    {!! Form::number('min'.$i, $template_component->characters["min"],['class' =>
                                                    'form-control', 'placeholder' => '1']) !!}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Maximum</label>
                                                    {!! Form::number('max'.$i, $template_component->characters["max"],['class' =>
                                                    'form-control', 'placeholder' => '99']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Custom position --}}
                                <div class="row">
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
                                                                X (mm)
                                                            </label>
                                                            <!-- Input -->
                                                            {!! Form::number('origin_x'.$i, $template_component->origin["x"], ['class' =>
                                                            'form-control', 'placeholder' =>'0', 'step' => 'any']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <!-- First name -->
                                                        <div class="form-group">
                                                            <!-- Label -->
                                                            <label>
                                                                Y (mm)
                                                            </label>
                                                            <!-- Input -->
                                                            {!! Form::number('origin_y'.$i, $template_component->origin["y"], ['class' =>
                                                            'form-control', 'placeholder' => '0', 'step' => 'any']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($template_component->comp_type == 'input')
                                {{-- First letter --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-header-title">
                                                    Première lettre ou symbole avant le texte
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- First name -->
                                                        <div class="form-group">
                                                            <!-- Input -->
                                                            {!! Form::text('font_first_letter'.$i, $template_component->font["first_letter"], ['class' => 'form-control', 'placeholder' => '#']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    @endif
@endforeach
