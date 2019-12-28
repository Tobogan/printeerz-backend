<?php $i=0; ?>
<li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general"
        aria-selected="true">Général</a>
</li>
@foreach($events_custom->template['components'] as $component)
@if($component['type'] == 'input')
<?php $i++; ?>
<li class="nav-item">
    <a class="nav-link" id="template_component_{{$component['id']}}-tab" data-toggle="tab"
        href="#template_component_{{$component['id']}}" role="tab"
        aria-controls="template_component_{{$component['id']}}" aria-selected="true">{{$component['title']}}
    </a>
</li>
@elseif($component['type'] == 'image')
<li class="nav-item">
    <a class="nav-link" id="template_component_{{$component['id']}}-tab" data-toggle="tab"
        href="#template_component_{{$component['id']}}" role="tab"
        aria-controls="template_component_{{$component['id']}}" aria-selected="true">{{$component['title']}}
    </a>
</li>
@endif
@endforeach