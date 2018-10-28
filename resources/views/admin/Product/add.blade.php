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
            {!! Form::open(['action' => 'ProductController@store', 'files' => true]) !!}
                {{csrf_field()}}
            <!--~~~~~~~~~~~___________NOM__________~~~~~~~~~~~~-->
            <div class="form-group">
                {!! Form::label('nom', 'Entrer le nom : ', ['class' => 'mt-2']) !!}
                {!! Form::text('nom', null, ['class' => 'form-control']) !!}
            </div>

            <!--~~~~~~~~~~~___________REFERENCE__________~~~~~~~~~~~~-->
            <div class="form-group">
                {!! Form::label('référence', 'Entrer la référence fournisseur : ') !!}
                {!! Form::text('reference', null, ['class' => 'form-control']) !!}
            </div>

            <!--~~~~~~~~~~~___________SEXE__________~~~~~~~~~~~~-->
            <div class="form-group">
                {!! Form::label('sexe', 'Sélectionner le sexe : ') !!}
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexe" value="Homme" checked>
                    <label class="form-check-label" >
                        Homme
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexe" value="Femme">
                    <label class="form-check-label">
                        Femme
                    </label>
                </div>
            </div>
        
            <!--~~~~~~~~~~~___________PHOTO PRINCIPALE__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('image', 'Ajouter une photo de profil: ') !!}
                {!! Form::file('image', array('class' => 'form-control')) !!}
            </div>

            <!--~~~~~~~~~~~___________TAILLES__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('tailles_list[]', 'Sélectionner les tailles disponibles  : ') !!}
                {!! Form::select('tailles_list[]', App\Taille::pluck('nom', 'id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div>

            <!--~~~~~~~~~~~___________COULEURS__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('couleurs_list[]', 'Sélectionner les couleurs disponibles  : ') !!}
                {!! Form::select('couleurs_list[]', App\Couleur::pluck('nom', 'id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div>

            <!--~~~~~~~~~~~___________ZONES__________~~~~~~~~~~~~-->
            {{-- <div class="form-group mt-2">
                {!! Form::label('zones_list[]', 'Sélectionner les zones disponibles  : ') !!}
                {!! Form::select('zones_list[]', App\Zone::pluck('nom', 'id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div> --}}

            <!--~~~~~~~~~~~___________CHOIX ZONES __________~~~~~~~~~~~~-->
            {!! Form::label('zones', 'Sélectionner les zones disponibles  : ') !!}
            <br>
            <div class="form-check form-check-inline mb-2">
                    <input type="checkbox" name="color_FAV" class="form-check-input" id="checkbox_FAV_color1">
                    <label class="form-check-label" for="exampleCheck1">Face avant</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="color_coeur" class="form-check-input" id="checkbox_coeur_color1">
                    <label class="form-check-label" for="exampleCheck1">Coeur</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="color_FAR" class="form-check-input" id="checkbox_FAR_color1">
                    <label class="form-check-label" for="exampleCheck1">Face arrière</label>
                </div>
            <br>
            {!! Form::label('description', 'Description : ') !!}
            <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici une description concernant le produit."></textarea>
    
            <hr>
            <!--~~~~~~~~~~~___________DESCRIPTION__________~~~~~~~~~~~~-->
            <div>
            {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mt-2 mb-2', 'style' => 'float: right']) !!}       

            <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: left" href="{{route('index_product')}}"> Retour </a>

            {!! Form::close() !!}
        </div>
    </div>
</div>
     @section('javascripts')
    {{-- <script type="text/javascript">
        $("select[name='select_zone']").change(function(){
        var value = $(this).val();
        $("input#optionOutput").val(value);
        });
    </script>  --}}
    <script type="text/Javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        //var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ' + recipient)
        //modal.find('.modal-body input').val(recipient)
        });
    </script>    
    @endsection
@endsection