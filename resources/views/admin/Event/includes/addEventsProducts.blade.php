<div class="modal fade" id="addEventsProductModal" tabindex="-1" role="dialog" aria-labelledby="addEventsProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ajouter un produit</h2>
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
                <p>Vous pouvez ajouter un produit existant à cet événement.</p>
                {!! Form::open(['id' => 'AddEventsProduct', 'class' => 'mt-5']) !!}
                <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                <div class="form-group">
                    <select name="product_id" id="product_id" class="form-control" data-toggle="select">
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->title}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="is_active" id="is_active" value="true">
                <input type="hidden" name="is_deleted" id="is_deleted" value="false">
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modal_EP')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modal_EP">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
            
        </div>
    </div>
</div>