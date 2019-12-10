@extends('layouts/templateAdmin')
@section('title', $product->title)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                MODIFICATION
                            </h6>
                            <h1 class="header-title">
                                Modifier un produit
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open(['action' => array('ProductController@update'), 'id' => $product->id, 'files' => true,
            'class' => 'mb-4']) !!}
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
                                {!! Form::text('title', $product->title, [
                                'class' => 'form-control' . $errors->first('title', 'is-invalid'),
                                'placeholder' => 'Nom du produit'
                                ])!!}
                                {!! $errors->first('title', '<p class="help-block mt-2" style="color:red;">
                                    <small>:message</small></p>') !!}
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Type de produit</label>
                                        {!! Form::text('product_type', $product->product_type, [
                                        'class' => 'form-control'. $errors->first('product_type', 'is-invalid'),
                                        'placeholder' => 'Type de produit'
                                        ])!!}
                                        {!! $errors->first('product_type', '<p class="help-block mt-2"
                                            style="color:red;">
                                            <small>:message</small></p>') !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Genre du produit</label>
                                        @if($product->gender == "male")
                                        <select name="gender" id="gender" class="form-control" data-toggle="select">
                                            <option value="male" selected>Homme</option>
                                            <option value="female">Femme</option>
                                            <option value="unisex">Unisex</option>
                                            <option value="accessories">Accessoires</option>
                                        </select>
                                        @else
                                        <select name="gender" id="gender" class="form-control" data-toggle="select">
                                            <option value="male">Homme</option>
                                            <option value="female" selected>Femme</option>
                                            <option value="unisex">Unisex</option>
                                            <option value="accessories">Accessoires</option>
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="actual_title"
                                    value="{{$product->title}}">
                                <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
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
                                        {!! Form::text('vendor_name', $product->vendor['name'], ['class' =>
                                        'form-control',
                                        'placeholder' => 'Nom']) !!}
                                        <div>{!! $errors->first('vendor_name', '<p class="help-block mt-2"
                                                style="color:red;"><small>:message</small></p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Référence
                                        </label>
                                        {!! Form::text('vendor_reference', $product->vendor['reference'], ['class' =>
                                        'form-control',
                                        'placeholder' => 'Référence']) !!}
                                        <div>{!! $errors->first('vendor_reference', '<p class="help-block mt-2"
                                                style="color:red;"><small>:message</small></p>')
                                            !!} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($product->image) && $disk->exists($product->image))
            <div class="card">
                <div class="card-body">
                    <img width="40%" title="image produit" class="" src="{{$s3 . $product->image}}" alt="Image produit"
                        style="margin-left:auto;margin-right:auto;display:block;">
                </div>
            </div>
            @else
            <div class="card card-inactive">
                <div class="card-body text-center">
                    <p class="text-muted">
                        Pas d'image de produit
                    </p>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Image du produit.
                                <p class="text-muted b-4 mt-3">Modifiez l'image du produit en format 1:1 (format:
                                    jpeg,jpg,png | format: jpeg,jpg,png | max: 4mo)</p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::file('image', array(
                                    'class' => 'form-control',
                                    'id' => 'logo_img')) !!}
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title mt-2">
                                Zones d'impression disponibles.
                                <p class="text-muted b-4 mt-3">Sélectionnez les zones d'impression qui seront
                                    disponibles pour ce produit</p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::select('printzones_id[]', App\Printzones::pluck('name','_id'),
                                $product->printzones_id, [
                                'class' => 'form-control',
                                'multiple',
                                'data-toggle' => 'select'
                                ]) !!}
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
                                <p class="text-muted b-4 mt-3">Ecrivez une description rapide du produit (max: 750
                                    caractères)</p>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::textarea('description', $product->description, [
                                'id' => 'description',
                                'class' => 'form-control',
                                'rows' => 4,
                                'cols' => 54,
                                'maxlength' => '750'
                                ]) !!}
                                {!! $errors->first('description', '<p class="help-block mt-2" style="color:red;">
                                    <small>:message</small></p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier le produit', [
                        'class' => 'btn btn-primary',
                        'style' => 'float: right'
                        ]) !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_product')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection