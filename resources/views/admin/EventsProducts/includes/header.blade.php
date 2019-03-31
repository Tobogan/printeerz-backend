<!-- HEADER -->
<div class="header">
    <div class="container">

        <!-- Body -->
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col mb-3 ml--3 ml-md--2">
                    <a class="btn btn-link btn-sm mb-3 px-0" href="{{route('show_event', $events_product->event_id)}}"><span class="fe fe-chevron-left"></span>Retour</a>

                    <!-- Pretitle -->
                    <h6 class="header-pretitle">
                        {{ $product->vendor['name'] }}
                    </h6>

                    <!-- Title -->
                    <h1 class="header-title">
                        {{ $events_product->title }}
                    </h1>

                </div>
                <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
                    <div class="col-auto">
                        <div class="dropdown">
                            <a href="#" class="btn btn-lg btn-rounded-circle btn-white" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('edit_eventsProducts', $events_product->id)}}" class="dropdown-item">
                                    Modifier
                                </a>
                                <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#modalDeleteEventsProduct">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row align-items-center">
                <div class="col">
                    @include('admin.EventsProducts.includes.tabs')
                </div>
            </div>
        </div> <!-- / .header-body -->
    </div>
</div>