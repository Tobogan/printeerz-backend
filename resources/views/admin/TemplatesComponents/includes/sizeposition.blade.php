<div class="row" data-root="componentElement" type="input image">
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
                                Hauteur (cm)
                            </label>
                            <!-- Input -->
                            {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- First name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label>
                                Largeur (cm)
                            </label>
                            <!-- Input -->
                            {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" data-root="componentElement" type="input image">
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
                            {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>'0']) !!}
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
                            {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' => '0']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>