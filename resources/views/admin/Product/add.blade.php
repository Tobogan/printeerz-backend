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
                {!! Form::text('nom', null, ['class' => 'form-control mt-2', 'id' => 'nom','placeholder' => 'Nom du produit']) !!}
            </div>

            <!--~~~~~~~~~~~___________REFERENCE__________~~~~~~~~~~~~-->
            <div class="form-group">
                {!! Form::text('reference', null, ['class' => 'form-control', 'id' => 'reference', 'placeholder' => 'Référence fournisseur']) !!}
            </div>

            <!--~~~~~~~~~~~___________SEXE__________~~~~~~~~~~~~-->
            <div class="form-group">
                <div class="form-check">
                    <input id="sexe" class="form-check-input" type="radio" name="sexe" value="Homme" checked>
                    <label class="form-check-label" >
                        Homme
                    </label>
                </div>
                <div class="form-check">
                    <input id = "sexe" class="form-check-input" type="radio" name="sexe" value="Femme">
                    <label class="form-check-label">
                        Femme
                    </label>
                </div>
            </div>
        
            <!--~~~~~~~~~~~___________PHOTO PRINCIPALE__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('photo_illustration', 'Ajouter une photo d\'illustration: ') !!}
                {!! Form::file('photo_illustration', array('class' => 'form-control', 'id' => 'photo_illustration')) !!}
            </div>

            <!--~~~~~~~~~~~___________TAILLES__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('tailles_list[]', 'Sélectionner les tailles disponibles : ') !!}
                {!! Form::select('tailles_list[]', App\Taille::pluck('nom', 'id'), null, ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div>

            <!--~~~~~~~~~~~___________DESCRIPTION__________~~~~~~~~~~~~-->
            <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici une description concernant le produit."></textarea>
            <hr>
            <input type="hidden" name="select_couleurs" id="select_couleurs" value="{{ serialize($select_couleurs) }}">
            <div>
            {!! Form::submit('Ajouter', ['class' => 'btn btn-primary btn-sm mb-2 mt-2', 'style' => 'float: right']) !!}       

            {!! Form::close() !!}

            <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: left" href="{{route('index_product')}}"> Retour </a>

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
        var modal = $(this)
        });</script>
    @endsection
@endsection