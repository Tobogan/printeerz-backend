@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col row">
            <div id="scrollbarProduct" class="col-lg-3 mt-3">
                {{-- @if($product->color1_coeur_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2" id="img_color1_coeur_imageName" title="Couleur n°1 - Zone 'Coeur'" width="100%" src="/uploads/{{$product->color1_coeur_imageName}}" alt="Image produit"></div>
                @endif
                @if($product->color1_FAV_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2"  id="img_color1_FAV_imageName" title="Couleur n°1 - Zone 'Face avant'" width="100%" src="/uploads/{{$product->color1_FAV_imageName}}" alt="Image produit"></div>
                @endif
                @if($product->color1_FAR_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2"  id="img_color1_FAR_imageName" title="Couleur n°1 - Zone 'Face arrière'" width="100%" src="/uploads/{{$product->color1_FAR_imageName}}" alt="Image produit"></div>
                @endif
                @if($product->color2_coeur_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2"  id="img_color2_coeur_imageName" title="Couleur n°2 - Zone 'Coeur'" width="100%" src="/uploads/{{$product->color2_coeur_imageName}}" alt="Image produit"></div>
                @endif
                @if($product->color2_FAV_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2"  id="img_color2_FAV_imageName" title="Couleur n°2 - Zone 'Face avant'" width="100%" src="/uploads/{{$product->color2_FAV_imageName}}" alt="Image produit"></div>
                    @endif
                @if($product->color2_FAR_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2" id="img_color2_FAR_imageName" title="Couleur n°2 - Zone 'Face arrière'"width="100%" src="/uploads/{{$product->color2_FAR_imageName}}" alt="Image produit"></div>
                    @endif   
                @if($product->color3_coeur_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2" id="img_color3_coeur_imageName" title="Couleur n°3 - Zone 'Coeur'" width="100%" src="/uploads/{{$product->color3_coeur_imageName}}" alt="Image produit"></div>
                    @endif
                @if($product->color3_FAV_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2" id="img_color3_FAV_imageName" title="Couleur n°3 - Zone 'Face avant'"width="100%" src="/uploads/{{$product->color3_FAV_imageName}}" alt="Image produit"></div>
                    @endif
                @if($product->color3_FAR_imageName != NULL)
                    <div><img class="side_img mb-2 mt-2" id="img_color3_FAR_imageName" title="Couleur n°3 - Zone 'Face arrière'"width="100%" src="/uploads/{{$product->color3_FAR_imageName}}" alt="Image produit"></div> 
                @endif --}}
            </div>
        <div class="col-lg-9">
            @if($product->photo_illustration != NULL)
            <br>
                <div class="image_principale">
                    <img  id="image_principale" width="100%" title="image principale" src="/uploads/{{$product->photo_illustration}}" alt="Image produit">
                    
                </div>
            @else
            <br>
                <div class="image_principale"><img id="image_principale" title="image par défaut" width="100%" src="/img/tee-shirt-blanc-gildan.jpg" alt="img_default"></div>
            @endif
        </div>
    </div>

        <div class="col-lg-5 ml-3">
            <h4 class="mt-3">#{{ $product->id . ' ' . ucfirst($product->nom) }}</h4>
            <hr>

            <h6 class="mb-2">Sexe: <small>{{ ucfirst($product->sexe) }}</small></h6>

            <h6 class="mb-2">Référence fournisseur: <small>{{ $product->reference }}</small></h6>

            <?php $list_tailles = $product->tailles->pluck('nom')->toArray();?>
            <h6 class="mb-2">Tailles disponibles: <small><?php echo implode(', ', $list_tailles); ?></small></h6>

            <?php $list_couleurs = $product->couleurs->pluck('nom')->toArray();?>
            <h6 class="mb-2">Couleurs disponibles: <small><?php echo implode(', ', $list_couleurs); ?></small></h6>

            <h6 class="mt-2">Couleurs de produit: </h6>
            <?php $list_Productvariants = $event->Productvariants->pluck('nom')->toArray();?>
        @if($list_Productvariants)
            <div><small><?php echo implode(', ', $list_Productvariants); ?></small></div>
        @else
            <div><small>Pas d'utilisateurs spécifiés</small></div>
        @endif
            
            <h6>Zones séléctionnées:</h6>
                {{-- @if($product->color_FAV != 0)
                <small>- Face avant</small><br>
                @endif
                @if($product->color_coeur != 0)
                <small>- Coeur</small><br>
                @endif
                @if($product->color_FAR != 0)
                <small>- Face arrière</small>
                @endif --}}
            
                <!--ICI gisait les couleurs zones et gabarits-->

            <?php //$list_couleurs = $product->couleurs->pluck('nom')->toArray();?>

            <div><?php //echo implode(', ', $list_couleurs); ?></div>
            
            <h5 class="mt-2">Description: </h5>

            @if(strlen($product->description) != 0)
                <div><small>{{ $product->description }}</small></div>
            @else
                <td>{{ '...' }}</td>
                @if (!$product->imageName)
                    <div><i>(image par défault)</i></div>
                @endif
            @endif
            <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_product', $product->id)}}" title="Modification du produit"> <i class="uikon">edit</i> Modifier</a>
            <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_product', $product->id)}}" title="Suppression du produit">Supprimer</a>
            <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_product')}}"> Retour </a>
            <hr>
        </div>
    </div> 

    {{-- <div class="row">
        <div class="col-lg-3">
            <div class="your-class mt-4">
                @if($product->coeur_imageName != NULL)
                    <div><img width="100%"  src="/uploads/{{ $product->coeur_imageName }}" alt="Zone d'impression du produitt"></div>  
                @endif
                
                @if($product->face_avant_imageName != NULL)
                    <div><img width="100%"  src="/uploads/{{ $product->face_avant_imageName }}" alt="Zone d'impression du produitt"></div>
                @endif

                @if($product->face_arriere_imageName != NULL)
                    <div><img width="100%"  src="/uploads/{{ $product->face_arriere_imageName }}" alt="Zone d'impression du produitt"></div>
                @endif
            </div>  
            <br><br>
        </div>
            <div class="col"></div>
    </div> --}}
</div>

    @section('javascripts')
    <script> var host = "{{URL::to('/')}}"; </script>

    <script type="text/javascript">
        $(document).ready(function(){
        $('.your-class').slick();
    });
    </script>
    <script>
        $('.side_img').on('click', function(){
            swap(this)
        })
    function swap(img) {
        var tmp = img.src;
        img.src = document.getElementById('image_principale').src;
        document.getElementById('image_principale').src = tmp;

        var tmp2 = img.title;
        img.title = document.getElementById('image_principale').title;
        document.getElementById('image_principale').title = tmp2;
  }
    </script>
    {{-- <script type="text/javascript">
        $('.image_principale').each(function() {
        $(this).after( $(this).attr('title') ); 
        });
        </script> --}}
    @endsection

@endsection