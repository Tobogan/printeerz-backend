<!-- HEADER -->
<div class="header">
        <div class="container">
    
            <!-- Body -->
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col-auto">
    
                        <!-- Avatar -->
                        <div class="avatar avatar-xl header-avatar-top">
                             @if(!empty($customer->image) && $disk->exists($customer->image))
                                <img src="{{$s3 . $customer->image}}" alt="" class="avatar-img rounded-circle border border-4 border-body">
                            @else
                                <?php 
                                    $customerInitials = $customer->title[0];
                                ?>
                                <span class="avatar-title rounded text-uppercase">{{ $customerInitials }}</span>
                            @endif
                        </div>
    
                    </div>
                    <div class="col mb-3 ml--3 ml-md--2">
    
                        <!-- Pretitle -->
                        <h6 class="header-pretitle">
                            Client
                        </h6>
    
                        <!-- Title -->
                        <h1 class="header-title">
                            {{ $customer->title }}
                        </h1>
    
                    </div>
                    <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="btn btn-lg btn-rounded-circle btn-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    