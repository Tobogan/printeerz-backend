<div data-root="componentElement" type="image">
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Image
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- First name -->
                            <div class="custom-file">
                                {!! Form::file('image', array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
                                <label class="custom-file-label" for="photo_profile">Ajouter l'image</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>