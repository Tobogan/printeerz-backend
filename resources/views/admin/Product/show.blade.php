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
        <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_product', $product->id)}}" title="Modification du produit">Modifier</a>
        <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_product', $product->id)}}" title="Suppression du produit">Supprimer</a>
        <!--<a role="button" class='btn btn-primary btn-sm mt-2' href="{{route('create_productsVariants')}}" title="Ajouter une variante">Ajouter une variante</a>-->
        <span class="input-group-btn"><button type="button" class="btn btn-success btn-sm ml-1 mt-1" data-toggle="modal" style="float:right" data-target="#exampleModal">Ajouter une variante</button></span>
        <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_product')}}"> Retour </a>
        <hr>
    </div>
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
    
                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
    
                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Overview
                                </h6>
    
                                <!-- Title -->
                                <h1 class="header-title">
                                    Variantes
                                </h1>
    
                            </div>

                    </div>
                </div>
    
                <!-- Card -->
                <div id="products_variantsTable" class="card mt-3" data-toggle="lists" data-lists-values='["products_variant-image", "products_variant-color", "products_variant-size", "products_variant-quantity", "products_variant-position", "products_variant-product-zone-title"]'>
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
    
                                <!-- Search -->
                                <form class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <span class="fe fe-search text-muted"></span>
                                    </div>
                                    <div class="col">
                                        <input type="search" class="form-control form-control-flush search" placeholder="Recherche">
                                    </div>
                                </form>
    
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-nowrap card-table">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="products_variant-color">
                                            Couleur
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="products_variant-size">
                                            Taille
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="products_variant-quantity">
                                            Quantité
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="products_variant-position">
                                            Position
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="products_variant-product_zone_title">
                                            Zone d'impression
                                        </a>
                                    </th>
                                    <th colspan="2">
                                    <a href="#" class="text-muted sort" data-sort="products_variant-product_zone_title">
                                        Statuts
                                    </a>
                                    </th>
                                    <th colspan="2">

                                    </th>
                                </tr>
                            </thead>
    
                            <tbody class="list">
                                @foreach ($products_variants as $products_variant)
                                    @if($products_variant->product_id == $product->id)
                                        <tr>
                                            <td class="products_variant-color">{{ $products_variant->color }}</td>
                                            <td class="products_variant-size">{{ $products_variant->size }}</td>
                                            <td class="products_variant-quantity">{{ $products_variant->quantity }}</td>
                                            <td class="products_variant-position">{{ $products_variant->position }}</td>
                                            @if(isset($products_variant->product_zones['title']))
                                                <td class="products_variant-product_zones_title">{{ $products_variant->product_zones['title'] }}</td>
                                            @else
                                                <td>...</td>
                                            @endif
                                            @if ($products_variant->is_active == true)
                                                <td class="products_variant-status"><span class="badge badge-soft-success">Activé</span></td>
                                            @else
                                                <td class="products_variant-status"><span class="badge badge-soft-secondary">Désactivé</span></td>
                                            @endif
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="!" class="dropdown-ellipses dropdown-toggle" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-boundary="window">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if ($products_variant->is_active == true)
                                                            <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')" href="{{route('desactivate_productsVariants', $products_variant->id)}}"> Désactiver </a>
                                                        @else
                                                            <a class="dropdown-item" href="{{route('activate_productsVariants', $products_variant->id)}}">Activer</a>
                                                        @endif
                                                        <hr class="dropdown-divider">
                                                        <a class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_productsVariants', $products_variant->id)}}"> Supprimer </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
    
            </div>
        </div> <!-- / .row -->
    </div>

        <!--~~~~~~~~~~~___________MODAL AJOUT DE PRODUCTS_VARIANTS__________~~~~~~~~~~~~-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                {!! Form::open(['id' => 'AddProductsVariants', 'files' => true]) !!}

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Nouvelle variante</h2>
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
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                            <input type="hidden" name="is_active" id="is_active" value="true">
                            <input type="hidden" name="is_deleted" id="is_deleted" value="false">
                            {!! Form::label('color', 'Ajouter le couleur: ') !!}
                            {!! Form::text('color', null, array('class'=>'form-control mb-2', 'placeholder' => 'Couleur :','id' => 'color', 'name' => 'color')) !!}
                            {!! Form::label('size', 'Ajouter la taille: ') !!}
                            {!! Form::text('size', null, array('class'=>'form-control mb-2', 'placeholder' => 'Taille :','id' => 'size', 'name' => 'size')) !!}
                            {!! Form::label('quantity', 'Ajouter la quantité: ') !!}
                            {!! Form::text('quantity', null, array('class'=>'form-control mb-2', 'placeholder' => 'Quantité :','id' => 'quantity', 'name' => 'quantity')) !!}
                            {{--
                            {!! Form::label('position', 'Ajouter la position: ') !!}
                            {!! Form::text('position', null, array('class'=>'form-control mb-2', 'placeholder' => 'Position :','id' => 'position', 'name' => 'position')) !!}
                            --}}
                            {!! Form::label('product_zones', 'Ajouter le ou les nom(s) de(s) zone(s) d\'impression et les images associées: ') !!}
                            {!! Form::text('product_zone_title1', null, array('class'=>'form-control mb-2', 'placeholder' => 'Zone 1 :','id' => 'product_zone_title1', 'name' => 'product_zone_title1')) !!}
                            {!! Form::file('product_zone_image1', array('class' => 'form-control mb-3', 'id' => 'product_zone_image1')) !!}
                            {!! Form::text('product_zone_title2', null, array('class'=>'form-control mb-2', 'placeholder' => 'Zone 2 :','id' => 'product_zone_title2', 'name' => 'product_zone_title2')) !!}
                            {!! Form::file('product_zone_image2', array('class' => 'form-control mb-3', 'id' => 'product_zone_image2')) !!}
                            {!! Form::text('product_zone_title3', null, array('class'=>'form-control mb-2', 'placeholder' => 'Zone 3 :','id' => 'product_zone_title3', 'name' => 'product_zone_title3')) !!}
                            {!! Form::file('product_zone_image3', array('class' => 'form-control mb-3', 'id' => 'product_zone_image3')) !!}
                            {!! Form::label('vendor_sku', 'Ajouter une Sku : ') !!}
                            {!! Form::text('vendor_sku', null, array('class'=>'form-control mb-2', 'placeholder' => 'Sku :','id' => 'vendor_sku', 'name' => 'vendor_sku')) !!}
                            {!! Form::label('vendor_quantity', 'Ajouter la quantité fournisseur : ') !!}
                            {!! Form::text('vendor_quantity', null, array('class'=>'form-control mb-2', 'placeholder' => 'Quantité :','id' => 'vendor_quantity', 'name' => 'vendor_quantity')) !!}
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="close_modal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                        {{ Form::submit('Valider', array('class'=>'btn btn-primary btn-sm', 'id' => 'submit_modal', 'onclick' => "this.value='Ajoutée'")) }} 

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <br><hr>
</div>

    @section('javascripts')
    <script type="text/Javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        });</script>
    {{--<script> var host = "{{URL::to('/')}}";</script>--}}
    @endsection

@endsection