@extends('layouts/templateAdmin') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            {!! Form::open(['action' => 'ProductsVariantsController@store', 'files' => true]) !!} {{csrf_field()}}

            <!--~~~~~~~~~~~___________ COLOR __________~~~~~~~~~~~~-->
            <div class="mt-3" id="img_add_product">
                <div class="input-group mt-2">

                    {!! Form::select('couleur_id', $select_couleurs, null, ['class' => 'form-control mb-1', 'id' => 'select_color', 'placeholder'
                    => '********************* Choisissez votre couleur n° *********************']) !!}

                    <!--~~~~~~~~~~~___________Modal ajout Couleur en AJAX__________~~~~~~~~~~~~-->
                    <span class="input-group-btn"><button type="button" class="btn btn-success ml-1 mt-1" data-toggle="modal" style="float:right" data-target="#exampleModal"><i class="uikon">add</i></button></span>
                </div>

                <!--~~~~~~~~~~~___________TAILLES__________~~~~~~~~~~~~-->
                {{-- {!! Form::select('taille_id', $select_tailles, null, ['class' => 'form-control mb-1 mt-2', 'placeholder' => '*********************
                Choisissez la taille *********************']) !!} --}} @foreach($tailles as $taille)
                <div class="form-check form-check-inline mt-2 mb-2">
                    <input class="form-check-input" name="taille_id[]" type="checkbox" id="{{$taille->nom}}" value="{{$taille->id}}">
                    <label class="form-check-label" for="inlineCheckbox1">{{$taille->nom}}</label>
                </div>
                @endforeach

                <br>
                <!--~~~~~~~~~~~___________QTY__________~~~~~~~~~~~~-->
                {!! Form::label('qty', 'Entrer la quantité : ') !!} {!! Form::number('qty', 0, ['class' => 'form-control']) !!}

                <!--~~~~~~~~~~~_____________________~~~~~~~~~~~~-->
                <div class="form-group mb-2 mt-2">
                    {{Form::text('zone1', null, array('class'=>'form-control mt-4', 'placeholder' => 'Saisissez le nom de la zone n°1 : ', 'id'=>'zone1',
                    'name'=>'zone1'))}} {!! Form::file('image1[]', array('class' => 'image_couleur form-control mt-2', 'multiple'
                    => true, 'id' => 'image_couleur')) !!}

                    <!--~~~~~~~~~~~___________Gabarit1__________~~~~~~~~~~~~-->
                    {!! Form::select('gabarit1', ['1' => 'Gabarit 1', '2' => 'Gabarit 2', '3' => 'Gabarit 3', '4' => 'Gabarit 4',], null, ['class'
                    => 'form-control mb-1 mt-1', 'placeholder' => 'Sélectionner le gabarit 1']) !!}

                    <hr> {{Form::text('zone2', null, array('class'=>'form-control mt-4', 'placeholder' => 'Saisissez le nom de
                    la zone n°2 : ', 'id'=>'zone2', 'name'=>'zone2'))}} {!! Form::file('image2[]', array('class' => 'image_couleur
                    form-control mt-2', 'id' => 'image2')) !!}
                    <!--~~~~~~~~~~~___________Gabarit1__________~~~~~~~~~~~~-->
                    {!! Form::select('gabarit2', ['1' => 'Gabarit 1', '2' => 'Gabarit 2', '3' => 'Gabarit 3', '4' => 'Gabarit 4',], null, ['class'
                    => 'form-control mb-1 mt-1', 'placeholder' => 'Sélectionner le gabarit 2']) !!}

                    <hr> {{Form::text('zone3', null, array('class'=>'form-control mt-4', 'placeholder' => 'Saisissez le nom de
                    la zone n°2 : ', 'id'=>'zone3', 'name'=>'zone3'))}} {!! Form::file('image3[]', array('class' => 'image_couleur
                    form-control mt-2', 'id' => 'image3')) !!}
                    <!--~~~~~~~~~~~___________Gabarit1__________~~~~~~~~~~~~-->
                    {!! Form::select('gabarit3', ['1' => 'Gabarit 1', '2' => 'Gabarit 2', '3' => 'Gabarit 3', '4' => 'Gabarit 4',], null, ['class'
                    => 'form-control mb-1 mt-1', 'placeholder' => 'Sélectionner le gabarit 3']) !!}

                    <hr> {{Form::text('zone4', null, array('class'=>'form-control mt-4', 'placeholder' => 'Saisissez le nom de
                    la zone n°2 : ', 'id'=>'zone4', 'name'=>'zone4'))}} {!! Form::file('image4[]', array('class' => 'image_couleur
                    form-control mt-2', 'id' => 'image4')) !!}
                    <!--~~~~~~~~~~~___________Gabarit1__________~~~~~~~~~~~~-->
                    {!! Form::select('gabarit4', ['1' => 'Gabarit 1', '2' => 'Gabarit 2', '3' => 'Gabarit 3', '4' => 'Gabarit 4',], null, ['class'
                    => 'form-control mb-1 mt-1', 'placeholder' => 'Sélectionner le gabarit 4']) !!}

                    <hr>
                </div>

            </div>
            <input type="hidden" id="product_id" name="product_id" value='{{ $product_id }}'>

            <div>
                {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mt-2 mb-2', 'style' => 'float: right']) !!}

                <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: left" href="{{route('index_product')}}"> Retour </a>                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!--~~~~~~~~~~~___________MODAL AJOUT DE COULEUR__________~~~~~~~~~~~~-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle couleur</h5>
                    @if (session('status'))
                    <div class="alert alert-success mt-1 mb-2">
                        {{ session('status') }}
                    </div>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'AddColorAjax', 'files' => true]) !!}
                    <input type="hidden" name="select_couleurs" id="select_couleurs" value="{{ serialize($select_couleurs) }}">
                    <div class="form-group">
                        {{Form::text('nom', null, array('class'=>'form-control', 'placeholder' => 'Ajouter une couleur', 'id'=>'nom', 'name'=>'nom'))}}
                        {!! Form::label('pantone', 'Ajouter le pantone: ') !!}
                        <br> {!! Form::file('pantone', array('id' => 'pantone', 'name' => 'pantone')) !!}
                    </div>
                    {{ Form::submit('Valider', array('name'=>'submit', 'class'=>'btn btn-primary btn-sm', 'id' => 'submit_modal', 'onclick' =>
                    "this.value='Ajoutée'")) }} {{Form::close()}}
                </div>
                <div class="modal-footer">
                    <button id="close_modal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>


@section('javascripts')
<script type="text/Javascript">
    $('#exampleModal').on('show.bs.modal', function (event) { var button = $(event.relatedTarget) var modal = $(this) });
</script>

{{--
<script type="text/Javascript">
    $('#zones_count1').change(function(){ if(this.checked){ $('#zone2').fadeOut('slow'); $('#image2').fadeOut('slow'); // $('#zone3_button').fadeIn('slow');
    } });
</script> --}}
@endsection

@endsection