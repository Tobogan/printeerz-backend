<?php $i=0; ?>
<li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
        aria-controls="general" aria-selected="true">Général</a>
</li>
@foreach($templates as $template)
<?php $array_template = $events_custom->template ?>
    @if($template->id == reset($array_template))
        @foreach($template_components as $template_component)
            @foreach($template->components_ids as $component_id)
                @if($template_component->id == $component_id['id'])
                    @if($template_component->type = 'input')
                        <?php $i++; ?>
                        <li class="nav-item">
                            <a class="nav-link" 
                               id="template_component_{{$template_component->id}}-tab" 
                               data-toggle="tab" 
                               href="#template_component_{{$template_component->id}}" 
                               role="tab" 
                               aria-controls="template_component_{{$template_component->id}}" 
                               aria-selected="true">{{$template_component->title}}
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        @endforeach
    @endif
@endforeach