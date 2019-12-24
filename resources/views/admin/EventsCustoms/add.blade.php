@extends('layouts/templateAdmin')
@section('title', 'Personnalisations')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                CREATION
                            </h6>
                            <h1 class="header-title">
                                Créer une personnalisation
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open([
            'action' => array('EventsCustomsController@store'),
            'files' => true,
            'class' => 'mb-4'
            ]) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-header-title">
                                Paramètres
                            </h4>
                            <hr>
                            <div class="form-group">
                                <label>
                                    Nom de la personnalisation
                                </label>
                                <p class="text-muted b-4">(Nom du produit + Nom de l'événement par défaut)</p>
                                {!! Form::text('title', $product->title.' + '.$event->title, [
                                'class' => 'form-control',
                                'placeholder' => 'Nom'
                                ])
                                !!}
                                {!! $errors->first('title', '<p class="help-block mt-2" style="color:red;">
                                    <small>:message</small></p>') !!}
                            </div>

                            <div class="form-group">
                                <label>
                                    Sélectionnez la zone d'impression
                                </label>
                                <p class="text-muted b-4">
                                    Sélectionnez la zone d'impression sur laquelle se trouvera cette personnalisation.
                                </p>
                                {!! Form::select('printzone_id', $select_printzones, null, [
                                'id' => 'printzone',
                                'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label>
                                    Sélectionnez la couleur
                                </label>
                                <p class="text-muted b-4">
                                    Sélectionnez la couleur du produit que vous souhaitez personnaliser.
                                </p>
                                {!! Form::select('products_variant_id', $variant_colors, null, [
                                'id' => 'products_variant_id',
                                'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label>
                                    Sélectionnez le gabarit
                                </label>
                                <p class="text-muted b-4">
                                    Sélectionnez le gabarit que vous souhaitez ajouter à cette personnalisation.
                                </p>
                                {!! Form::select('template_id', $select_templates, null, [
                                'id' => 'templateComponentType',
                                'class' => 'form-control'
                                ])
                                !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    Ajoutez l'image d'illustration
                                </label>
                                <p class="text-muted b-4">Ajouter ici une image illustrant cette personnalisation.</p>
                                <div class="form-group">
                                    {!! Form::file('custom_img', [
                                    'class' => 'form-control'
                                    ]) !!}
                                    {!! $errors->first('custom_img', '<p class="help-block mt-2" style="color:red;">
                                        <small>:message</small></p>') !!}
                                </div>
                            </div>
                        </div>
                        <div id="components"></div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="events_product_id" value="{{$events_product->id}}">
                <input type="hidden" class="form-control" name="event_id" value="{{$events_product->event_id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="buttons">
                            {!! Form::submit('Ajouter', [
                            'class' => 'btn btn-primary',
                            'style' => 'float:right'
                            ]) !!}
                            <a class='btn btn-secondary' style="float: left"
                                href="{{route('show_event', $events_product->event_id)}}">Annuler</a>
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
    </script>
    @endsection