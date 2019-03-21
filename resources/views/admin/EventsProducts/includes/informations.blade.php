<div class="container" id="event_product_informations">
    <div class="row">
        <div class="col-12 col-xl-8">
            @include('admin.EventsProducts.includes.indexVariante')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Description</h4>
                </div>
                <div class="card-body">
                    {{!! $events_product->description !!}}
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            {{-- Image --}}
            @if(file_exists(public_path('uploads/'.$product->image)) && !empty($product->image))
            <div class="card">
                <div class="card-body">
                    <div class="avatar avatar-xxl card-avatar">
                        <img src="/uploads/{{$product->image}}" alt="..." class="avatar-img rounded">
                    </div>
                    <div class="text-center">
                        <h2 class="card-title">
                            <a>{{ $product->title }}</a>
                        </h2>
                        <p class="card-text text-muted">
                            <small>
                                {{ $product -> vendor['name'] }}
                            </small>
                        </p>
                    </div>
                    <hr>
                    @if ($product -> product_type)
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Type</h5>
                            </div>
                            <div class="col-auto">
                                <span class="text-muted">
                                    {{ $product -> product_type }}
                                </span>
                            </div>
                        </div>
                    <hr>
                    @endif
                    @if ($product -> gender)
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Sexe</h5>
                            </div>
                            <div class="col-auto">
                                <span class="text-muted">
                                    {{ $product -> gender }}
                                </span>
                            </div>
                        </div>
                    <hr>
                    @endif
                    @if ($product -> vendor['reference'])
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Référence</h5>
                            </div>
                            <div class="col-auto">
                                <span class="text-muted">
                                    {{ $product -> vendor['reference'] }}
                                </span>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row align-items-top">
                        <div class="col">
                            <h5 class="mb-0">Zone(s) disponible(s)</h5>
                        </div>
                        <div class="col-auto text-right">
                            <span class="text-muted">
                                @if($product->printzones_id)
                                    @foreach($printzones as $printzone)
                                        @foreach($product->printzones_id as $print)
                                            @if($printzone->id == $print)
                                                {{ $printzone->name }}
                                                <br>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card card-inactive">
                <div class="card-body text-center">
                    <!-- Title -->
                    <p class="text-muted">
                        Pas d'image produit
                    </p>
                    <!-- Button -->
                    <a href="{{route('edit_product', $product->id)}}" class="btn btn-primary btn-sm">
                        Ajouter une image
                    </a>
                </div>
            </div>
            @endif
            {{-- Tags --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Tags</h4>
                </div>
                <div class="card-body">
                    <span class="badge badge-secondary">Coton bio</span>
                </div>
            </div>
        </div>
    </div>
</div>