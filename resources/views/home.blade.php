@extends('layouts.templateAdmin')
@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                Vue d'ensemble
                            </h6>
                            <h1 class="header-title">
                                Tableau de bord
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mes événements</h5>
                    <div>
                        <p class="card-text">Contenu de la carte 1.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carte 2</h5>
                    <p class="card-text">Contenu de la carte 2.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carte 3</h5>
                    <p class="card-text">Contenu de la carte 3.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
