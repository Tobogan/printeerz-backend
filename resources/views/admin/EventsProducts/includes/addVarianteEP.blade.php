<div class="modal fade" id="addVarianteEPModal" tabindex="-1" role="dialog" aria-labelledby="addVarianteEPModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" id="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ajoutez une variante</h2>
                @if (session('status'))
                <div class="alert alert-success mt-1 mb-2">
                    {{ session('status') }}
                </div>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Vous pouvez sélectionner une variante du produit et entrer la quantité que vous souhaitez.</p>
                {!! Form::open(['id' => 'AddVarianteEP', 'files' => true, 'class' => 'mt-5']) !!}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="hidden" name="actual_titleEP" id="actual_titleEP" value="{{$events_product->title}}">
                    <input type="hidden" name="events_product_id" id="events_product_id" value="{{$events_product->_id}}">
                    <input type="hidden" name="title" id="title" value="{{$events_product->title}}">
                    <!-- Label -->
                    <label>
                        Variantes
                    </label>
                    <select name="products_variant_id" id="products_variant_id" class="form-control mb-2" data-toggle="select">
                        @foreach($products_variants as $products_variant)
                            @if($products_variant->product_id == $product->id)
                                <option value="{{$products_variant->_id}}">
                                    {{'Couleur: '.$products_variant->color.' | Taille: '.$products_variant->size.' | Stock: '.$products_variant->quantity}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Quantité pour l'événement
                    </label>
                    {{ Form::number('quantity', null, array('class' => 'form-control mb-3','id' => 'quantity')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalVarianteEP')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modalVarianteEP">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
            
        </div>
    </div>
</div>