@extends('layouts/templateAdmin')
@section('title', 'Zones d\'impressions')
    @section('alerts')
        @if (session('status'))
            <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show" id="Alert" role="alert"
                data-dismiss="alert">
                {{ session('status') }}
            </div>
        @endif
    @endsection
@section('content')

@if (session('status'))
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
            </div>
        </div>
    </div>
</div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                Overview
                            </h6>
                            <h1 class="header-title">
                                Polices
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a href="{{action('FontsController@create')}}" class="btn btn-primary">
                                Créer une police
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fontsTable" class="card mt-3" data-toggle="lists"
                data-lists-values='["fonts-title", "fonts-weight", "fonts-is_active"]'>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <form class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <span class="fe fe-search text-muted"></span>
                                </div>
                                <div class="col">
                                    <input type="search" class="form-control form-control-flush search"
                                        placeholder="Recherche">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="fonts-title">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="fonts-weight">
                                        Epaisseur
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="fonts-is_active">
                                        Activée/Désactivée
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($fonts as $font)
                            <tr>
                                <td class="fonts-title"><a
                                        href="{{route('edit_fonts', $font->id)}}"><b>{{$font->title}}</b></a>
                                </td>
                                <td class="fonts-weight">{{ $font->weight }}</td>

                                <td class="fonts-is_active">
                                    @if($font->is_active === 'true')
                                    <span class="badge badge-soft-success">Activée</span>
                                    @else
                                    <span class="badge badge-soft-secondary">Désactivée</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            data-boundary="window">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('edit_fonts', $font->id)}}"
                                                class="dropdown-item">
                                                Modifier la police
                                            </a>
                                            @if ($font->is_active === "true")
                                            <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')"
                                                href="{{route('desactivate_fonts', $font->id)}}">
                                                Désactiver </a>
                                            @else
                                            <a class="dropdown-item"
                                                href="{{route('activate_fonts', $font->id)}}">Activer</a>
                                            @endif
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item text-danger"
                                                onclick="return confirm('Êtes-vous sûr?')"
                                                href="{{route('destroy_fonts', $font->id)}}"> Supprimer
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
    </div>
</div>
@endsection