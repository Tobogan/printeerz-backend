<div class="modal fade" id="eventIsReadyModal" tabindex="-1" role="dialog" aria-labelledby="eventIsReadyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" id="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ready to CUSTOM ?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['id' => 'eventIsReady']) !!}
            <input type="hidden" id="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="eventId" id="eventId" value="{{$event->id}}">
            <div class="modal-footer">
                <button id="close_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                {{ Form::submit('YEAH I AM MA GUEULE !', array('class'=>'btn btn-primary', 'id' => 'submit_modal_eventIsReady')) }}
                <button class="btn btn-primary d-none" type="button" disabled id="loading_modal_eventIsReady">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Génération...
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>