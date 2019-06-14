@extends('layouts/templateAdmin')
@section('title', 'Produit')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
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
                                Créer un produit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            {!! Form::open(['action' => array('ProductController@store'), 'files' => true, 'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Informations générales du produit.
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>
                                    Nom du produit
                                </label>
                                {!! Form::text('title', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Nom du produit'
                                ])!!}
                                <div>{!! $errors->first('title', '<p class="help-block mt-2" style="color:red;">
                                        <small>:message</small></p>')
                                    !!} </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Type de produit
                                        </label>
                                        {!! Form::text('product_type', null, [
                                        'class' => 'form-control'.$errors->first('product_type', ' is-invalid'),
                                        'placeholder' => 'Type de produit'
                                        ]) !!}
                                        @if($errors->has('product_type'))<div class="invalid-feedback">Veuillez
                                            renseigner le type du produit</div>@endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Genre du produit</label>
                                        <select name="gender" id="gender" class="form-control" data-toggle="select">
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                            <option value="unisex">Unisexe</option>
                                            <option value="accessories">Accessoires</option>
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
                            <h4 class="card-header-title mt-2">
                                Informations du fournisseur.
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Nom
                                        </label>
                                        {!! Form::text('vendor_name', null, ['class' => 'form-control', 'placeholder' =>
                                        'Nom']) !!}
                                        <div>{!! $errors->first('vendor_name', '<p class="help-block mt-2"
                                                style="color:red;"><small>:message</small></p>') !!} </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Référence
                                        </label>
                                        {!! Form::text('vendor_reference', null, ['class' => 'form-control',
                                        'placeholder' => 'Référence']) !!}
                                        <div>{!! $errors->first('vendor_reference', '<p class="help-block mt-2"
                                                style="color:red;"><small>:message</small></p>') !!} </div>
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
                            <h4 class="card-header-title mt-2">
                                Image du produit.
                                <p class="text-muted b-4 mt-3">Ajoutez l'image du produit en format 1:1 (format:
                                    jpeg,jpg,png | format: jpeg,jpg,png | max: 4mo)</p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        Télécharger l'image du produit
                                    </label>
                                    {!! Form::file('image', ['class' => 'form-control']) !!}
                                    <div>{!! $errors->first('image', '<p class="help-block mt-2" style="color:red;">
                                            <small>:message</small></p>') !!} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-header-title mt-2">
                                    Zones d'impression disponibles.
                                    <p class="text-muted b-4 mt-3">Sélectionnez les zones d'impression qui seront
                                        disponibles pour ce produit</p>
                                </h4>
                            </div>
                            <div class="card-body">
                                {!! Form::select('printzones_id[]', App\Printzones::pluck('name','_id'), null, ['class'
                                => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                                <div>{!! $errors->first('printzones_id', '<p class="help-block mt-2" style="color:red;">
                                        <small>Merci de saisir au moins une zone d\'impression.</small></p>') !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Description du produit.
                                <p class="text-muted b-4 mt-3">Ecrivez une description rapide du produit (min: 3
                                    caractères, max: 750 caractères)</p>
                            </h4>
                        </div>
                        <div class="card-body">
                            {!! Form::textarea('description', null, [
                            'id' => 'description',
                            'class' => 'form-control',
                            'rows' => 4,
                            'cols' => 54,
                            'maxlength' => '749'
                            ])
                            !!}
                            {!! $errors->first('description', '<p class="help-block mt-2" style="color:red;">
                                <small>:message</small></p>') !!}
                        </div>

                    </div>
                </div>
            </div>
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le produit', [
                        'class' => 'btn btn-primary',
                        'style' => 'float: right'
                        ])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_product')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection