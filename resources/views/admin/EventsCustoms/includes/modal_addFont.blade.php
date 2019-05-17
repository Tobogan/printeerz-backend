{{-- Add color modal --}}
<div class="modal fade" id="addFontModal" tabindex="-1" role="dialog" aria-labelledby="addFontModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ajouter une police</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted b-4">Merci d'ajouter le fichier de la police et de préciser son nom.</p>
                {!! Form::open(['id' => 'AddFont', 'files' => true, 'class' => 'mt-3']) !!}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="events_custom_event_id" id="events_custom_event_id"
                    value="{{$events_custom->event_id}}">
                <div class="form-group">
                    <label>
                        Nom
                    </label>
                    {{ Form::text('ec_font_title', null, array('class' => 'form-control mb-2','id' => 'ec_font_title')) }}
                </div>
                <div class="form-group">
                    <!-- Input -->
                    <label> Epaisseur</label>
                    <p class="text-muted b-4">Vous devez sélectionner l'épaisseur de cette police.</p>
                    <select name="font_weight" id="font_weight" class="form-control" data-toggle="select">
                        <option value="100">Thin (100)</option>
                        <option value="200">Extra Light (200)</option>
                        <option value="300">Light (300)</option>
                        <option value="400">Normal (400)</option>
                        <option value="500">Medium (500)</option>
                        <option value="600">Semi Bold (600)</option>
                        <option value="700">Bold (700)</option>
                        <option value="800">Extra Bold (800)</option>
                        <option value="900">Black (900)</option>
                    </select>
                </div>
                <div class="form-group">
                    <!-- Input -->
                    <label>Transformation</label>
                    <p class="text-muted b-4">Vous pouvez sélectionner une transformation pour cette police.</p>
                    <select name="font_transform" id="font_transform" class="form-control" data-toggle="select">
                        <option value="none">Aucune</option>
                        <option value="uppercase">Tout en Majuscules</option>
                        <option value="capitalize">Première lettre en Majuscule</option>
                        <option value="lowercase">Tout en minuscule</option>
                        <option value="full-width">Pleine largeur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Fichier
                    </label>
                    {!! Form::file('ec_font_url', array('id' => 'ec_font_url', 'name' => 'ec_font_url', 'class' =>
                    'form-control')) !!}
                </div>
                <div id="idTPFont">
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary', 'id' => 'submit_modalAddFont')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modalAddFont">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div> {{-- /modal --}}