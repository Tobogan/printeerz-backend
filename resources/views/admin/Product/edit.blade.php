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
    {!! Form::open(['action' => array('ProductController@update', 'id' => $product->id), 'files' => true]) !!}

        {{csrf_field()}}
        <!--~~~~~~~~~~~___________NOM__________~~~~~~~~~~~~-->
        <div class="form-group">
                {!! Form::label('nom', 'Entrer le nom : ', ['class' => 'mt-2']) !!}
                {!! Form::text('nom', $product->nom, ['class' => 'form-control']) !!}
            </div>

            <!--~~~~~~~~~~~___________REFERENCE__________~~~~~~~~~~~~-->
            <div class="form-group">
                {!! Form::label('référence', 'Entrer la référence fournisseur : ') !!}
                {!! Form::text('reference', $product->reference, ['class' => 'form-control']) !!}
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
                {!! Form::select('tailles_list[]', App\Taille::pluck('nom', 'id'), $product->tailles->pluck('id'), ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div>

            <!--~~~~~~~~~~~___________COULEURS__________~~~~~~~~~~~~-->
            <div class="form-group mt-2">
                {!! Form::label('couleurs_list[]', 'Sélectionner les couleurs disponibles  : ') !!}
                {!! Form::select('couleurs_list[]', App\Couleur::pluck('nom', 'id'), $product->couleurs->pluck('id'), ['class' => 'form-control', 'multiple' => 'true']) !!} 
            </div>

            {!! Form::label('description', 'Description : ') !!}
            <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici une description concernant le produit."></textarea>
    
    <hr>
        
               
        
            
            <!--~~~~~~~~~~~___________DESCRIPTION__________~~~~~~~~~~~~-->
           
        <div>
        
        <input type="hidden" class="form-control" name="actual_nom" value= '{{ $product->nom }}'>

        {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

        <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_product')}}"> Retour </a>

        {!! Form::close() !!}
    </div>
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

    <!--~~~~~~~~~~~___________SCRIPT ANIMATION INPUT IMAGE SELON ZONE SELECT__________~~~~~~~~~~~~-->
<script>
    
/*$(document).ready(function(){
    for(i=1; i<4; i++) {
        $('.color' + i + '_FAV_image').fadeOut();
        $('.color' + i + '_FAR_image').fadeOut();
        $('.color' + i + '_coeur_image').fadeOut();
    }
    $('#checkbox_FAV_color1').change(function(){
        if(this.checked)
            $('.color1_FAV_image').fadeIn('slow');
        else
            $('.color1_FAV_image').fadeOut('slow');
    });
    $('#checkbox_FAV_color2').change(function(){
        if(this.checked)
            $('.color2_FAV_image').fadeIn('slow');
        else
            $('.color2_FAV_image').fadeOut('slow');
    });
    $('#checkbox_FAV_color3').change(function(){
        if(this.checked)
            $('.color3_FAV_image').fadeIn('slow');
        else
            $('.color3_FAV_image').fadeOut('slow');
    });
    $('#checkbox_FAR_color1').change(function(){
        if(this.checked)
            $('.color1_FAR_image').fadeIn('slow');
        else
            $('.color1_FAR_image').fadeOut('slow');
    });
    $('#checkbox_FAR_color2').change(function(){
        if(this.checked)
            $('.color2_FAR_image').fadeIn('slow');
        else
            $('.color2_FAR_image').fadeOut('slow');
    });
    $('#checkbox_FAR_color3').change(function(){
        if(this.checked)
            $('.color3_FAR_image').fadeIn('slow');
        else
            $('.color3_FAR_image').fadeOut('slow');
    });
    $('#checkbox_coeur_color1').change(function(){
        if(this.checked)
            $('.color1_coeur_image').fadeIn('slow');
        else
            $('.color1_coeur_image').fadeOut('slow');
    });
    $('#checkbox_coeur_color2').change(function(){
        if(this.checked)
            $('.color2_coeur_image').fadeIn('slow');
        else
            $('.color2_coeur_image').fadeOut('slow');
    });
    $('#checkbox_coeur_color3').change(function(){
        if(this.checked)
            $('.color3_coeur_image').fadeIn('slow');
        else
            $('.color3_coeur_image').fadeOut('slow');
    });
});*/
</script>
@endsection
@endsection