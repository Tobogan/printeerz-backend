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

            <h5 class="mt-2">Description: </h5>

            @if(strlen($product->description) != 0)
                <div><small>{{ $product->description }}</small></div>
            @else
                <td>{{ '...' }}</td>
                @if ($product->photo_illustration == NULL)
                    <div><i>(image par défault)</i></div>
                @endif
            @endif
            <br>

            <a class='btn btn-primary btn-sm mt-2' href="{{route('create_productVariants', $product->id)}}" title="Ajouter une variante du produit"><i class="uikon">add</i> Ajouter variante</a>
            <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_product', $product->id)}}" title="Modification du produit"> <i class="uikon">edit</i> Modifier</a>
            <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_product', $product->id)}}" title="Suppression du produit">Supprimer</a>
            <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_product')}}"> Retour </a>

            <hr>
        </div>
    </div>

    <!--~~~~~~~~~~~___________Variantes__________~~~~~~~~~~~~-->

    <table class="datatable table table-striped" >
            <thead>
                <tr>
                    <th></th>
                    <th>Couleur</th>
                    <th></th>
                    <th>Zone n°1</th>
                    <th></th>
                    <th>Zone n°2</th>
                    <th></th>
                    <th>Zone n°3</th>
                    <th></th>
                    <th>Zone n°4</th>
                    <th></th>
                    <th>Zone n°5</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        @foreach ($productVariants as $productVariant)
            @if($productVariant->product_id == $product->id)
                @if($productVariant->couleur->pantoneName)
                <td><img src="/uploads/{{$productVariant->couleur->pantoneName}}" class="miniRoundedImage" alt="pantone" ></td>
                @else
                <td><img src="/img/pointd'interrogation.jpg" class="miniRoundedImage" alt="pantone" ></td>
                @endif
                <td>{{ $productVariant->couleur->nom }}</td>
                @if($productVariant->image1)
                <td><img src="/uploads/{{$productVariant->image1}}" class="miniRoundedImage" alt="image1" ></td>
                @else
                <td></td>
                @endif
                <td>{{ $productVariant->zone1 }}</td>
                @if($productVariant->image2)
                <td><img src="/uploads/{{$productVariant->image2}}" class="miniRoundedImage" alt="image2" ></td>
                @else
                <td></td>
                @endif
                <td>{{ $productVariant->zone2 }}</td>
                @if($productVariant->image3)
                <td><img src="/uploads/{{$productVariant->image3}}" class="miniRoundedImage" alt="image3" ></td>
                @else
                <td></td>
                @endif
                <td>{{ $productVariant->zone3 }}</td>
                @if($productVariant->image4)
                <td><img src="/uploads/{{$productVariant->image4}}" class="miniRoundedImage" alt="image4" ></td>
                @else
                <td></td>
                @endif
                <td>{{ $productVariant->zone4 }}</td>
                @if($productVariant->image5)
                <td><img src="/uploads/{{$productVariant->image5}}" class="miniRoundedImage" alt="image5" ></td>
                @else
                <td></td>
                @endif
                <td>{{ $productVariant->zone5 }}</td>
                <td><a class='btn btn-danger' href="{{route('destroy_productVariants', $productVariant->id)}}" title="Supprimer la variante du produit">Supprimer</a></td></tr>
            @endif
        @endforeach
            </tbody>

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
    @endsection

@endsection