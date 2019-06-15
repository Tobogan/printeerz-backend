<div class="card" style="z-index:4;" style="float:center;">
    <ul class="progressbar mt-4 ml-10">
        @if($event->status == 'draft')
        {{-- Status draft --}}
        <li class="active">Brouillon</li>
        {{-- Status To test --}}
        <li class="progressbarClickable" data-status="to_test" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            A tester</li>
        {{-- Status Validated --}}
        <li>Validé</li>
        {{-- Status Ready --}}
        <li>Prêt</li>
        {{-- Status In progress --}}
        <li>En cours</li>
        {{-- Status Done --}}
        <li>Terminé</li>
        @endif

        @if($event->status == 'to_test')
        {{-- Status draft --}}
        <li class="progressbarClickable" data-status="draft" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Brouillon</li>
        {{-- Status To test --}}
        <li class="active">A tester</li>
        {{-- Status Validated --}}
        <li class="progressbarClickable" data-status="validated" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Validé</li>
        {{-- Status Ready --}}
        <li>Prêt</li>
        {{-- Status In progress --}}
        <li>En cours</li>
        {{-- Status Done --}}
        <li>Terminé</li>
        @endif

        @if($event->status == 'validated')
        {{-- Status draft --}}
        <li class="progressbarClickable" data-status="draft" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Brouillon
        </li>
        {{-- Status To test --}}
        <li class="progressbarClickable" data-status="to_test" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            A tester</li>
        {{-- Status Validated --}}
        <li class="active">Validé</li>
        {{-- Status Ready --}}
        <li class="progressbarClickable" data-status="ready" data-event_id="{{$event->id}}" id="isReadyBtn"
            data-toggle="modal" data-target="#eventIsReadyModal"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Prêt</li>
        {{-- Status In progress --}}
        <li>En cours</li>
        {{-- Status Done --}}
        <li>Terminé</li>
        @endif

        @if($event->status == 'ready')
        {{-- Status draft --}}
        <li class="progressbarClickable" data-status="draft" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Brouillon</li>
        {{-- Status To test --}}
        <li class="progressbarClickable" data-status="to_test" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            A
            tester
        </li>
        {{-- Status Validated --}}
        <li class="progressbarClickable" data-status="validated" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Validé
        </li>
        {{-- Status Ready --}}
        <li class="active">Prêt</li>
        {{-- Status In progress --}}
        <li class="progressbarClickable" data-status="in_progress" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            En cours</li>
        {{-- Status Done --}}
        <li>Terminé</li>
        @endif

        @if($event->status == 'in_progress')
        {{-- Status draft --}}
        <li class="progressbarClickable" data-status="draft" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Brouillon</li>
        {{-- Status To test --}}
        <li class="progressbarClickable" data-status="to_test" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            A
            tester
        </li>
        {{-- Status Validated --}}
        <li class="progressbarClickable" data-status="validated" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Validé
        </li>
        {{-- Status Ready --}}
        <li class="progressbarClickable" data-status="ready" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Prêt</li>
        {{-- Status In progress --}}
        <li class="active">En cours</li>
        {{-- Status Done --}}
        <li class="progressbarClickable" data-status="done" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Terminé</li>
        @endif

        @if($event->status == 'done')
        {{-- Status draft --}}
        <li class="progressbarClickable" data-status="draft" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Brouillon</li>
        {{-- Status To test --}}
        <li class="progressbarClickable" data-status="to_test" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            A
            tester
        </li>
        {{-- Status Validated --}}
        <li class="progressbarClickable" data-status="validated" data-event_id="{{$event->id}}" id="isNotReadyBtn"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Validé
        </li>
        {{-- Status Ready --}}
        <li class="progressbarClickable" data-status="ready" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            Prêt</li>
        {{-- Status In progress --}}
        <li class="progressbarClickable" data-status="in_progress" data-event_id="{{$event->id}}"
            onclick="var new_status = $(this).attr('data-status');var event_id = $(this).attr('data-event_id'); changeEventStatus(new_status,event_id);">
            En cours</li>
        {{-- Status Done --}}
        <li class="active">Terminé</li>
        @endif
    </ul>
</div>

@section('javascripts')
@parent()
<script type="text/Javascript">
    function changeEventStatus(new_status,event_id) {
    // var new_status = $(this).attr('data-status');
    // var event_id = $(this).attr('data-event_id');
    // if (confirm('ëtes-vous sûr de vouloir changer le status de l\'événement')) {
    if (new_status !== "ready") {
    $.ajax({
    type: "POST",
    url: '/admin/Event/changeStatus/' + event_id + '/' + new_status,
    success: function (res) {
    console.log(res);
    location.reload();
    }
    });
    } else {
    $.ajax({
    type: "POST",
    url: '/admin/Event/changeStatus/' + event_id + '/' + new_status,
    success: function (res) {
    console.log(res);
    }
    });
    }
    }
</script>
@endsection