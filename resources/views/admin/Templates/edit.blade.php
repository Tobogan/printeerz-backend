@extends('layouts/templateAdmin')
@section('title', $template->title)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                MODIFICATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Modifier un gabarit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('TemplatesController@update'), 'id' => $template->id, 'files' => true,
            'class' => 'mb-4']) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>
                                            Nom du gabarit
                                        </label>
                                        {!! Form::text('title', $template->title, ['class' => 'form-control' .
                                        $errors->first('title', ' is-invalid'), 'placeholder' => 'Nom'])!!}
                                        {!! $errors->first('title', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!} </div>
                                    <div class="form-group">
                                        <label>
                                            Catégorie
                                        </label>
                                        {!! Form::text('category', $template->category, ['class' => 'form-control' .
                                        $errors->first('category', ' is-invalid'), 'placeholder' => 'Catégorie']) !!}
                                        {!! $errors->first('category', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Largeur/hauteur --}}
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
                                    <div class="form-group">
                                        <label>
                                            Largeur (cm)
                                        </label>
                                        {!! Form::number('width', $template->size["width"], ['class' => 'form-control',
                                        'placeholder' =>
                                        '']) !!}
                                        {!! $errors->first('width', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Hauteur (cm)
                                        </label>
                                        {!! Form::number('height', $template->size["height"], ['class' =>
                                        'form-control', 'placeholder' =>
                                        '']) !!}
                                        {!! $errors->first('height', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Position --}}
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
                                    <div class="form-group">
                                        <label>
                                            X (cm)
                                        </label>
                                        {!! Form::number('origin_x', $template->origin["x"], ['class' => 'form-control',
                                        'placeholder' =>
                                        '0']) !!}
                                        {!! $errors->first('origin_x', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Y (cm)
                                        </label>
                                        {!! Form::number('origin_y', $template->origin["y"], ['class' => 'form-control',
                                        'placeholder' =>
                                        '0']) !!}
                                        {!! $errors->first('origin_y', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Composants --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header mt-2">
                            <h4 class="card-header-title">
                                Composants
                                <p class="mt-2"><small class="text-muted">Sélectionnez au moins un composant pour ce
                                        gabarit.</small></p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group m-0">
                                        {!! Form::select('components_ids[]',
                                        App\Template_components::pluck('title','_id'), $template->components_ids, ['id'
                                        =>
                                        'componentsSelect', 'class' => '', 'data-toggle' =>'select']) !!}
                                        {!! $errors->first('components_ids', '<p class="help-block mt-2"
                                            style="color:red;"><small>Merci de sélectionner au moins un
                                                composant.</small></p>') !!}
                                    </div>

                                    <div id="templateComponentsList" data-type='sortable' class="mt-3">
                                        {{-- Foreach templateComponentID --}}
                                        @if($template->components_ids)
                                        @foreach ($template->components_ids as $component)
                                        <ul class="list-group py-2">
                                            <li class="list-group-item ui-state-default" data-id="{{$component['id']}}">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">{{$component['name']}}</div>
                                                    <div class="col-auto">
                                                        <a data-id="{{$component['id']}}" class="deleteComponent"
                                                            style="cursor:pointer;">
                                                            <i class="fe fe-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a class="handle" style="cursor:grab;">
                                                            <i class="fe fe-more-vertical"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @endforeach
                                        @endif
                                    </div>
                                    {!! Form::hidden('templateComponentsList[]', "false", ['id' =>
                                    'templateComponentsListHidden']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Images --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                Image d'illustration
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    @if(!empty($template->thumb_img) && $disk->exists($template->thumb_img))
                                    <div class="avatar avatar-xxl card-avatar">
                                        <img src="{{$disk->url($template->thumb_img)}}" alt="..." class="avatar-img rounded">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="thumb">Ajoutez/Modifier la miniature</label>
                                        {!! Form::file('thumb', array('class' => 'form-control', 'id'
                                        => 'thumb', 'name' => 'thumb')) !!}
                                        {!! $errors->first('thumb', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    @if(!empty($template->full_img) && $disk->exists($template->full_img))
                                    <div class="avatar avatar-xxl card-avatar">
                                        <img src="{{$disk->url($template->full_img)}}" alt="..." class="avatar-img rounded">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="full">Ajoutez/Modifier l'image</label>
                                        {!! Form::file('full', array('class' => 'form-control', 'id'
                                        => 'full', 'name' => 'full')) !!}
                                        {!! $errors->first('full', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::hidden('template_id', $template->id) !!}
            {!! Form::hidden('actual_title', $template->title) !!}
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier le gabarit', ['class' => 'btn btn-primary', 'style' => 'float:
                        right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_templates')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection