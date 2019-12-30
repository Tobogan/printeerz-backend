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
                        'class' => 'form-control' . $errors->first('title', ' is-invalid')
                        ]) !!}
                        @if($errors->has('title'))<div class="invalid-feedback">Nom de police incorrect.</div>@endif
                    </div>
                    <div class="form-group">
                        <label>Description de la personnalisation</label>
                        {!! Form::textarea('description', null, [
                        'id' => 'description',
                        'class' => 'form-control',
                        'rows' => 4,
                        'cols' => 54,
                        'maxlength' => '750'
                        ]) !!}
                        {!! $errors->first('description', '<p class="help-block mt-2" style="color:red;">
                            <small>:message</small>
                        </p>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            {{-- IsActive part link to an input hidden --}}
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
            {{-- Custom color --}}
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
            {{-- Image --}}
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
                    <!-- No image -->
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
@foreach($events_components as $events_component)
@if($events_component->events_custom_id == $events_custom->id)
<?php 
    $i++;
    array_push($arrayEventsComponentsIds, $events_component->id);
?>
<input type="hidden" name="{{'template_component_id'.$i}}" value="{{$events_component->id}}">
<input type="hidden" name="{{'comp_type_'.$i}}" id="{{'comp_type_'.$i}}" value="{{$events_component->type}}">
<input type="hidden" name="countJS" id="countJS" value="{{$i}}">
<div class="tab-pane fade show" id="template_component_{{$events_component->id}}" role="tabpanel"
    aria-labelledby="template_component_{{$events_component->id}}-tab">
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
                                {!! Form::text('option_title'.$i, $events_component->title, [
                                'class' => 'form-control',
                                ]) !!}
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
                                                {!! Form::number('width'.$i, $events_component->width, [
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
                                                {!! Form::number('height'.$i, $events_component->height,[
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'step' => 'any'
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-muted">
                                                La taille par défault est de {{$events_component->width}} x
                                                {{$events_component->height}} mm
                                            </p>
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
                                        Alignement du composant
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    X
                                                </label>
                                                {!! Form::text('alignX'.$events_component->id, null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'left',
                                                'step' => 'any'
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Y
                                                </label>
                                                {!! Form::text('alignY'.$events_component->id, null,[
                                                'class' => 'form-control',
                                                'placeholder' => 'top',
                                                'step' => 'any'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($events_component->type == 'input')
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
                                        data-target="#addFontModal" data-id="{{$events_component->id}}">
                                        +
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="buttonFont btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#selectFontModal" data-id="{{$events_component->id}}">
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
                                                        <th><a href="#" class="text-muted" data-sort="font-name"></a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="{{'font_name_list'.$events_component->id}}">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{'newsFonts'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsList'.$events_component->id.'[]'}}"
                                        id="{{'fontsList'.$events_component->id}}">
                                    <input type="hidden" name="{{'font_urlList'.$events_component->id.'[]'}}"
                                        id="{{'font_urlList'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsFileNameList'.$events_component->id.'[]'}}"
                                        id="{{'fontsFileNameList'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsWeightList'.$events_component->id.'[]'}}"
                                        id="{{'fontsWeightList'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsTransformList'.$events_component->id.'[]'}}"
                                        id="{{'fontsTransformList'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsIdsList'.$events_component->id.'[]'}}"
                                        id="{{'fontsIdsList'.$events_component->id}}">
                                </div>
                                <div id="{{'fontsToDelete'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsToDeleteList'.$events_component->id.'[]'}}"
                                        id="{{'fontsToDeleteList'.$events_component->id}}">
                                    <input type="hidden" name="{{'fontsIdsToDeleteList'.$events_component->id.'[]'}}"
                                        id="{{'fontsIdsToDeleteList'.$events_component->id}}">
                                    <input type="hidden"
                                        name="{{'fontsWeightsToDeleteList'.$events_component->id.'[]'}}"
                                        id="{{'fontsWeightsToDeleteList'.$events_component->id}}">
                                    <input type="hidden"
                                        name="{{'fontsTransformToDeleteList'.$events_component->id.'[]'}}"
                                        id="{{'fontsTransformToDeleteList'.$events_component->id}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="text-muted">Vous pouvez ajouter ou supprimer des polices pour cette
                                    personnalisation.</p>
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
                                        data-target="#addColorModal" data-id="{{$events_component->id}}">
                                        Ajoutez une couleur
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

                                                <tbody class="list" id="{{'color_name_list'.$events_component->id}}">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="newsColors">
                                            <input type="hidden" name="{{'colorsList'.$events_component->id.'[]'}}"
                                                id="{{'colorsList'.$events_component->id}}">
                                            <input type="hidden" name="{{'hexaList'.$events_component->id.'[]'}}"
                                                id="{{'hexaList'.$events_component->id}}">
                                        </div>
                                        <div id="colorsToDelete">
                                            <input type="hidden"
                                                name="{{'colorsToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'colorsToDeleteList'.$events_component->id}}">
                                            <input type="hidden"
                                                name="{{'hexasToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'hexasToDeleteList'.$events_component->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="text-muted">Vous pouvez ajouter ou supprimer des couleurs de police pour
                                        cette personnalisation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        data-target="#addColorSmodeModal" data-id="{{$events_component->id}}">
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
                                                    id="{{'smode_color_name_list'.$events_component->id}}">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="newsColors">
                                            <input type="hidden" name="{{'smodeColorsList'.$events_component->id.'[]'}}"
                                                id="{{'smodeColorsList'.$events_component->id}}">
                                            <input type="hidden" name="{{'smodeHexaList'.$events_component->id.'[]'}}"
                                                id="{{'smodeHexaList'.$events_component->id}}">
                                            <input type="hidden"
                                                name="{{'smodeBgColorsList'.$events_component->id.'[]'}}"
                                                id="{{'smodeBgColorsList'.$events_component->id}}">
                                            <input type="hidden" name="{{'smodeBgHexaList'.$events_component->id.'[]'}}"
                                                id="{{'smodeBgHexaList'.$events_component->id}}">
                                        </div>
                                        <div id="colorsToDelete">
                                            <input type="hidden"
                                                name="{{'smodeColorsToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'smodeColorsToDeleteList'.$events_component->id}}">
                                            <input type="hidden"
                                                name="{{'smodeHexasToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'smodeHexasToDeleteList'.$events_component->id}}">
                                            <input type="hidden"
                                                name="{{'smodeBgColorsToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'smodeBgColorsToDeleteList'.$events_component->id}}">
                                            <input type="hidden"
                                                name="{{'smodeBgHexasToDeleteList'.$events_component->id.'[]'}}"
                                                id="{{'smodeBgHexasToDeleteList'.$events_component->id}}">
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
                    {{-- Image components --}}
                    @elseif($events_component->type == 'image')
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
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>
                                                    Alignement
                                                </label>
                                                <div class="form-group">
                                                    <select name="{{'align'.$events_component->id}}" id="align"
                                                        class="form-control" data-toggle="select">
                                                        <option value="center">Centré</option>
                                                        <option value="right">Droite</option>
                                                        <option value="left">Gauche</option>
                                                        <option value="false">Aucun</option>
                                                    </select>
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
                            <h4 class="card-header-title">
                                Image du composant
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    {!! Form::file('comp_image'.$events_component->id, [
                                    'class' => 'form-control custom-file-input',
                                    'id' =>'comp_image'.$events_component->id
                                    ]) !!}
                                    <label class="custom-file-label" for="photo_profile">
                                        Ajoutez l'image
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <p class="text-muted">
                                    Ajoutez ici l'image correspondant à ce composant.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif {{-- /Component type condition --}}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Composant de type : {{ $events_component->type }}
                        </div>
                    </div>
                </div>
            </div>
            @if($events_component->type == 'input')
            <div class="card">
                <div class="card-header">
                    <b>
                        Paramètres
                    </b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nombre de caractères minimum</label>
                                {!! Form::number('min'.$i, $events_component->input_min,[
                                'class' => 'form-control',
                                'placeholder' => '1'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nombre de caractères maximum</label>
                                {!! Form::number('max'.$i, $events_component->input_max,[
                                'class' => 'form-control',
                                'placeholder' => '99'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Texte par défaut</label>
                                {!! Form::text('default_text'.$i, $events_component->default_text,[
                                'class' => 'form-control',
                                'placeholder' => 'Votre texte'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Taille de police minimum</label>
                                {!! Form::number('min_size'.$events_component->id, null,[
                                'class' => 'form-control',
                                'placeholder' => '1'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Taille de police maximum</label>
                                {!! Form::number('max_size' . $events_component->id, null,[
                                'class' => 'form-control',
                                'placeholder' => '99'
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Requis ?</label>
                                <div class="form-group">
                                    <select name="{{'required' . $events_component->id}}" id="required"
                                        class="form-control" data-toggle="select">
                                        <option value="true" selected>Oui</option>
                                        <option value="false">Non</option>
                                    </select>
                                </div>
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
                                        {!! Form::number('origin_x'.$i, $events_component->origin_x, [
                                        'class' => 'form-control',
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
                                        {!! Form::number('origin_y'.$i, $events_component->origin_y, [
                                        'class' => 'form-control',
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
                                        <label>Sélectionnable ?</label>
                                        <div class="form-group">
                                            <select name="{{'selectable' . $events_component->id}}" id="align"
                                                class="form-control" data-toggle="select">
                                                <option value="true" selected>Oui</option>
                                                <option value="false">Non</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Pleine largeur ?</label>
                                        <div class="form-group">
                                            <select name="{{'fullwidth' . $events_component->id}}" id="align"
                                                class="form-control" data-toggle="select">
                                                <option value="true" selected>Oui</option>
                                                <option value="false">Non</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($events_component->type == 'input')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Type de clavier
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="{{'keyboard_type' . $events_component->id}}" id="align"
                                            class="form-control" data-toggle="select">
                                            <option value="default" selected>Alphabétique avec emojis</option>
                                            <option value="no_emojis">Alphabétique sans emojis</option>
                                            <option value="numeric">Numérique</option>
                                        </select>
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
                                Première lettre ou symbole avant le texte
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::text('font_first_letter'.$i, null, [
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Configuration du texte
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label>Alignement du texte</label>
                                    <div class="form-group">
                                        <select name="{{'text_align' . $events_component->id}}" id="align"
                                            class="form-control" data-toggle="select">
                                            <option value="center" selected>Centré</option>
                                            <option value="left">Gauche</option>
                                            <option value="right">Droite</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>Multiligne</label>
                                    <div class="form-group">
                                        <select name="{{'multiline' . $events_component->id}}" id="align"
                                            class="form-control" data-toggle="select">
                                            <option value="false" selected>Non</option>
                                            <option value="true">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
@endforeach
{{-- Send an array with eventsCustom ids for alert errors --}}
<input type="hidden" name="arrayEventsComponentsIds[]" value="{{ json_encode($arrayEventsComponentsIds) }}"
    id="arrayEventsComponentsIds">