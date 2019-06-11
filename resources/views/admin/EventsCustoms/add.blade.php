@extends('layouts/templateAdmin')
@section('title', 'Personnalisations')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header -->
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                CREATION
                            </h6>
                            <!-- Title -->
                            <h1 class="header-title">
                                Créer une personnalisation
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            @section('alerts')
            @if (session('status'))
                <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert"
                    data-dismiss="alert">
                    {{ session('status') }}
                </div>
            @endif
        @endsection
            {!! Form::open(['action' => array('EventsCustomsController@store'), 'files' => true,'class' =>
            'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    
                    <!-- First name -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-header-title">
                                Paramètres
                            </h4>
                            <hr>
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Nom de la personnalisation
                                </label>
                                <p class="text-muted b-4">(Nom du produit + Nom de l'événement par défaut)</p>
                                <!-- Input text title-->
                                {!! Form::text('title', $product->title.' + '.$event->name, ['class' => 'form-control', 'placeholder' => 'Nom'])
                                !!}
                                {!! $errors->first('title', '<p class="help-block mt-2" style="color:red;"><small>:message</small></p>') !!}
                            </div>

                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Sélectionnez la zone d'impression
                                </label>
                                <p class="text-muted b-4">Sélectionnez la zone d'impression sur laquelle se trouvera cette personnalisation.</p>
                                <!-- Input -->
                                {!! Form::select('printzone_id', $select_printzones, null, ['id' => 'printzone', 'class' => 'form-control'])
                                !!}
                            </div>
                            
                            <!-- Input select template-->
                            <div class="form-group">
                                <!-- Label -->
                                <label>
                                    Sélectionnez le gabarit
                                </label>
                                <p class="text-muted b-4">Sélectionnez quel gabarit vous souhaitez ajouter à cette personnalisation.</p>
                                <!-- Input -->
                                {!! Form::select('template_id', $select_templates, null, ['id' => 'templateComponentType', 'class' => 'form-control'])
                                !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Ajoutez l'image d'illustration
                                </label>
                                <p class="text-muted b-4">Vous pouvez ajouter ici une image illustrant cette personnalisation.</p>
                                <div class="custom-file">
                                    <!-- Input -->
                                    {!! Form::file('custom_img', array('class' => 'form-control custom-file-input', 'id' =>'photo_profile')) !!}
                                    <label class="custom-file-label" for="photo_profile">Ajoutez l'image</label>
                                </div>
                            </div>
                        </div>
                    </div><!-- /Card paramètres -->
                    <div id="components"></div>
                </div>
            </div>
            <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
            <input type="hidden" class="form-control" name="event_id" value="{{$events_product->event_id}}">
            {{-- hidden for edit --}}
            {{-- <input type="hidden" class="form-control" name="actual_title" value="{{$template_component->title}}">
            <input type="hidden" class="form-control" name="template_component_id" value="{{$template_component->id}}"> --}}
            <div class="row">
                <div class="col-12">
                    <div class="buttons">
                        {!! Form::submit('Ajouter', ['class' => 'btn btn-primary', 'style' => 'float:right']) !!}
                        <a class='btn btn-secondary' style="float: left" href="{{route('show_event', $events_product->event_id)}}">Annuler</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script type="text/Javascript">
    // $('#templateComponentType').change(function () {
    //     var value = $(this).val();
    //     $.ajax({
    //         type: 'GET', //THIS NEEDS TO BE GET
    //         url: '/templates',
    //         success: function (data) {
    //             console.log(data);
    //             $('#components').append('yo');
    //         },
    //         error:function() { 
    //             console.log(data);
    //         }
    //     });
    // });
</script>
@endsection

{{-- $('#components').append(
    '@foreach($templates as $template)
        @if($template->id==' + value + ')
            @if($templage->components_ids != null)
                @foreach($template_components as $template_component)
                    @foreach($template->components_ids as $component_id)
                        @if($template_component->id == $component_id)
                            @if($template_component->type =="input")
                                <div class="form-group">
                                    <select name="type" class="form-control" data-toggle="select">
                                        <option value="none">Aucun</option>
                                        <option value="input" selected>Champ de texte</option>
                                        <option value="image">Image</option>
                                        <option value="text" disabled>Texte fixe</option>
                                        <option value="instagram" disabled>Instagram</option>
                                    </select>
                                </div>
                            @endif
                            @if($template_component->type=="image")
                                <div class="form-group">
                                    <select name="type" class="form-control" data-toggle="select">
                                        <option value="none">Aucun</option>
                                        <option value="input">Champ de texte</option>
                                        <option value="image" selected>Image</option>
                                        <option value="text" disabled>Texte fixe</option>
                                        <option value="instagram" disabled>Instagram</option>
                                    </select>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @endif
        @endif
    @endforeach'
); --}}