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
                                {{$printzone->name}}
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
            {!! Form::open(['action' => array('PrintzonesController@update'), 'id' => $printzone->id, 'files' => true, 'class' => 'mb-4']) !!}
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Nom de la zone
                        </label>
                        <!-- Input -->
                        {!! Form::text('name', $printzone->name, ['class' => 'form-control', 'placeholder' => 'Nom'])
                        !!}
                    </div>
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Zone
                        </label>
                        <!-- Input -->
                        {!! Form::text('zone', $printzone->zone, ['class' => 'form-control', 'placeholder' => 'Nom'])
                        !!}
                    </div>
                </div>
                <hr class="mt-4 mb-5">
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Largeur de la zone
                        </label>
                        <!-- Input -->
                        {!! Form::number('width', $printzone->width, ['class' => 'form-control', 'placeholder'
                        =>'Largeur de la zone :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Hauteur de la zone
                        </label>
                        <!-- Input -->
                        {!! Form::number('height', $printzone->height, ['class' => 'form-control', 'placeholder' =>
                        'Hauteur de la zone']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Position X d'origine sur le plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('origin_x', $printzone->origin_x, ['class' => 'form-control', 'placeholder' =>
                        'Position X d\'origine sur le plateau :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Position Y d'origine sur le plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('origin_y', $printzone->origin_y, ['class' => 'form-control', 'placeholder' =>
                        'Position y d\'origine sur le plateau :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Largeur du plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('tray_width', $printzone->tray_width, ['class' => 'form-control',
                        'placeholder' => 'Largeur du plateau :']) !!}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Hauteur du plateau
                        </label>
                        <!-- Input -->
                        {!! Form::number('tray_height', $printzone->tray_height, ['class' => 'form-control',
                        'placeholder' => 'Hauteur du plateau :']) !!}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Description de la zone</label>
                        {!! Form::hidden('description', $printzone->description) !!}
                        <div id="printzone_description_edit" name="description" data-toggle="quill" data-quill-placeholder="Décrivez la zone"></div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('printzones_id', $printzone->id) !!}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Modifier la zone', ['class' => 'btn btn-primary', 'style' => 'float: right'])
                        !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('index_printzones')}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@section('javascripts')

<script>
    var form = document.querySelector('form');
    var description = document.querySelector('input[name=description]');
    
    function editDesc(){
        var desc = new Quill('#printzone_description_edit');
    };

    editDesc();

    form.onsubmit = function() {
    // Populate hidden form on submit
    description.value = JSON.stringify(quill.getContents());
    
    console.log("Submitted", $(form).serialize(), $(form).serializeArray());
    
    // No back end to actually submit to!
    alert('Open the console to see the submit data!')
    return false;
    };
</script>

@endsection

@endsection