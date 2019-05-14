<div class="modal fade" id="addVariante" tabindex="-1" role="dialog" aria-labelledby="addVarianteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ajouter des variantes</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted b-4">Une variante de produit correspond à une taille et une couleur.</p> 
                <p class="text-muted b-4"> Vous pouvez ajouter plusieurs couleurs et plusieurs tailles afin de générer les variantes de ce produit. Après avoir saisi une couleur ou une taille, appuyez sur la touche "Entrée" pour la valider.</p>
                {!! Form::open(['id' => 'AddProductsVariants', 'files' => true, 'class' => 'mt-5']) !!}
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="hidden" name="is_active" id="is_active" value="true">
                    <input type="hidden" name="is_deleted" id="is_deleted" value="false"> 
                    {!! Form::label('color', 'Ajoutez une ou plusieurs couleurs') !!}
                    {!! Form::text('color', null, array('class'=>'form-control mb-2', 'placeholder' =>'Ajouter des couleurs','id'
                    => 'color', 'name' => 'color', 'data-role' => 'tagsinput')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('size', 'Ajouter une ou plusieurs tailles') !!} {!! Form::text('size', null, array('class'=>'form-control mb-2', 'placeholder' =>'Ajouter des tailles',
                    'id' => 'size', 'name' => 'size', 'data-role' => 'tagsinput')) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> {{
                Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modal')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modal">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button> {{ Form::close() }}
            </div>

        </div>
    </div>
</div>