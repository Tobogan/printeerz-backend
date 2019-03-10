<div class="container" id="event_product_customs">
    <div class="row justify-content-center">
        <div class="col-12">
            <?php $i = 0 ?>
            @if($events_product->variants != null)
            @foreach($products_variants as $products_variant)
            @foreach($events_product->variants as $variant1)
            <?php $first1 = reset($variant1); ?>
            @if($products_variant->id == $first1)
            <?php $i++; ?>
            @endif
            @endforeach
            @endforeach
            @endif
            @if($i == 0)
            <div class="card card-inactive">
                <div class="card-body text-center">
                    <img src="/img/svg/team_spirit.svg" alt="..." class="img-fluid" style="max-width: 182px;">
                    <h1>
                        Pas de personnalisation.
                    </h1>
                    <p class="text-muted">
                        Ajouter la première personnalisation
                    </p>
                    <!-- Button -->
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addVarianteEPModal">
                        {{-- là modal
                        personnalisation inc --}}
                        Ajouter une personnalisation
                    </a>
                </div>
            </div>
            @else
            <div id="products_variantsTable" class="card mt-3" data-toggle="lists" data-lists-values='["products_variant-image", "products_variant-color", "products_variant-size", "products_variant-quantity", "products_variant-position", "products_variant-product-zone-title"]'>
                <div class="card-header">
                    <div class="card-header-title">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="card-header-title">
                                    Personnalisations
                                </h4>
                            </div>
                            <div class="col-auto">
                                <!-- Button -->
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addVarianteEPModal">
                                    Ajouter une personnalisation
                                </a>
                            </div>
                        </div>
                    </div>
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
                                <th colspan="1">
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach($products_variants as $products_variant)
                            @foreach($events_product->variants as $variant)
                            {{-- La je vais chercher la première valeur de mon array et je le compare à l'ID d'un
                            PdtVariante--}}
                            <?php $first = reset($variant); 
                    $second = next($variant);
                    array_values($variant);
                    //dd($events_product->id);
                    ?>
                            @if($products_variant->id == $first)
                            <tr>
                                <td class="products_variant-color"><b>{{ $products_variant->color }}</b></td>
                                <td class="products_variant-size">{{ $products_variant->size }}</td>
                                <td class="products_variant-quantity">{{ $second }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" data-boundary="window">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item text-danger" href="{{ url('admin/EventsProducts/deleteVariant/' . $events_product->id . '/' . $products_variant->id)}}">
                                                Supprimer </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination">
                    </ul>
                </div>

            </div>
            @endif
            @include('admin.EventsProducts.includes.addVarianteEP')
        </div>
    </div>
</div>