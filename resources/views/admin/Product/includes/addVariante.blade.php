<div class="modal fade" id="addVariante" tabindex="-1" role="dialog" aria-labelledby="addVarianteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Nouvelle variante</h2>
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
                {!! Form::open(['id' => 'AddProductsVariants', 'files' => true]) !!}
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="hidden" name="is_active" id="is_active" value="true">
                    <input type="hidden" name="is_deleted" id="is_deleted" value="false">
                    {!! Form::label('color', 'Ajouter le couleur: ') !!}
                    {!! Form::text('color', null, array('class'=>'form-control mb-2', 'placeholder' =>'Couleur :','id' => 'color', 'name' => 'color')) !!}
                    {!! Form::label('size', 'Ajouter la taille: ') !!}
                    {!! Form::text('size', null, array('class'=>'form-control mb-2', 'placeholder' =>'Taille :','id' => 'size', 'name' => 'size')) !!}
                    {{--{!! Form::label('quantity', 'Ajouter la quantité: ') !!}
                    {!! Form::text('quantity', null, array('class'=>'form-control mb-2', 'placeholder' => 'Quantité :','id' => 'quantity', 'name' => 'quantity')) !!}--}}
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Valider', array('class'=>'btn btn-primary btn-sm', 'id' => 'submit_modal','onclick' => "this.value='Ajoutée'")) }}
                {{Form::close()}}
            </div>
            
        </div>
    </div>
</div>