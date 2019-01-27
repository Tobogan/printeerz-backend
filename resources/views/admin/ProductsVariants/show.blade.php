@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col row">
            <div id="scrollbarProduct" class="col-lg-3 mt-3">
            </div>
        <div class="col-lg-9">
            @if($product->photo_illustration != NULL)
            <br>
                <div class="image_principale">
                    <img  id="image_principale" width="100%" title="image_principale" src="/uploads/{{$product->photo_illustration}}" alt="Image produit">
                    
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


            <?php $list_couleurs = $product->couleurs->pluck('nom')->toArray();?>
            <h6 class="mb-2">Couleurs disponibles: <small><?php echo implode(', ', $list_couleurs); ?></small></h6>
            
            <h6>Zones séléctionnées:</h6>

            
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