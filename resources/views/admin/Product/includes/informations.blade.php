<div class="container">
    <div class="row">
        <div class="col-12 col-xl-8">
            @include('admin.Product.includes.indexVariante')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Description</h4>
                </div>
                <div class="card-body">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            {{-- Image --}}
            @if(!empty($product->image) && $disk->exists($product->image))
            <div class="card">
                <div class="card-body">
                    <img width="100%" title="image principale" class="" src="{{$disk->url($product->image)}}"
                        alt="Image produit">
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
                        Ajoutez une image
                    </a>
                </div>
            </div>
            @endif
            {{-- Organisation --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Organisation</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Crée par</h5>
                        </div>
                        <div class="col-auto">
                            <span class="text-muted">
                                {{ $product->created_by }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    @if ($product->product_type)
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Type</h5>
                        </div>
                        <div class="col-auto">
                            <span class="text-muted">
                                {{ $product->product_type }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @if ($product->gender)
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Sexe</h5>
                        </div>
                        <div class="col-auto">
                            <span class="text-muted">
                                {{ $product->gender }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @if ($product->vendor['name'])
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Fournisseur</h5>
                        </div>
                        <div class="col-auto">
                            <span class="text-muted">
                                {{ $product->vendor['name'] }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @if ($product->vendor['reference'])
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Référence</h5>
                        </div>
                        <div class="col-auto">
                            <span class="text-muted">
                                {{ $product->vendor['reference'] }}
                            </span>
                        </div>
                    </div>
                    @endif
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-2">Zone(s) disponible(s)</h5>
                        </div>
                        <div class="col-auto">
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