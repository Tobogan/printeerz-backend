<div class="container" id="event_product_customs">
    <div class="row justify-content-center">
        <div class="col-12">
            <?php $i = 0 ?>
            @foreach($events_customs as $events_custom)
                    @if($events_custom->events_product_id == $events_product->id)
                        <?php $i++; ?>
                    @endif
            @endforeach
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
                    <a href="{{route('create_eventsCustoms', $events_product->id)}}" class="btn btn-sm btn-primary">
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
                                <a href="{{route('create_eventsCustoms', $events_product->id)}}" class="btn btn-sm btn-primary">
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
                                    <a href="#" class="text-muted sort" data-sort="events_custom-title">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="events_custom-template">
                                        Gabarit
                                    </a>
                                </th>
                                <th></th>
                                <th colspan="1">
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach($events_customs as $custom)
                                @foreach($templates as $template)
                                    <?php //dd($custom->template[0]) ?>
                                    @if($custom->template[0] == $template->id)
                                        @if($custom->events_product_id == $events_product->id)
                                        <tr>
                                            <td class="events_custom-title"><a href="{{route('show_eventsCustoms', $custom->id)}}">
                                                <b>{{ $custom->title }}</b></a></td>
                                            <td>{{ $template->title }}</td>
                                            <td>
                                                <a href="{{route('edit_eventsCustoms', $custom->id)}}" class="btn btn-sm btn-primary" style="float:right">
                                                Configurer
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" data-boundary="window">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item text-danger" href="{{ url('admin/EventsCustoms/destroy/' . $custom->id)}}">
                                                            Supprimer </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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