<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Nom de la personnalisation
                        </label>
                        {!! Form::text('title', $events_custom->title, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        <label>Description de l'événement</label>
                        <input id="textDescription" type="textarea" class="description" name="description" rows="3" value="{{$events_custom->description}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            {{-- Image --}}
            @if(!empty($events_custom->image) && $disk->exists($events_custom->image))
            <div class="card">
                <div class="card-body">
                    <img width="100%" title="image principale" class="" src="{{$s3 . $events_custom->image}}"
                        alt="Image personnalisation">
                </div>
            </div>
            @else
            <div class="card card-inactive">
                <div class="card-body text-center">
                    <!-- Title -->
                    <p class="text-muted">
                        Pas d'image de personnalisation
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<?php $i=0; ?>
@foreach($events_custom->components as $component)
            <?php $i++; ?>
            <input type="hidden" name="{{'template_component_id'.$i}}" value="{{$component['events_component_id']}}">
            <input type="hidden" name="{{'comp_type_'.$component['events_component_id']}}" value="{{$component['component_type']}}">
            {{-- <input type="hidden" name="tp_id" id="tp_id" value="{{$component['events_component_id']}}"> --}}
            <input type="hidden" name="countJS" id="countJS" value="{{$i}}">
            <div class="tab-pane fade show" id="template_component_{{$component['events_component_id']}}" role="tabpanel"
                aria-labelledby="template_component_{{$component['events_component_id']}}-tab">
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
                                            {!! Form::text('option_title'.$i, $component['title'], ['class' => 'form-control','placeholder' => 'Entrer le nom']) !!}
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
                                                            {!! Form::number('width'.$i, $component['settings']['position']['width'],
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
                                                            {!! Form::number('height'.$i, $component['settings']['position']['height'],
                                                            ['class' => 'form-control', 'placeholder' => '', 'step' => 'any']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($component['component_type'] == 'input')
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
                                                    data-id="{{$component['events_component_id']}}">
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
                                                                            {{-- Nom --}}
                                                                        </a>
                                                                    </th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                    
                                                            <tbody class="list" id="{{'font_name_list'.$component['events_component_id']}}">
                                                                    <?php 
                                                                    $array_font_title = array();
                                                                    $array_font_url = array();
                                                                    ?>
                                                                    @foreach($component['settings']['fonts'] as $font)
                                                                        <?php 
                                                                            array_push($array_font_title, $font['title']);
                                                                            array_push($array_font_url, $font['font_url']);
                                                                        ?>
                                                                        <tr>
                                                                            <td class="font-name">
                                                                                {{$font['title']}}
                                                                            </td>
                                                                            <td>
                                                                                <a style="float:right" data-title="{{$font['title']}}" data-id="{{$component['events_component_id']}}" onclick="var id=$(this).attr('data-id');var font=$(this).attr('data-title');deleteFontRow(id, font);$(this).closest('tr').remove();">
                                                                                    Supprimer 
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <?php 
                                                                        $str_font_title = implode(',',$array_font_title);
                                                                        $str_font_url = implode(',',$array_font_url);
                                                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="{{'newsFonts'.$component['events_component_id']}}">
                                                <input type="hidden" name="{{'fontsList'.$component['events_component_id'].'[]'}}" id="{{'fontsList'.$component['events_component_id']}}" > {{-- removed value="Roboto-Black" --}}
                                                <input type="hidden" name="{{'font_urlList'.$component['events_component_id'].'[]'}}" id="{{'font_urlList'.$component['events_component_id']}}" > {{-- removed value="/events/Roboto-Black.ttf" --}}
                                                <input type="hidden" name="{{'fontsWeightList'.$component['events_component_id'].'[]'}}" id="{{'fontsWeightList'.$component['events_component_id']}}"> {{-- font_weight --}}
                                                <input type="hidden" name="{{'fontsTransformList'.$component['events_component_id'].'[]'}}" id="{{'fontsTransformList'.$component['events_component_id']}}"> {{-- font_transform --}}
                                                {{-- <input type="hidden" name="{{'url'.$component['events_component_id'].'[]'}}" id="{{'url'.$component['events_component_id']}}" value="Roboto-Black"> --}}
                                            </div>
                                            <div id="fontsToDelete">
                                                <input type="hidden" name="{{'fontsToDeleteList'.$component['events_component_id'].'[]'}}" id="{{'fontsToDeleteList'.$component['events_component_id']}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-muted">Vous pouvez ajouter ou supprimier des polices à la liste.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="card-header-title">
                                                Couleurs de la police
                                                </h4>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="buttonColor btn btn-sm btn-primary"
                                                    data-toggle="modal" data-target="#addColorModal"
                                                    data-id="{{$component['events_component_id']}}">
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
                                    
                                                            <tbody class="list" id="{{'color_name_list'.$component['events_component_id']}}">
                                                                <?php 
                                                                $array_font_color = array();
                                                                $array_font_hexa = array();
                                                                ?>
                                                                @foreach($component['settings']['font_colors'] as $font_color)
                                                                    <?php 
                                                                        array_push($array_font_color, $font_color['title']);
                                                                        array_push($array_font_hexa, $font_color['code_hexa']);
                                                                    ?>
                                                                    <tr>
                                                                        <td class="color-name">
                                                                            {{$font_color['title']}}
                                                                        </td>
                                                                        <td class="color-code_hex">
                                                                            {{$font_color['code_hexa']}}
                                                                        </td>
                                                                        <td>
                                                                            <a data-id="{{$component['events_component_id']}}" data-title="{{$font_color['title']}}" data-hexa="{{$font_color['code_hexa']}}" style="float:right" onclick="var id=$(this).attr('data-id');var hexa=$(this).attr('data-hexa');var color=$(this).attr('data-title');deleteColorRow(id, color);deleteHexaRow(id, hexa);$(this).closest('tr').remove();">
                                                                                Supprimer 
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <?php 
                                                                    $str_color = implode(',',$array_font_color);
                                                                    $str_hexa = implode(',',$array_font_hexa);
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="newsColors">
                                                        <input type="hidden" name="{{'colorsList'.$component['events_component_id'].'[]'}}" id="{{'colorsList'.$component['events_component_id']}}" value="{{$str_color}}"> {{-- value="Black" --}}
                                                        <input type="hidden" name="{{'hexaList'.$component['events_component_id'].'[]'}}" id="{{'hexaList'.$component['events_component_id']}}" value="{{$str_hexa}}"> {{-- value="000000" --}}
                                                    </div>
                                                    <div id="colorsToDelete">
                                                        <input type="hidden" name="{{'colorsToDeleteList'.$component['events_component_id'].'[]'}}" id="{{'colorsToDeleteList'.$component['events_component_id']}}">
                                                        <input type="hidden" name="{{'hexasToDeleteList'.$component['events_component_id'].'[]'}}" id="{{'hexasToDeleteList'.$component['events_component_id']}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-muted">Vous pouvez ajouter ou supprimer des couleurs de polices à la liste.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($component['component_type'] == 'image')
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
                                                    <label class="custom-file-label" for="photo_profile">Modifiez l'image</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <p class="text-muted">Modifiez ici l'image du composant.</p>
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
                                        Composant de type : {{ $component['component_type'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($component['component_type'] == 'input')
                        <div class="card">
                            <div class="card-header">
                                <b>Nombre de caractères</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Minimum</label>
                                            {!! Form::number('min'.$i,$component['settings']['input_min'],['class' =>
                                            'form-control', 'placeholder' => '1']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Maximum</label>
                                            {!! Form::number('max'.$i, $component['settings']['input_max'],['class' =>
                                            'form-control', 'placeholder' => '99']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
                                                    {!! Form::number('origin_x'.$i, $component['settings']['position']['origin_x'], ['class' =>
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
                                                    {!! Form::number('origin_y'.$i, $component['settings']['position']['origin_y'], ['class' =>
                                                    'form-control', 'placeholder' => '0', 'step' => 'any']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($component['component_type'] == 'input')
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
                                                    {!! Form::text('font_first_letter'.$i, $component['settings']['font_first_letter'], ['class' => 'form-control', 'placeholder' => '#']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($component['component_type'] == 'image')
                            {{-- Image --}}
                            @if(!empty($component['settings']['image_url']) && $disk->exists($component['settings']['image_url']))
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">
                                        Image du composant
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <img width="100%" title="Image du composant" class="" src="{{$s3 . $component['settings']['image_url']}}"
                                        alt="Image personnalisation">
                                </div>
                            </div>
                            @else
                            <div class="card card-inactive">
                                <div class="card-body text-center">
                                    <!-- Title -->
                                    <p class="text-muted">
                                        Pas d'image de personnalisation
                                    </p>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
    @endforeach














