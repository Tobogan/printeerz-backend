{{-- Add color modal --}}
<div class="modal fade" id="addColorModal" tabindex="-1" role="dialog" aria-labelledby="addColorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ajouter une variante</h2>
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
                    <p>Vous pouvez une couleur et son code hex.</p>
                    {!! Form::open(['id' => 'AddColor', 'files' => true, 'class' => 'mt-5']) !!}
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="events_custom_id" id="events_custom_id" value="{{$events_custom->id}}">
                    <div class="form-group">
                        <label>
                            Couleur
                        </label>
                        {{ Form::text('color', null, array('class' => 'form-control mb-3','id' => 'ep_color')) }}
                    </div>
                    <div class="form-group">
                        <label>
                            Code hex
                        </label>
                        {{ Form::text('code_hex', null, array('class' => 'form-control mb-3','id' => 'ep_code_hex')) }}
                    </div>
                    <div id="idTP">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalAddColor')) }}
                    <button class="btn btn-primary d-none" type="button" disabled id="loading_modalAddColor">
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Génération...
                    </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div> {{-- /modal --}}