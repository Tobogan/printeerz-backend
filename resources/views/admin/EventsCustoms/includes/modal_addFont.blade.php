{{-- Add color modal --}}
<div class="modal fade" id="addFontModal" tabindex="-1" role="dialog" aria-labelledby="addFontModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Ajouter une police</h2>
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
                    <p>Meci d'ajouter le fichier de la police et de préciser son nom.</p>
                    {!! Form::open(['id' => 'AddFont', 'files' => true, 'class' => 'mt-5']) !!}
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="events_custom_id" id="events_custom_id" value="{{$events_custom->id}}">
                    <input type="hidden" name="template_component_id" id="template_component_id" value="{{$template_component->id}}">
                    <div class="form-group">
                        <label>
                            Nom
                        </label>
                        {{ Form::text('title', null, array('class' => 'form-control mb-3','id' => 'ec_font_title')) }}
                    </div>
                    <div class="form-group">
                        <label>
                            Fichier
                        </label>
                        {!! Form::file('ec_font_url', array('id' => 'ec_font_url', 'name' => 'ec_font_url', 'class' => 'form-control')) !!}
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