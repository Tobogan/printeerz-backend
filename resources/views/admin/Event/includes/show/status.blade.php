<div class="card" style="z-index:4;" style="float:center;">
    <ul class="progressbar mt-4 ml-10">
        @if($event->status == 'draft')
        <li class="active" data-status="draft" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="return confirm('Cette évenement n\'est plus prêt ?');"><a>Brouillon</a></li>
        @else
        <li data-status="draft" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="return confirm('Cette évenement n\'est plus prêt ?');"><a>Brouillon</a></li>
        @endif
        @if($event->status == 'to_test')
        <li class="active" data-status="to_test" data-event_id="{{$event->id}}" id="isNotReadyBtn">A tester</li>
        @else
        <li data-status="to_test" data-event_id="{{$event->id}}" id="isNotReadyBtn">A tester</li>
        @endif
        @if($event->status == 'validated')
        <li class="active" data-status="validated" data-event_id="{{$event->id}}" id="isNotReadyBtn">Validé</li>
        @else
        <li data-status="validated" data-event_id="{{$event->id}}" id="isNotReadyBtn">Validé</li>
        @endif
        @if($event->status == 'ready')
        <li class="active" data-status="ready" data-event_id="{{$event->id}}" id="isReadyBtn"
            data-target="#eventIsReadyModal">Prêt</li>
        @else
        <li data-status="ready" data-event_id="{{$event->id}}" id="isReadyBtn" data-toggle="modal"
            data-target="#eventIsReadyModal">Prêt
        </li>
        @endif
        @if($event->status == 'in_progress')
        <li class="active" data-status="in_progress" data-event_id="{{$event->id}}" data-toggle="modal" id="isReadyBtn"
            data-target="#eventIsReadyModal">En cours</li>
        @else
        <li data-status="in_progress" data-event_id="{{$event->id}}" id="isReadyBtn" data-toggle="modal"
            data-target="#eventIsReadyModal">En
            cours</li>
        @endif
        @if($event->status == 'done')
        <li class="active" data-status="done" data-event_id="{{$event->id}}" id="isReadyBtn" data-toggle="modal"
            data-target="#eventIsReadyModal">Terminé</li>
        @else
        <li data-status="done" data-event_id="{{$event->id}}" id="isReadyBtn" data-toggle="modal"
            data-target="#eventIsReadyModal">Terminé
        </li>
        @endif
    </ul>
</div>