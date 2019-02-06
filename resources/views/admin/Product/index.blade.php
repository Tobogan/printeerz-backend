@extends('layouts/templateAdmin')

@section('content')

@if (session('status'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Pretitle -->
                            <h6 class="header-pretitle">
                                Overview
                            </h6>

                            <!-- Title -->
                            <h1 class="header-title">
                                Produits
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{action('ProductController@create')}}" class="btn btn-primary">
                                Créer un produit
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div id="customerTable" class="card mt-3" data-toggle="lists" data-lists-values='["product-name", "product-sku", "product-sexe", "product-sizes"]'>
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Search -->
                                <form class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <span class="fe fe-search text-muted"></span>
                                    </div>
                                    <div class="col">
                                        <input type="search" class="form-control form-control-flush search" placeholder="Recherche">
                                    </div>
                                </form>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-nowrap card-table">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="product-name">
                                            Nom
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="product-sku">
                                            Référence
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="product-sexe">
                                            Sexe
                                        </a>
                                    </th>
                                    <th colspan="1">
                                        <a href="#" class="text-muted" data-sort="product-sizes">
                                            Fournisseur
                                        </a>
                                    </th>
                                    <th colspan="1">
                                        <a href="#" class="text-muted" data-sort="product-type">
                                            Type de produit
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($products as $product)
                                <tr>
                                    <td class="product-name"><a href="{{route('show_product', $product->id)}}"><b>{{
                                                $product->title }}</b></a></td>

                                    @if(isset($product->vendor["reference"]))
                                    <td class="product-sku">{{ $product->vendor["reference"] }}</td>
                                    @else
                                    <td>...</td>
                                    @endif
                                    @if ($product->gender == 'male')
                                    <td class="product-sexe"> Homme </td>
                                    @else
                                    <td class="product-sexe"> Femme </td>
                                    @endif
                                    @if(isset($product->vendor["name"]))
                                    <td class="product-vendor-name">{{ $product->vendor["name"] }}</td>
                                    @else
                                    <td class="product-vendor-name">...</td>
                                    @endif
                                    <td class="product-type">{{ $product->product_type }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                data-boundary="window">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('show_product', $product->id)}}" class="dropdown-item">
                                                    Voir le produit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>

    @endsection