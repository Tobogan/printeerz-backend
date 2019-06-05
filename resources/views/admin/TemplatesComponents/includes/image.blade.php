<div data-root="componentElement" type="image">
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Image
                        <p class="text-muted mt-2 mb-2">Vous pouvez ajouter une image pour illustrer ce composant (format: jpeg,jpg,png | format: jpeg,jpg,png | max: 4mo)</p>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::file('image', array('class' => 'form-control', 'id' =>'photo_profile')) !!}
                                {!! $errors->first('image', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>