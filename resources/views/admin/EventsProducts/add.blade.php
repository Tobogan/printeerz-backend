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
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::open(['action' => array('ProductController@store'), 'files' => true,
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
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nom du produit'])
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
                            {!! Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Type de produit'])
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
                        {!! Form::text('vendor_name', null, ['class' => 'form-control', 'placeholder' =>
                        'Nom :']) !!}
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
                        {!! Form::text('vendor_reference', null, ['class' => 'form-control', 'placeholder' => 'Référence :']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="mb-4">Sélectionner le genre</p>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <select name="gender" id="gender" class="form-control" data-toggle="select">
                            <option value="male">Homme</option>
                            <option value="female">Femme</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-5">
            <div class="row">
                <div class="col-12">
                    <p class="h3">Image</p>
                    <p class="mb-4">Ajouter l'image du produit en format 1:1</p>
                </div>
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <div class="dropzone dropzone-single mb-3" data-toggle="dropzone" data-dropzone-url="http://" id="logo_event_upload">
                            <div class="fallback">
                                <div class="custom-file">
                                    {!! Form::file('image', array('class' => 'custom-file-input', 'id' => 'logo_img')) !!}
                                    <label class="custom-file-label" for="projectCoverUploads">Choose file</label>
                                </div>
                            </div>
                            <div class="dz-preview dz-preview-single">
                                <div class="dz-preview-cover">
                                    <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                                </div>
                            </div>
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
                        {!! Form::select('printzones_id[]', App\Printzones::pluck('name','_id'), null, ['class' => 'form-control', 'multiple', 'data-toggle' => 'select']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description du produit</label>
                <div name="description" data-toggle="quill" data-quill-placeholder="Décrivez le produit"></div>
            </div>
            {!! Form::hidden('is_active', "true") !!}
            {!! Form::hidden('is_deleted', "false") !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Créer le produit', ['class' => 'btn btn-primary', 'style' => 'float: right'])
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