<?php $i=0; ?>
<li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
        aria-controls="general" aria-selected="true">Général</a>
</li>
@foreach($events_components as $events_component)
    @if($events_component->events_custom_id == $events_custom->id)
        @if($events_component->type == 'input')
            <?php $i++; ?>
            <li class="nav-item">
                <a class="nav-link" 
                    id="template_component_{{$events_component->id}}-tab" 
                    data-toggle="tab" 
                    href="#template_component_{{$events_component->id}}" 
                    role="tab" 
                    aria-controls="template_component_{{$events_component->id}}" 
                    aria-selected="true">{{$events_component->title}}
                </a>
            </li>
        @elseif($events_component->type == 'image')
        <li class="nav-item">
            <a class="nav-link" 
                id="template_component_{{$events_component->id}}-tab" 
                data-toggle="tab" 
                href="#template_component_{{$events_component->id}}" 
                role="tab" 
                aria-controls="template_component_{{$events_component->id}}" 
                aria-selected="true">{{$events_component->title}}
            </a>
        </li>
        @endif
    @endif
@endforeach