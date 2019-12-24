<?php $i=0; ?>
<li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general"
        aria-selected="true">Général</a>
</li>
@foreach($components as $events_component)
<?php $i++; ?>
<li class="nav-item">
    <a class="nav-link" id="template_component_{{$events_component->id}}-tab" data-toggle="tab"
        href="#template_component_{{$events_component->id}}" role="tab"
        aria-controls="template_component_{{$events_component->id}}" aria-selected="true">{{$events_component->title}}
    </a>
</li>
@endforeach