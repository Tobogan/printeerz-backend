<div class="header">
  @if(!empty($event->cover_img) && $disk->exists($event->cover_img))
  <img width="100%" title="image principale" class="" src="{{$s3 . $event->cover_img}}" alt="Cover event">
  @else
  @endif

  <div class="header-body @if(!empty($event->cover_img) && $disk->exists($event->cover_img)) mt-n5 mt-md-n6 @endif">
    <div class="row @if(!empty($event->cover_img) && $disk->exists($event->cover_img)) align-items-end @else align-items-center @endif">
      @if(!empty($event->logoName) && $disk->exists($event->logoName))
      <div class="col-auto">
        <div class="avatar avatar-xl header-avatar-top">
          <img src="{{$s3 . $event->logoName}}" alt="..." class="avatar-img rounded-circle border border-4 border-body">
        </div>
      </div>
      @endif
      <div class="col @if(!empty($event->cover_img) && $disk->exists($event->cover_img)) mb-3 ml-n3 ml-md-n2 @endif">
        @if($event->customer)
        <h6 class="header-pretitle">
          {{ $event->customer->title}}
        </h6>
        @endif
        <h1 class="header-title">
          {{ $event->name }}
          <span class="small">by {{ $event->advertiser }}</span>
        </h1>
      </div>
      <div class="col-12 col-md-auto mt-2 mt-md-0 mb-md-3">
        <div class="dropdown">
          <a href="#" class="dropdown-ellipses dropdown-toggle btn btn-rounded-circle btn-white" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fe fe-more-vertical"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" x-placement="top-end"
            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 0px, 0px);">
            <a href="{{route('edit_event', $event->id)}}" class="dropdown-item">
              Modifier
            </a>
            <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#modalDeleteEvent">
              Supprimer
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col">
        <ul class="nav nav-tabs nav-overflow header-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#event_products">
              Produits
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
  </div>
</div>