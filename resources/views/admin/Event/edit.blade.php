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
    {!! Form::open(['action' => array('EventController@update', 'id' => $event->id), 'files' => true]) !!}
        {{csrf_field()}}

        <div class="form-group">
        {!! Form::label('nom', 'Entrer le nom : ') !!}
        {!! Form::text('nom', $event->nom, ['class' => 'form-control']) !!}

        {!! Form::label('annonceur', 'Entrer l\'annonceur (si différent du client): ') !!}
        {!! Form::text('annonceur', $event->annonceur, ['class' => 'form-control']) !!}

        <div class="form-group">
        {!! Form::label('customer_id', 'Sélectionner le client : ', ['class' => 'control-label']) !!}
        {!! Form::select('customer_id', $select, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
                {!! Form::label('product_id', 'Sélectionner les produits : ') !!}
                {!! Form::select('product_id', $select_products, null, ['class' => 'form-control', 'id' => 'select_product', 'onChange="getSelect(this)"','placeholder' => '**************************** Séléctionner le produit ****************************']) !!} 
        </div>

        <div class="form-group">
            {!! Form::label('users_list[]', 'Sélectionner les utilisateurs autorisés : ') !!}
            {!! Form::select('users_list[]', App\User::pluck('email','id'), $event->users->pluck('id'), ['class' => 'form-control', 'multiple' => 'true']) !!} 
        </div>

        <div class="form-group mt-2">
        {!! Form::label('lieu', 'Entrer le lieu : ') !!}
        {!! Form::text('lieu', $event->lieu, ['class' => 'form-control', 'placeholder' => 'Lieu:']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('type', 'Entrer le type d\'événement : ') !!}
        {!! Form::text('type', $event->type, ['class' => 'form-control', 'placeholder' => 'Type:']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('date', 'Entrer la date de l\'événement : ') !!}
        {{ Form::date('date', new \DateTime(), ['class' => 'form-control', 'placeholder' => 'Date:']) }}
        </div>

        {!! Form::label('image', 'Ajouter le logo de l\'événement: ') !!}
        {!! Form::file('image', array('class' => 'form-control')) !!}

        {!! Form::label('image1', 'Ajouter l\'image n°1: ') !!}
        {!! Form::file('image1', array('class' => 'form-control')) !!}

        {!! Form::label('image2', 'Ajouter l\'image n°2: ') !!}
        {!! Form::file('image2', array('class' => 'form-control')) !!}

        {!! Form::label('image3', 'Ajouter l\'image d\'accueil: ') !!}
        {!! Form::file('image3', array('class' => 'form-control')) !!}

        {!! Form::label('image4', 'Ajouter l\'image de veille: ') !!}
        {!! Form::file('image4', array('class' => 'form-control')) !!}

        {!! Form::label('BAT', 'Ajouter le BAT de l\'événement: ') !!}
        {!! Form::file('BAT', array('class' => 'form-control')) !!}

        {!! Form::label('description', 'Description : ') !!}
        <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici des informations concernant l'événement."></textarea>

        <!--~~~~~~~~~~~___________COLOR1__________~~~~~~~~~~~~-->
        <div id="img_add_product" class="mb-8">
            <div class="input-group mt-2">
                {!! Form::select('color1', $select_couleurs, $event->color1, ['class' => 'form-control mb-1', 'id' => 'select_color1', 'placeholder' => '********************* Choisissez votre couleur n°1 *********************']) !!}                  
            
            <!--~~~~~~~~~~~___________Modal ajout Couleur en AJAX__________~~~~~~~~~~~~-->
                <span class="input-group-btn"><button type="button" class="btn btn-success ml-1 mt-1" data-toggle="modal" style="float:right" data-target="#exampleModal"><i class="uikon">add</i></button></span>
            </div>

            <!--~~~~~~~~~~~___________CHOIX ZONES COLOR1__________~~~~~~~~~~~~-->
            {!! Form::label('checkbox1_zones', 'Zones disponibles: ') !!}
            <div id="checkbox1_zones"></div>

            <!--~~~~~~~~~~~___________IMAGES COLOR1__________~~~~~~~~~~~~-->
            <div class="form-group mb-2 mt-2">
                {!! Form::label('color1_FAV_image', 'Ajouter une photo pour la face avant: ', array('class' => 'color1_FAV_image')) !!}
                {!! Form::file('color1_FAV_image', array('class' => 'color1_FAV_image form-control mb-2 mt-2', 'id' => 'color1_FAV_image')) !!}
                {!! Form::select('color1_FAV_gabarit', $select_gabarits, $event->color1_FAV_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color1_FAV_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face avant *****************']) !!}
            </div>
            <div class="form-group mb-2">
                {!! Form::label('color1_coeur_image', 'Ajouter une photo pour la zone du coeur: ', array('class' => 'color1_coeur_image')) !!}
                {!! Form::file('color1_coeur_image', array('class' => 'color1_coeur_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color1_coeur_gabarit', $select_gabarits, $event->color1_coeur_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color1_coeur_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la zone coeur *****************']) !!}
            </div>
            <div class="form-group mb-2 mt-2">
                {!! Form::label('color1_FAR_image', 'Ajouter une photo pour la face arrière: ', array('class' => 'color1_FAR_image')) !!}
                {!! Form::file('color1_FAR_image', array('class' => 'color1_FAR_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color1_FAR_gabarit', $select_gabarits, $event->color1_FAR_gabarit, ['class' => 'form-control mb-8', 'id' => 'select_color1_FAR_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face arrière *****************']) !!}
            </div>
        </div>
        <br><br>
            
            <!--~~~~~~~~~~~___________COLOR2__________~~~~~~~~~~~~-->     
            <div id="img_add_product">   
            <div class="input-group mt-2 mb-8">
                {!! Form::select('color2', $select_couleurs, $event->color2, ['class' => 'form-control mb-1', 'id' => 'select_color2', 'placeholder' => '********************* Choisissez votre couleur n°2 *********************']) !!}
                
                <!--~~~~~~~~~~~___________Modal ajout Couleur en AJAX__________~~~~~~~~~~~~-->
                    <span class="input-group-btn"><button type="button" style="float:right" class="btn btn-success ml-1 mt-1" data-toggle="modal" data-target="#exampleModal"><i class="uikon">add</i></button></span>
                </div>

                <!--~~~~~~~~~~~___________CHOIX ZONES COLOR2__________~~~~~~~~~~~~-->
                {!! Form::label('checkbox2_zones', 'Zones disponibles: ') !!}
                <div id="checkbox2_zones"></div>

            <!--~~~~~~~~~~~___________IMAGES COLOR2__________~~~~~~~~~~~~-->
                <div class="form-group mb-2 mt-2">
                {!! Form::label('color2_FAV_image', 'Ajouter une photo pour la face avant: ', array('class' => 'color2_FAV_image')) !!}
                {!! Form::file('color2_FAV_image', array('class' => 'color2_FAV_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color2_FAV_gabarit', $select_gabarits, $event->color2_FAV_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color2_FAV_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face avant *****************']) !!}
            </div>
            
            <div class="form-group mb-2">
                {!! Form::label('color2_coeur_image', 'Ajouter une photo pour la zone du coeur: ', array('class' => 'color2_coeur_image')) !!}
                {!! Form::file('color2_coeur_image', array('class' => 'color2_coeur_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color2_coeur_gabarit', $select_gabarits, $event->color2_coeur_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color2_coeur_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la zone coeur *****************']) !!}
                </div>
                
            <div class="form-group mb-2 mt-2">
                {!! Form::label('color2_FAR_image', 'Ajouter une photo pour la face arrière: ', array('class' => 'color2_FAR_image')) !!}
                {!! Form::file('color2_FAR_image', array('class' => 'color2_FAR_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color2_FAR_gabarit', $select_gabarits, $event->color2_FAR_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color2_FAR_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face arrière *****************']) !!}
            </div>
        </div>
        <br><br>
        
            <!--~~~~~~~~~~~___________COLOR3__________~~~~~~~~~~~~-->
        <div id="img_add_product">
            <div class="input-group mt-2">
                {!! Form::select('color3', $select_couleurs, $event->color3, ['class' => 'form-control mb-1', 'id' => 'select_color3', 'placeholder' => '********************* Choisissez votre couleur n°3 *********************']) !!}
                
            <!--~~~~~~~~~~~___________Modal ajout Couleur en AJAX__________~~~~~~~~~~~~-->
                <span class="input-group-btn"><button type="button" style="float:right" class="btn btn-success mt-1 ml-1" data-toggle="modal" data-target="#exampleModal"><i class="uikon">add</i></button></span>
            </div>
            
            <!--~~~~~~~~~~~___________CHOIX ZONES COLOR3__________~~~~~~~~~~~~-->
            {!! Form::label('checkbox3_zones', 'Zones disponibles: ') !!}
            <div id="checkbox3_zones"></div>
            
            <!--~~~~~~~~~~~___________IMAGES COLOR3__________~~~~~~~~~~~~-->
            <div class="form-group mb-2 mt-2">
                {!! Form::label('color3_FAV_image', 'Ajouter une photo pour la face avant: ', array('class' => 'color3_FAV_image')) !!}
                {!! Form::file('color3_FAV_image', array('class' => 'color3_FAV_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color3_FAV_gabarit', $select_gabarits, $event->color3_FAV_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color3_FAV_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face avant *****************']) !!}
            </div>
            
            <div class="form-group mb-2">
                {!! Form::label('color3_coeur_image', 'Ajouter une photo pour la zone du coeur: ', array('class' => 'color3_coeur_image')) !!}
                {!! Form::file('color3_coeur_image', array('class' => 'color3_coeur_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color3_coeur_gabarit', $select_gabarits, $event->color3_coeur_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color3_coeur_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la zone coeur *****************']) !!}
                </div>
                
            <div class="form-group mb-2 mt-2">
                {!! Form::label('color3_FAR_image', 'Ajouter une photo pour la face arrière: ', array('class' => 'color3_FAR_image')) !!}
                {!! Form::file('color3_FAR_image', array('class' => 'color3_FAR_image form-control mb-2 mt-2')) !!}
                {!! Form::select('color3_FAR_gabarit', $select_gabarits, $event->color3_FAR_gabarit, ['class' => 'form-control mb-1', 'id' => 'select_color3_FAR_gabarit', 'placeholder' => '***************** Choisissez le gabarit pour la face arrière *****************']) !!}
            </div>
        </div>
        <input type="hidden" id="products" name="products" value='{{ $products }}'>

        <input type="hidden" class="form-control" name="actual_nom" value= '{{ $event->nom }}'>

        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_event')}}"> Retour </a> 

        {!! Form::close() !!}
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

@section('javascripts')
    <script type="text/Javascript">
        $('#exampleModal').on('show.bs.modal',function (event){
        var button = $(event.relatedTarget)
        var modal = $(this)
        });

        function getSelect(thisValue){
            var selected_product = thisValue.options[thisValue.selectedIndex].text;
            console.log(selected_product)
            for(var i=1; i<4; i++){
                if(selected_product.includes('(Face avant, Coeur, Face arrière)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';
                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAV" class="form-check-input ml-1 mr-1" id="checkbox_FAV_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face avant </label></div><div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_coeur" class="form-check-input ml-1 mr-1" id="checkbox_coeur_color'+i+'"><label class="form-check-label ml-1 mr-1" for="exampleCheck1">Coeur</label></div><div class="form-check form-check-inline"><input type="checkbox" name="color'+i+'_FAR" class="form-check-input ml-1 mr-1" id="checkbox_FAR_color'+i+'"><label class="form-check-label ml-1 mr-1" for="exampleCheck1">Face arrière</label></div>');
                }
                if(selected_product.includes('(Face avant, Coeur)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';

                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAV" class="form-check-input ml-1 mr-1" id="checkbox_FAV_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face avant </label><div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_coeur" class="form-check-input ml-1 mr-1" id="checkbox_coeur_color'+i+'"><label class="form-check-label" for="exampleCheck1">Coeur </label></div>');
                }
                if(selected_product.includes('(Face avant)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';

                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAV" class="form-check-input ml-1 mr-1" id="checkbox_FAV_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face avant </label></div>');
                }
                if(selected_product.includes('(Coeur, Face arrière)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';

                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_coeur" class="form-check-input ml-1 mr-1" id="checkbox_coeur_color'+i+'"><label class="form-check-label" for="exampleCheck1">Coeur </label></div><div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAR" class="form-check-input ml-1 mr-1" id="checkbox_FAR_color'+i+'"><label class="form-check-label ml-1 mr-1" for="exampleCheck1">Face arrière</label></div>');
                }
                if(selected_product.includes('(Face arrière)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';
                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAR" class="form-check-input ml-1 mr-1" id="checkbox_FAR_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face arrière</label></div>');
                }
                if(selected_product.includes('(Face avant, Face arrière)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';
                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAV" class="form-check-input ml-1 mr-1" id="checkbox_FAV_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face avant </label></div><div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAR" class="form-check-input ml-1 mr-1" id="checkbox_FAR_color'+i+'"><label class="form-check-label ml-1 mr-1" for="exampleCheck1">Face arrière</label></div>');
                }
                if(selected_product.includes('(Coeur)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';
                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_coeur" class="form-check-input ml-1 mr-1" id="checkbox_coeur_color'+i+'"><label class="form-check-label" for="exampleCheck1">Coeur </label></div>');
                }
                if(selected_product.includes('(Face arrière)')){
                    document.getElementById('checkbox'+i+'_zones').innerHTML = '';
                    $('#checkbox'+i+'_zones').append('<div class="form-check form-check-inline ml-1 mr-1"><input type="checkbox" name="color'+i+'_FAR" class="form-check-input ml-1 mr-1" id="checkbox_FAR_color'+i+'"><label class="form-check-label" for="exampleCheck1">Face arrière</label></div>');
                }
            }
        }
    </script>
    @endsection
@endsection