<div class="header">
     <!-- Image -->
    <img src="https://dashkit.goodthemes.co/assets/img/covers/profile-cover-1.jpg" class="header-img-top" alt="...">
        <div class="container">
      <!-- Body -->
      <div class="header-body mt-n5 mt-md-n6">
        <div class="row align-items-end">
          <div class="col-auto">
            
            <!-- Avatar -->
            <div class="avatar avatar-xxl header-avatar-top">
              <img src="https://pbs.twimg.com/profile_images/992035867169579008/79tW0OHn_400x400.jpg" alt="..." class="avatar-img rounded-circle border border-4 border-body">
            </div>

          </div>
          <div class="col mb-3 ml-n3 ml-md-n2">
            
            <!-- Pretitle -->
            <h6 class="header-pretitle">
            @if($event->customer)
                {{ $event->customer->title}}
            @else
                Inconnu
            @endif
            </h6>

            <!-- Title -->
            <h1 class="header-title">
                {{ $event->name }}
                <span class="small" >by {{ $event->advertiser }}</span>
            </h1>
            

          </div>
          <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
            
            <!-- Button -->
            <div class="dropdown">
                <a href="#" class="dropdown-ellipses dropdown-toggle btn btn-rounded-circle btn-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fe fe-more-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 0px, 0px);">
                  <a href="{{route('edit_event', $event->id)}}" class="dropdown-item">
                    Modifier
                  </a>
                  <a href="#!" class="dropdown-item text-danger">
                    Supprimer
                  </a>
                </div>
              </div>

          </div>
        </div> <!-- / .row -->
        <div class="row align-items-center">
          <div class="col">
            
            <!-- Nav -->
            <ul class="nav nav-tabs nav-overflow header-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#event_products">
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#event_infos">
                  Informations
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#event_feed">
                  Feed
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#event_users">
                    Utilisateurs
                  </a>
                </li>
            </ul>

          </div>
        </div>
      </div> <!-- / .header-body -->

    </div>
  </div>