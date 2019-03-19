<div class="row" type="image">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">
                    Image du composant
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        {{-- Image --}}
                        @if(!empty($template_component->image) && $disk->exists($template_component->image))
                        <div class="card">
                            <div class="card-body">
                                <img width="100%" title="image principale" class="" src="{{$s3 . $template_component->image}}"
                                    alt="Image produit">
                            </div>
                        </div>
                        @endif
                        <div class="card card-inactive">
                            <div class="custom-file">
                                {!! Form::file('image', array('class' => 'form-control custom-file-input', 'id'=> 'image', 'name' => 'image')) !!}
                                <label class="custom-file-label" for="thumb">Modifier l'image</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>