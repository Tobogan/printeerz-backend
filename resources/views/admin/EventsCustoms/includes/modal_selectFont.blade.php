{{-- Add color modal --}}
<div class="modal fade" id="selectFontModal" tabindex="-1" role="dialog" aria-labelledby="selectFontModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Sélectionner une police existante</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted b-4">Si elle ne se trouve pas dans la liste merci de l'ajouter en cliquant sur le bouton "+" dans le formulaire de personnalisation.</p>
                {!! Form::open(['id' => 'SelectFont', 'files' => true, 'class' => 'mt-5']) !!}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="events_custom_event_id" id="events_custom_event_id"
                    value="{{$events_custom->event_id}}">
                <div class="form-group">
                    <label> Nom</label>
                    {!! Form::select('font_id', $select_fonts, null, ['id' => 'font_id', 'class' => 'form-control mb-3']) !!}
                </div>
                <div class="form-group">
                    <label>Transformation</label>
                    <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                        <option value="none">Aucune</option>
                        <option value="uppercase">Tout en Majuscules</option>
                        <option value="capitalize">Première lettre en Majuscule</option>
                        <option value="lowercase">Tout en minuscule</option>
                        <option value="full-width">Pleine largeur</option>
                    </select>
                </div>
                <div id="idTPFont">
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalSelectFont')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modalSelectFont">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div> {{-- /modal --}}