<div class="modal fade" id="modalDeleteEvent" tabindex="-2" role="dialog" aria-labelledby="modalDeleteEventLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer cet événement ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir de supprimer <b>{{ $event->title }}</b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="{{route('destroy_event', $event->id)}}" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>