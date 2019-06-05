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
                        <div class="form-group">
                            <label>
                                Hauteur (mm)
                            </label>
                            {!! Form::number('height', null, ['class' => 'form-control', 'placeholder' => '250']) !!}
                            {!! $errors->first('height', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Largeur (mm)
                            </label>
                            {!! Form::number('width', null, ['class' => 'form-control', 'placeholder' => '150']) !!}
                            {!! $errors->first('width', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
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
                        <div class="form-group">
                            <label>
                                X (mm)
                            </label>
                            {!! Form::number('origin_x', null, ['class' => 'form-control', 'placeholder' =>'0']) !!}
                            {!! $errors->first('origin_x', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>
                                Y (mm)
                            </label>
                            {!! Form::number('origin_y', null, ['class' => 'form-control', 'placeholder' => '0']) !!}
                            {!! $errors->first('origin_y', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>