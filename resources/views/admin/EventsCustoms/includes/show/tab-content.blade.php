<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Nom de la personnalisation
                        </label>
                        {!! Form::text('title', $events_custom->title, [
                        'class' => 'form-control',
                        'placeholder' => ''
                        ]) !!}
                    </div>
                    <input type="hidden" name="actual_title" value="{{$events_custom->title}}">
                    <div class="form-group">
                        <label>Description de l'événement</label>
                        <input id="textDescription" type="textarea" class="description" name="description" rows="3"
                            value="{{$events_custom->description}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="custom-control custom-switch">
                                        <input name="is_active" type="checkbox" class="custom-control-input"
                                            id="isActive" value="{{ $events_custom->is_active }}">
                                        <label class="custom-control-label" for="isActive">Ce composant est-il actif
                                            ?</label>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    Couleur du produit : {{ ucfirst($events_custom->products_variant_color) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($events_custom->imageUrl) && $disk->exists($events_custom->imageUrl))
            <div class="card">
                <div class="card-body">
                    <img width="100%" title="image principale" class="" src="{{$s3 . $events_custom->imageUrl}}"
                        alt="Image personnalisation">
                    <div class="form-group">
                        <hr>
                        <label for="custom_img">Modifiez l'image</label>
                        {!! Form::file('custom_img', [
                        'class' => 'form-control',
                        'id' =>'photo_profile'
                        ]) !!}
                    </div>
                </div>
            </div>
            @else
            <div class="card card-inactive">
                <div class="card-body text-center">
                    <p class="text-muted">
                        Pas d'image de personnalisation
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<?php 
    $i=0; 
    $arrayEventsComponentsIds = array();
?>
@foreach($events_custom->components as $component)
<?php 
    $i++; 
    array_push($arrayEventsComponentsIds, $component['events_component_id']);
?>
<input type="hidden" name="{{'template_component_id'.$i}}" value="{{$component['events_component_id']}}">
<input type="hidden" name="{{'comp_type_'.$component['events_component_id']}}" value="{{$component['type']}}">
<input type="hidden" name="countJS" id="countJS" value="{{$i}}">
<div class="tab-pane fade show" id="template_component_{{$component['events_component_id']}}" role="tabpanel"
    aria-labelledby="template_component_{{$component['events_component_id']}}-tab">
    <div class="row">
        <div class="col-8">
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
                                {!! Form::text('option_title'.$i, $component['title'], [
                                'class' => 'form-control',
                                'placeholder' => 'Entrer le nom'
                                ]) !!}
                            </div>
                            <div class="col-12">
                                <small class="text-muted">Vous pouvez changer le nom de ce composant pour cette
                                    personnalisation.</small>
                            </div>
                        </div>
                    </div>
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
                                            <div class="form-group">
                                                <label>
                                                    Largeur (mm)
                                                </label>
                                                <?php // dd($component['settings']['position']['width']) ?>
                                                {!! Form::number('width'.$i,
                                                $component['settings']['position']['width'],[
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'step' => 'any'
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Hauteur (mm)
                                                </label>
                                                {!! Form::number('height'.$i,
                                                $component['settings']['position']['height'], [
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'step' => 'any'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($component['type'] == 'input')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-header-title">
                                        Polices de caractères
                                    </h4>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="buttonFont btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addFontModal" data-id="{{$component['events_component_id']}}">
                                        +
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="buttonFont btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#selectFontModal" data-id="{{$component['events_component_id']}}">
                                        Sélectionnez une police
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
                                                            </a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list"
                                                    id="{{'font_name_list'.$component['events_component_id']}}">
                                                    <?php 
                                                        $array_font_title = array();
                                                        $array_font_transform = array();
                                                        $array_font_url = array();
                                                        $array_font_weight = array();
                                                        $array_font_file_name = array();
                                                        $array_font_id = array();
                                                        ?>
                                                    @foreach($component['settings']['fonts'] as $font)
                                                    <?php 
                                                        array_push($array_font_title, $font['title']);
                                                        array_push($array_font_transform, $font['font_transform']);
                                                        array_push($array_font_url, $font['font_url']);
                                                        array_push($array_font_weight, $font['font_weight']);
                                                        array_push($array_font_file_name, $font['font_file_name']);
                                                        array_push($array_font_id, $font['font_id']);
                                                    ?>
                                                    <tr>
                                                        <td class="font-name">
                                                            {{$font['title']}}
                                                        </td>
                                                        <td>
                                                            <a style="float:right"
                                                                data-id="{{$component['events_component_id']}}"
                                                                data-font_id="{{$font['font_id']}}"
                                                                data-title="{{$font['title']}}"
                                                                onclick="var id=$(this).attr('data-id');var font_id=$(this).attr('data-font_id');var font=$(this).attr('data-title');deleteShowFontRow(id,font,font_id);$(this).closest('tr').remove();">
                                                                Supprimer
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <?php 
                                                        $str_font_title = implode(',', array_filter($array_font_title));
                                                        $str_font_transform = implode(',', array_filter($array_font_transform));
                                                        $str_font_url = implode(',', array_filter($array_font_url));
                                                        $str_font_weight = implode(',', array_filter($array_font_weight));
                                                        $str_font_file_name = implode(',', array_filter($array_font_file_name));
                                                        $str_font_id = implode(',',array_filter($array_font_id));
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{'newsFonts'.$component['events_component_id']}}">
                                    <input type="hidden" name="{{'fontsList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsList'.$component['events_component_id']}}"
                                        value="{{$str_font_title}}">
                                    <input type="hidden"
                                        name="{{'fontsFileNameList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsFileNameList'.$component['events_component_id']}}"
                                        value="{{$str_font_file_name}}">
                                    <input type="hidden"
                                        name="{{'font_urlList'.$component['events_component_id'].'[]'}}"
                                        id="{{'font_urlList'.$component['events_component_id']}}"
                                        value="{{$str_font_url}}">
                                    <input type="hidden"
                                        name="{{'fontsWeightList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsWeightList'.$component['events_component_id']}}"
                                        value="{{$str_font_weight}}">
                                    <input type="hidden"
                                        name="{{'fontsTransformList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsTransformList'.$component['events_component_id']}}"
                                        value="{{$str_font_transform}}">
                                    <input type="hidden"
                                        name="{{'fontsIdsList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsIdsList'.$component['events_component_id']}}"
                                        value="{{$str_font_id}}">
                                </div>
                                <div id="fontsToDelete">
                                    <input type="hidden"
                                        name="{{'fontsToDeleteList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsToDeleteList'.$component['events_component_id']}}">
                                    <input type="hidden"
                                        name="{{'fontsIdsToDeleteList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsIdsToDeleteList'.$component['events_component_id']}}">
                                    <input type="hidden"
                                        name="{{'fontsWeightsToDeleteList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsWeightsToDeleteList'.$component['events_component_id']}}">
                                    <input type="hidden"
                                        name="{{'fontsTransformToDeleteList'.$component['events_component_id'].'[]'}}"
                                        id="{{'fontsTransformToDeleteList'.$component['events_component_id']}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="text-muted">
                                    <small>
                                        Vous pouvez ajouter ou supprimer des polices à la liste.
                                    </small>
                                </p>
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
                                    <a href="#" class="buttonColor btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addColorModal" data-id="{{$component['events_component_id']}}">
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
                                                        <th></th>
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
                                                <tbody class="list"
                                                    id="{{'color_name_list'.$component['events_component_id']}}">
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
                                                        <td>
                                                            <div class="colorSquare"
                                                                style="background:#{{$font_color['code_hexa']}};">
                                                            </div>
                                                        </td>
                                                        <td class="color-name">
                                                            {{$font_color['title']}}
                                                        </td>
                                                        <td class="color-code_hex">
                                                            {{$font_color['code_hexa']}}
                                                        </td>
                                                        <td>
                                                            <a data-id="{{$component['events_component_id']}}"
                                                                data-title="{{$font_color['title']}}"
                                                                data-hexa="{{$font_color['code_hexa']}}"
                                                                style="float:right"
                                                                onclick="var id=$(this).attr('data-id');var hexa=$(this).attr('data-hexa');var color=$(this).attr('data-title');deleteShowColorRow(id, color);deleteShowHexaRow(id, hexa);$(this).closest('tr').remove();">
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
                                            <input type="hidden"
                                                name="{{'colorsList'.$component['events_component_id'].'[]'}}"
                                                id="{{'colorsList'.$component['events_component_id']}}"
                                                value="{{$str_color}}">
                                            <input type="hidden"
                                                name="{{'hexaList'.$component['events_component_id'].'[]'}}"
                                                id="{{'hexaList'.$component['events_component_id']}}"
                                                value="{{$str_hexa}}">
                                        </div>
                                        <div id="colorsToDelete">
                                            <input type="hidden"
                                                name="{{'colorsToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'colorsToDeleteList'.$component['events_component_id']}}">
                                            <input type="hidden"
                                                name="{{'hexasToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'hexasToDeleteList'.$component['events_component_id']}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted">Vous pouvez ajouter ou supprimer des couleurs de
                                            polices à la liste.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Highlight color --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-header-title">
                                        SMODE : Couleurs de police & background
                                    </h4>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="buttonColor btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addColorSmodeModal"
                                        data-id="{{$component['events_component_id']}}">
                                        Ajoutez une couleur
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div id="smodeColorTable" class="card mt-2" data-toggle="lists"
                                        data-lists-values='["smode-color-name", "smode-color-code_hex"]'>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-nowrap card-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>
                                                            <a href="#" class="text-muted" data-sort="smode-color-name">
                                                                Couleur police
                                                            </a>
                                                        </th>
                                                        <th></th>
                                                        <th>
                                                            <a href="#" class="text-muted"
                                                                data-sort="smode-color-code_hex">
                                                                Couleur de fond
                                                            </a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody class="list"
                                                    id="{{'smode_color_name_list'.$component['events_component_id']}}">
                                                    <?php 
                                                        $array_font_color = array();
                                                        $array_font_hexa = array();
                                                        $array_font_bg_color = array();
                                                        $array_font_bg_hexa = array();
                                                    ?>
                                                    @if(isset($component['settings']['smode_colors']))
                                                    @foreach($component['settings']['smode_colors'] as $font_color)
                                                    <?php 
                                                        array_push($array_font_color, $font_color['title']);
                                                        array_push($array_font_hexa, $font_color['code_hexa']);
                                                        array_push($array_font_bg_color, $font_color['bg_title']);
                                                        array_push($array_font_bg_hexa, $font_color['bg_code_hexa']);
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="colorSquare"
                                                                style="background:#{{$font_color['code_hexa']}};">
                                                            </div>
                                                        </td>
                                                        <td class="color-name">
                                                            {{$font_color['title']}}
                                                        </td>
                                                        <td>
                                                            <div class="colorSquare"
                                                                style="background:#{{$font_color['bg_code_hexa']}};">
                                                            </div>
                                                        </td>
                                                        <td class="color-code_hex">
                                                            {{$font_color['bg_title']}}
                                                        </td>
                                                        <td>
                                                            <a data-id="{{$component['events_component_id']}}"
                                                                data-title="{{$font_color['title']}}"
                                                                data-bg_hexa="{{$font_color['bg_code_hexa']}}"
                                                                data-code_hex="{{$font_color['code_hexa']}}"
                                                                data-bg_color="{{$font_color['bg_title']}}"
                                                                style="float:right"
                                                                onclick="var id=$(this).attr('data-id');var code_hex=$(this).attr('data-code_hex');var color=$(this).attr('data-title');var bg_color=$(this).attr('data-bg_color');var bg_hexa=$(this).attr('data-bg_hexa');deleteShowSmodeColorRow(id, color);deleteShowSmodeHexaRow(id, code_hex);deleteShowSmodeBgColorRow(id, bg_color);deleteShowSmodeBgHexaRow(id, bg_hexa);$(this).closest('tr').remove();">
                                                                Supprimer
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    <?php 
                                                        $str_color = implode(',',$array_font_color);
                                                        $str_hexa = implode(',',$array_font_hexa);
                                                        $str_bg_color = implode(',',$array_font_bg_color);
                                                        $str_bg_hexa = implode(',',$array_font_bg_hexa);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="newsColors">
                                            <input type="hidden"
                                                name="{{'smodeColorsList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeColorsList'.$component['events_component_id']}}"
                                                value="{{$str_color}}">
                                            <input type="hidden"
                                                name="{{'smodeHexaList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeHexaList'.$component['events_component_id']}}"
                                                value="{{$str_hexa}}">
                                            <input type="hidden"
                                                name="{{'smodeBgColorsList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeBgColorsList'.$component['events_component_id']}}"
                                                value="{{$str_bg_color}}">
                                            <input type="hidden"
                                                name="{{'smodeBgHexaList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeBgHexaList'.$component['events_component_id']}}"
                                                value="{{$str_bg_hexa}}">
                                        </div>
                                        <div id="colorsToDelete">
                                            <input type="hidden"
                                                name="{{'smodeColorsToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeColorsToDeleteList'.$component['events_component_id']}}">
                                            <input type="hidden"
                                                name="{{'smodeHexasToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeHexasToDeleteList'.$component['events_component_id']}}">
                                            <input type="hidden"
                                                name="{{'smodeBgColorsToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeBgColorsToDeleteList'.$component['events_component_id']}}">
                                            <input type="hidden"
                                                name="{{'smodeBgHexasToDeleteList'.$component['events_component_id'].'[]'}}"
                                                id="{{'smodeBgHexasToDeleteList'.$component['events_component_id']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="text-muted">Vous pouvez ajouter ou supprimer des couleurs de police et de
                                        fond pour cette personnalisation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($component['type'] == 'image')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header-title">
                                        Configuration
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="custom-control custom-switch">
                                                @if($component['settings']['position']['fullwidth'])
                                                <input name="{{'fullwidth'.$component['events_component_id']}}"
                                                    type="checkbox" class="" id="{{'fullwidth'}}" value="true" checked>
                                                @else
                                                <input name="{{'fullwidth'.$component['events_component_id']}}"
                                                    type="checkbox" class="" id="{{'fullwidth'}}" value="true">
                                                @endif
                                                <label>Ce composant est-il sur toute la largeur ?</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Alignement
                                                </label>
                                                <div class="form-group">
                                                    @if($component['settings']['position']['align'] == 'center')
                                                    <select name="{{'align'.$component['events_component_id']}}"
                                                        id="align" class="form-control" data-toggle="select">
                                                        <option value="center" selected>Centré</option>
                                                        <option value="right">Droite</option>
                                                        <option value="left">Gauche</option>
                                                        <option value="false">Aucun</option>
                                                    </select>
                                                    @elseif($component['settings']['position']['align'] == 'right')
                                                    <select name="{{'align'.$component['events_component_id']}}"
                                                        id="align" class="form-control" data-toggle="select">
                                                        <option value="center">Centré</option>
                                                        <option value="right" selected>Droite</option>
                                                        <option value="left">Gauche</option>
                                                        <option value="false">Aucun</option>
                                                    </select>
                                                    @elseif($component['settings']['position']['align'] == 'left')
                                                    <select name="{{'align'.$component['events_component_id']}}"
                                                        id="align" class="form-control" data-toggle="select">
                                                        <option value="center">Centré</option>
                                                        <option value="right">Droite</option>
                                                        <option value="left" selected>Gauche</option>
                                                        <option value="false">Aucun</option>
                                                    </select>
                                                    @else
                                                    <select name="{{'align'.$component['events_component_id']}}"
                                                        id="align" class="form-control" data-toggle="select">
                                                        <option value="center">Centré</option>
                                                        <option value="right">Droite</option>
                                                        <option value="left">Gauche</option>
                                                        <option value="false" selected>Aucun</option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Image du composant
                                <p class="mt-2"><small class="text-muted">Modifiez ici l'image du composant.</small></p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="photo_profile">Modifiez l'image</label>
                                {!! Form::file('comp_image'.$component['events_component_id'], [
                                'class' => 'form-control',
                                'id' =>'photo_profile'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Composant de type : {{ $component['type'] }}
                        </div>
                    </div>
                </div>
            </div>
            @if($component['type'] == 'input')
            <div class="card">
                <div class="card-header">
                    <b>Nombre de caractères</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Minimum</label>
                                {!! Form::number('min'.$i,$component['settings']['input_min'],[
                                'class' => 'form-control',
                                'placeholder' => '1'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Maximum</label>
                                {!! Form::number('max'.$i, $component['settings']['input_max'],[
                                'class' => 'form-control',
                                'placeholder' => '99'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                                    <div class="form-group">
                                        <label>
                                            X (mm)
                                        </label>
                                        {!! Form::number('origin_x'.$i, $component['settings']['position']['x'],
                                        ['class' => 'form-control',
                                        'placeholder' =>'0',
                                        'step' => 'any'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Y (mm)
                                        </label>
                                        {!! Form::number('origin_y'.$i, $component['settings']['position']['y'],
                                        ['class' => 'form-control',
                                        'placeholder' => '0',
                                        'step' => 'any'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($component['type'] == 'input')
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
                                    <div class="form-group">
                                        {!! Form::text('font_first_letter'.$i,
                                        $component['settings']['font_first_letter'], [
                                        'class' => 'form-control',
                                        'placeholder' => '#'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($component['type'] == 'image')
            @if(!empty($component['settings']['display_img_url']) &&
            $disk->exists($component['settings']['display_img_url']))
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Image du composant
                    </h4>
                </div>
                <div class="card-body">
                    <img width="100%" title="Image du composant" class=""
                        src="{{$s3 . $component['settings']['display_img_url']}}" alt="Image personnalisation">
                </div>
            </div>
            @else
            <div class="card card-inactive">
                <div class="card-body text-center">
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
<input type="hidden" name="arrayEventsComponentsIds[]" value="{{ json_encode($arrayEventsComponentsIds) }}"
    id="arrayEventsComponentsIds">