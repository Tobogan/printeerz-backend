<!-- Card -->
<div id="products_variantsTable" class="card mt-3" data-toggle="lists" data-lists-values='["products_variant-image", "products_variant-color", "products_variant-size", "products_variant-quantity", "products_variant-position", "products_variant-product-zone-title"]'>
    <div class="card-header">
        <div class="card-header-title">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Title -->
                    <h4 class="card-header-title">
                        Variantes
                    </h4>
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addVariante">
                        Ajouter une variante
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php $i = 0 ?>
    @foreach ($products_variants as $products_variant)
        @if($products_variant->product_id == $product->id)
        {{-- if have results --}}
        <?php $i++; ?>
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
                        <th colspan="2">
                        </th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                       
                        <td class="products_variant-color">{{ $products_variant->color }}</td>
                        <td class="products_variant-size">{{ $products_variant->size }}</td>
                        <td class="products_variant-quantity">{{ $products_variant->quantity }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a href="!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" data-boundary="window">
                                    <i class="fe fe-more-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @if ($products_variant->is_active == true)
                                    <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')" href="{{route('desactivate_productsVariants', $products_variant->id)}}">
                                        Désactiver </a>
                                    @else
                                    <a class="dropdown-item" href="{{route('activate_productsVariants', $products_variant->id)}}">Activer</a>
                                    @endif
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_productsVariants', $products_variant->id)}}">
                                        Supprimer </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <ul class="pagination">
            </ul>
        </div>
        @endif
    @endforeach
    @if($i == 0)
    <div class="card-body text-center">
        <img src="/img/svg/team_spirit.svg" alt="..." class="img-fluid" style="max-width: 182px;">
        <h1>
            Pas de variantes.
        </h1>
        <p class="text-muted">
            Ajouter la première variante du produit
        </p>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addVariante">
            Ajouter une variante
        </a>
    </div>
    @endif
</div>

@include('admin.Product.includes.addVariante')