<!-- HEADER -->
<div class="header">
        <div class="container">
    
            <!-- Body -->
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col-auto">
    
                        <!-- Avatar -->
                        <div class="avatar avatar-xl header-avatar-top">
                            <img src="https://scontent-cdt1-1.xx.fbcdn.net/v/t1.0-1/p480x480/15181490_10155611927283298_8861825542125359600_n.jpg?_nc_cat=1&_nc_ht=scontent-cdt1-1.xx&oh=d82689e732ea86575deef69b4cb4b1e2&oe=5C8EAF81"
                                alt="..." class="avatar-img rounded-circle border border-4 border-body">
                        </div>
    
                    </div>
                    <div class="col mb-3 ml--3 ml-md--2">
    
                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Client
                        </h6>
    
                        <!-- Title -->
                        <h1 class="header-title">
                            {{ $customer->denomination }}
                        </h1>
    
                    </div>
                    <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#!" class="btn btn-lg btn-rounded-circle btn-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('edit_customer', $customer->id)}}" class="dropdown-item">
                                    Modifier
                                </a>
                                <button type="button" data-toggle="modal" data-target="#modalDeleteCustomer" class="dropdown-item text-danger">
                                    Supprimer
                                </button>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">
                        @include('admin.Customer.includes.tabs')
                    </div>
                </div>
            </div> <!-- / .header-body -->
    
        </div>
    </div>
    