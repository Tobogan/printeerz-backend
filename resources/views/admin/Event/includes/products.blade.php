<div class="container" id="event_products">
    <?php //dd($event->id) ?>
    <div class="row justify-content-center">
        <div class="col-12">
            <?php $i = 0; ?>
            @foreach($events_products as $events_product)
                @if($event->id == $events_product->event_id)
                    @foreach($products as $product)
                        @if($events_product->product_id == $product->id)
                        <?php $i++; ?>
                        <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center py-2">
                                        <div class="col-auto">
                                            <a href="project-team-overview.html" class="avatar avatar-lg">
                                                <img src="https://dashkit.goodthemes.co/assets/img/avatars/teams/team-logo-1.jpg" alt="..."
                                                    class="avatar-img rounded">
                                            </a>
                                        </div>
                                        <div class="col ml-n2">
                                            <h4 class="card-title mb-1 name">
                                                <a href="team-overview.html">{{ $product->title }}</a>
                                            </h4>
                                            <ul class="event_product_colors mt-2 d-inline-flex">
                                                <li class="event_product_color d-block rounded border border-light mr-1" style="background-color: #578393;"></li>
                                                <li class="event_product_color d-block rounded border border-light mr-1" style="background-color: #533322;"></li>
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <a class="btn btn-white btn-sm" href="{{route('show_eventsProducts', $events_product->id)}}">Voir le produit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Nom
                                                </th>
                                                <th>
                                                    Emplacement
                                                </th>
                                                <th>
                                                    Gabarit ID
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <code>{{$product->title}}</code>
                                                </td>
                                                <td>
                                                    Dos
                                                </td>
                                                <td>
                                                    5
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if($i == 0)
                <div class="card card-inactive">
                    <div class="card-body text-center">
                        <!-- Image -->
                        <img src="/img/svg/blank_canvas.svg" alt="..." class="img-fluid" style="max-width: 182px;">
                        <!-- Title -->
                        <h1>
                            Pas de produits encore.
                        </h1>
                        <!-- Subtitle -->
                        <p class="text-muted">
                            Ajouter votre premier produit pour cet événement
                        </p>
                        <!-- Button -->
                        <div><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addEventsProductModal">
                                Ajouter un produit
                        </a></div>
                    </div>
                </div>
            @else
            <div><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addEventsProductModal">
                    Ajouter un produit
            </a></div>
            @endif

        </div>
    </div>
</div>
