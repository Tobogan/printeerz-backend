<!-- HEADER -->
<div class="header">
    <div class="container">

        <!-- Body -->
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col mb-3 ml--3 ml-md--2">

                    <!-- Pretitle -->
                    <h6 class="header-pretitle">
                        {{ $product->vendor['name']}}
                    </h6>

                    <!-- Title -->
                    <h1 class="header-title">
                        {{ $product->title }}
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
                                <a href="{{route('edit_product', $product->id)}}" class="dropdown-item">
                                    Modifier
                                </a>
                                <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#modalDeleteCustomer">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .header-body -->
    </div>
</div>