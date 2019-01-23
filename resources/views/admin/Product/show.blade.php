@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col row">
            <div id="scrollbarProduct" class="col-lg-3 mt-3">
            </div>
        <div class="col-lg-9">
            @if(file_exists(public_path('uploads/'.$product->image)) && !empty($product->image))
            <br>
                <div class="image_principale">
                    <img  id="image_principale" width="100%" title="image principale" src="/uploads/{{$product->image}}" alt="Image produit">
                </div>
            @else
            <br>
                <div class="image_principale"><img id="image_principale" title="image par défaut" width="100%" src="/img/tee-shirt-blanc-gildan.jpg" alt="img_default"></div>
            @endif
        </div>
    </div>

        <div class="col-lg-5 ml-3">
            <h4 class="mt-3">#{{ $product->id . ' ' . ucfirst($product->title) }}</h4>
            <hr>

            <h6 class="mb-2">Sexe: <small>{{ ucfirst($product->gender) }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->vendor["name"] }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->product_type }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->product_zones["title"] }}</small></h6>

            <h6 class="mb-2">Référence fournisseur: <small>{{ $product->vendor["reference"] }}</small></h6>

            <h5 class="mt-2">Description: </h5>

            @if(strlen($product->description) != 0)
                <div><small>{{ $product->description }}</small></div>
            @else
                <td>{{ '...' }}</td>
                @if ($product->image == NULL)
                    <div><i>(image par défault)</i></div>
                @endif
            @endif
            <br>
            <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_product', $product->id)}}" title="Modification du produit"> <i class="uikon">edit</i> Modifier</a>
            <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_product', $product->id)}}" title="Suppression du produit">Supprimer</a>
            <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_product')}}"> Retour </a>
            <hr>
        </div>
    </div>
    <br><hr>

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