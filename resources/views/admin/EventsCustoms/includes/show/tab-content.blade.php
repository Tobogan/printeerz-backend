<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-8">
                <div class="form-group">
                        <label>
                            Nom du produit
                        </label>
                        {!! Form::text('title', $events_custom->title, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
        </div>
        <div class="col-4">
            Image
        </div>
    </div>

</div>
<?php $i=0; ?>
@foreach($templates as $template)
<?php $array_template = $events_custom->template ?>
@if($template->id == reset($array_template))
@foreach($template_components as $template_component)
@foreach($template->components_ids as $component_id)
@if($template_component->id == $component_id)
@if($template_component->type = 'input')
<?php $i++; ?>
<div class="tab-pane fade show" id="template_component_{{$template_component->id}}" role="tabpanel"
    aria-labelledby="template_component_{{$template_component->id}}-tab">
    {{-- Store template_composant id --}}
    <input type="hidden" class="form-control" name="{{'template_component_id'.$i}}" value="{{$template_component->id}}">
    <div class="row">
        <div class="col-8">
            {{-- Custom option --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Nom du composant
                                </label>
                                <!-- Input -->
                                @if(isset($template_component->font["name"]))
                                    {!! Form::text('font_title'.$i, $template_component->font["name"], ['class' => 'form-control','placeholder' => 'Entrer le nom']) !!}
                                    @else
                                    {!! Form::text('font_title'.$i, null, ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                                @endif
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
                                    <p class="text-muted">Pas de polices définies</p>
                                </div>
                                <div id="newsFonts">
                                    <input type="hidden" name="{{'fontsList'.$template_component->id.'[]'}}"
                                        id="{{'fontsList'.$template_component->id}}" value="Roboto">
                                    <input type="hidden" name="{{'font_urlList'.$template_component->id.'[]'}}"
                                        id="{{'font_urlList'.$template_component->id}}"
                                        value="/uploads/Roboto-Black.ttf">
                                </div>
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
                                        data-id="{{$template_component->id}}">
                                        Ajouter une couleur
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">    
                                <div class="col-12">
                                    <p class="text-muted">Pas de couleurs définies</p>
                                    <div id="newsColors">
                                        <input type="hidden" name="{{'colorsList'.$template_component->id.'[]'}}"
                                            id="{{'colorsList'.$template_component->id}}" value="Black">
                                        <input type="hidden" name="{{'hexaList'.$template_component->id.'[]'}}"
                                            id="{{'hexaList'.$template_component->id}}" value="000000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Ce composant un {{$template_component->type}}
                        </div>
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
                                            Largeur (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('width'.$i, $template_component->size["width"],
                                        ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                        {!! Form::number('height'.$i, $template_component->size["height"],
                                        ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <p class="text-muted">La taille par défault est de {{$template_component->size["width"]}} x {{$template_component->size["height"]}} cm</p>
                                </div>
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
                                            X (cm)
                                        </label>
                                        <!-- Input -->
                                        {!! Form::number('origin_x'.$i, $template_component->origin["x"], ['class' =>
                                        'form-control', 'placeholder' =>'0']) !!}
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
                                        {!! Form::number('origin_y'.$i, $template_component->origin["y"], ['class' =>
                                        'form-control', 'placeholder' => '0']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Delete composant --}}
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-danger mb-2">Delete component</button>
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