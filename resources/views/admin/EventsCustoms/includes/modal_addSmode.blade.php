{{-- Add color modal --}}
<div class="modal fade" id="addColorSmodeModal" tabindex="-1" role="dialog" aria-labelledby="addColorSmodeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" id="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">SMODE : Ajoutez une couleur de police</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Merci de préciser le nom de la couleur de police & du background ainsi que leur format hexadécimal.
                </p>
                {!! Form::open(['id' => 'AddColorSmode']) !!}
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="events_custom_id" id="events_custom_id" value="{{ $events_custom->id }}">
                <div class="form-group">
                    <label>Nom de la couleur de police</label>
                    {{ Form::text('smode_color', null, array('class' => 'form-control mb-3','id' => 'smode_color')) }}
                </div>
                <div class="form-group">
                    <label>Format hexadecimal</label>
                    {{ Form::text('smode_code_hex', null, array('class' => 'form-control mb-3','id' => 'smode_code_hex')) }}
                </div>
                <div class="form-group">
                    <label>Nom de la couleur de fond</label>
                    {{ Form::text('smode_bg_color', null, array('class' => 'form-control mb-3','id' => 'smode_bg_color')) }}
                </div>
                <div class="form-group">
                    <label>Format hexadécimal</label>
                    {{ Form::text('smode_bg_code_hex', null, array('class' => 'form-control mb-3','id' => 'smode_bg_code_hex')) }}
                </div>
                <div id="idTP">
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalAddSmodeColor')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modalAddSmodeColor">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div> {{-- /modal --}}