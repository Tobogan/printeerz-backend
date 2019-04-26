<?php $i=0; ?>
<li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
        aria-controls="general" aria-selected="true">Général</a>
</li>
@foreach($events_custom->components as $component)
        @if($component['component_type'] == 'input')
            <?php $i++; ?>
            <li class="nav-item">
                <a class="nav-link" 
                    id="template_component_{{$component['events_component_id']}}-tab" 
                    data-toggle="tab" 
                    href="#template_component_{{$component['events_component_id']}}" 
                    role="tab" 
                    aria-controls="template_component_{{$component['events_component_id']}}" 
                    aria-selected="true">{{$component['title']}}
                </a>
            </li>
        @elseif($component['component_type'] == 'image')
        <li class="nav-item">
            <a class="nav-link" 
                id="template_component_{{$component['events_component_id']}}-tab" 
                data-toggle="tab" 
                href="#template_component_{{$component['events_component_id']}}" 
                role="tab" 
                aria-controls="template_component_{{$component['events_component_id']}}" 
                aria-selected="true">{{$component['title']}}
            </a>
        </li>
        @endif
@endforeach