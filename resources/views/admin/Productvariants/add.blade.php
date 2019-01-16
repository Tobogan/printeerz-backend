@extends('layouts/templateAdmin')

@section('content')

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col">
            {!! Form::open(['action' => 'ProductvariantsController@store', 'files' => true]) !!}
                {{csrf_field()}}

            <!--~~~~~~~~~~~___________ COLOR __________~~~~~~~~~~~~-->
            <div class="mt-3" id="img_add_product">
                <div class="input-group mt-2">

                    {!! Form::select('couleur_id', $select_couleurs, null, ['class' => 'form-control mb-1', 'id' => 'select_color', 'placeholder' => '********************* Choisissez votre couleur n° *********************']) !!}                  
                
                <!--~~~~~~~~~~~___________Modal ajout Couleur en AJAX__________~~~~~~~~~~~~-->
                    <span class="input-group-btn"><button type="button" class="btn btn-success ml-1 mt-1" data-toggle="modal" style="float:right" data-target="#exampleModal"><i class="uikon">add</i></button></span>
                </div>

                <!--~~~~~~~~~~~___________TAILLES__________~~~~~~~~~~~~-->
                <div class="form-group mt-2">
                    {!! Form::label('tailles_list[]', 'Sélectionner les tailles disponibles : ') !!}
                    {!! Form::select('tailles_list[]', App\Taille::pluck('nom', 'id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
                </div>

                <!--~~~~~~~~~~~_____________________~~~~~~~~~~~~-->
                <div class="form-group mb-2 mt-2">
                    {{Form::text('zone1', null, array('class'=>'form-control', 'placeholder' => 'Saisissez le nom de la zone n°1 : ', 'id'=>'zone1', 'name'=>'zone1'))}}
                    {!! Form::file('image1', array('class' => 'image_couleur form-control  mt-2', 'id' => 'image_couleur')) !!}
                    <hr>
                    {{Form::text('zone2', null, array('class'=>'form-control', 'placeholder' => 'Saisissez le nom de la zone n°2 : ', 'id'=>'zone2', 'name'=>'zone2'))}}
                    {!! Form::file('image2', array('class' => 'image_couleur form-control  mt-2', 'id' => 'image2')) !!}
                    <hr>
                    {{Form::text('zone3', null, array('class'=>'form-control', 'placeholder' => 'Saisissez le nom de la zone n°3 : ', 'id'=>'zone3', 'name'=>'zone3'))}}
                    {!! Form::file('image3', array('class' => 'image_couleur form-control  mt-2', 'id' => 'image3')) !!}
                    <hr>
                    {{Form::text('zone4', null, array('class'=>'form-control', 'placeholder' => 'Saisissez le nom de la zone n°4 : ', 'id'=>'zone4', 'name'=>'zone4'))}}
                    {!! Form::file('image4', array('class' => 'image_couleur form-control  mt-2', 'id' => 'image4')) !!}
                    <hr>
                    {{Form::text('zone5', null, array('class'=>'form-control', 'placeholder' => 'Saisissez le nom de la zone n°5 : ', 'id'=>'zone5', 'name'=>'zone5'))}}
                    {!! Form::file('image5', array('class' => 'image_couleur form-control  mt-2', 'id' => 'image5')) !!}
                </div>

            </div>
            <input type="hidden" id="product_id" name="product_id" value='{{ $product_id }}'>

            <div>
            {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mt-2 mb-2', 'style' => 'float: right']) !!}       

            <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: left" href="{{route('index_product')}}"> Retour </a>

            {!! Form::close() !!}
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
                        <br>
                        {!! Form::file('pantone', array('id' => 'pantone', 'name' => 'pantone')) !!}
                    </div>
                    {{ Form::submit('Valider', array('name'=>'submit',  'class'=>'btn btn-primary btn-sm', 'id' => 'submit_modal', 'onclick' => "this.value='Ajoutée'")) }}  
                    {{Form::close()}}
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
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        });</script>

        {{-- <script type="text/Javascript">
            $('#zones_count1').change(function(){
        if(this.checked){
            $('#zone2').fadeOut('slow');
            $('#image2').fadeOut('slow');
            // $('#zone3_button').fadeIn('slow');
        }
    });
        </script> --}}
    @endsection
@endsection