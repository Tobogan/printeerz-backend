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
                                Modifier un produit
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
            {!! Form::open(['action' => array('ProductController@update'), 'id' => $product->id, 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom du produit
                        </label>
                        <!-- Input -->
                        {!! Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Nom du produit'])
                        !!}
                    </div>
                </div>
                <div class="col-12">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Type de produit
                            </label>
                            <!-- Input -->
                            {!! Form::text('product_type', $product->product_type, ['class' => 'form-control', 'placeholder' => 'Type de produit'])
                            !!}
                        </div>
                    </div>
                    <hr class="mt-4 mb-5">
                <div class="col-12 col-md-6">
                    <!-- First name -->

                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom du fournisseur
                        </label>
                        <!-- Input -->
                        @if(isset($product->vendor['name']))
                            {!! Form::text('vendor_name', $product->vendor['name'], ['class' => 'form-control', 'placeholder' =>
                        'Nom :']) !!}
                        @else
                            {!! Form::text('vendor_name', $product->vendor['name'], ['class' => 'form-control', 'placeholder' =>
                        'Nom :']) !!}
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Référence produit
                        </label>
                        <!-- Input -->
                        @if(isset($product->vendor['reference']))
                        {!! Form::text('vendor_reference', $product->vendor['reference'], ['class' => 'form-control', 'placeholder' =>
                    'Référence :']) !!}
                    @else
                        {!! Form::text('vendor_reference', $product->vendor['reference'], ['class' => 'form-control', 'placeholder' =>
                    'Référence :']) !!}
                    @endif                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="mb-4">Sélectionner le genre</p>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        @if($product->gender == "male")
                            <select name="gender" id="gender" class="form-control" data-toggle="select">
                                <option value="male" selected>Homme</option>
                                <option value="female">Femme</option>
                            </select>
                        @else
                            <select name="gender" id="gender" class="form-control" data-toggle="select">
                                <option value="male">Homme</option>
                                <option value="female" selected>Femme</option>
                            </select>
                        @endif
                    </div>
                </div>
                <input type="hidden" class="form-control" name="actual_title" value="{{$product->title}}">
                <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">

            </div>

            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Image</p>
                    <p class="mb-4">Modifier l'image du produit en format 1:1</p>
                </div>
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                                <div class="custom-file">
                                    {!! Form::file('image', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
                                    <label class="custom-file-label" for="projectCoverUploads">Télécharger l'image du produit</label>
                                </div>
                            </div>
                </div>
            </div>
            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Zones d'impression disponible(s)
                        </label>
                        <!-- Input -->
                        {!! Form::select('printzones_id[]', App\Printzones::pluck('name','_id'), $product->printzones_id, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description du produit</label>
            <input id="textDescription" type="textarea" class="description" name="description" rows="3" value="{{ $product->description }}">
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier le produit', ['class' => 'btn btn-primary', 'style' => 'float: right'])
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