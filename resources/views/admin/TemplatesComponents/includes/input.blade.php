<div data-root="componentElement" type="input">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Nombre de caractères
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <!-- First name -->
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Minimum
                                </label>
                                <!-- Input -->
                                {!! Form::number('min', null, ['class' => 'form-control', 'placeholder' => '1']) !!} </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- First name -->
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Maximum
                                </label>
                                <!-- Input -->
                                {!! Form::number('max', null, ['class' => 'form-control', 'placeholder' =>
                                '99']) !!} </div>
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
                        Police de caractère par défault
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Nom
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_name', null, ['class' => 'form-control', 'placeholder' => 'Entrer le nom']) !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- First name -->
                        <div class="custom-file">
                            {!! Form::file('font_url', array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
                            <label class="custom-file-label" for="photo_profile">Ajouter le fichier de la police</label>
                        </div>
                    </div>
                    <hr class="mt-4 mb-5">
                    <div class="col-12">
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Epaisseur
                            </label>
                            <div class="form-group">
                                <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                                    <option value="100">Thin (100)</option>
                                    <option value="200">Extra Light (200)</option>
                                    <option value="300">Light (300)</option>
                                    <option value="400">Normal (400)</option>
                                    <option value="500">Medium (500)</option>
                                    <option value="600">Semi Bold (600)</option>
                                    <option value="700">Bold (700)</option>
                                    <option value="800">Extra Bold (800)</option>
                                    <option value="900">Black (900)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Transformation
                            </label>
                            <div class="form-group">
                                <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                                    <option value="none">Aucune</option>
                                    <option value="uppercase">Tout en Majuscules</option>
                                    <option value="capitalize">Première lettre en Majuscule</option>
                                    <option value="lowercase">Tout en minuscule</option>
                                    <option value="full-width">Pleine largeur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Première lettre ou symbole avant le texte
                            </label>
                            <!-- Input -->
                            {!! Form::text('font_first_letter', null, ['class' => 'form-control',
                            'placeholder' => '#']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::hidden('fonts_total', '3') !!}