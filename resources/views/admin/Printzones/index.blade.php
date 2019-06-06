@extends('layouts/templateAdmin')
@section('title', 'Zones d\'impression')

@section('content')

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
                                Zones d'impression
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a href="{{action('PrintzonesController@create')}}" class="btn btn-primary">
                                Créer une zone
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="printzonesTable" class="card mt-3" data-toggle="lists"
                data-lists-values='["printzones-name", "printzones-zone", "printzones-width", "printzones-height", "printzones-tray_width", "printzones-tray_height"]'>
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
                                    <a href="#" class="text-muted sort" data-sort="printzones-name">
                                        Nom
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="printzones-zone">
                                        Zone
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted" data-sort="printzones-width">
                                        Largeur/Hauteur
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted" data-sort="printzones-tray_width">
                                        Largeur/Hauteur du plateau
                                    </a>
                                </th>
                                <th>
                                    <a href="#" class="text-muted sort" data-sort="printzones-is_active">
                                        Status
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($printzones as $printzone)
                            <tr>
                                <td class="printzones-name"><a
                                        href="{{route('edit_printzones', $printzone->id)}}"><b>{{$printzone->name}}</b></a>
                                </td>
                                <td class="printzones-zone">{{ $printzone->zone }}</td>
                                <td class="printzones-width">{{ $printzone->width }}x{{ $printzone->height }}</td>
                                <td class="printzones-tray_width">
                                    {{ $printzone->tray_width }}x{{ $printzone->tray_height }}</td>
                                <td class="printzones-is_active">
                                    @if($printzone->is_active === 'true')
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
                                            <a href="{{route('show_printzones', $printzone->id)}}"
                                                class="dropdown-item">
                                                Modifier la zone d'impression
                                            </a>
                                            @if ($printzone->is_active === "true")
                                            <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')"
                                                href="{{route('desactivate_printzones', $printzone->id)}}">
                                                Désactiver </a>
                                            @else
                                            <a class="dropdown-item"
                                                href="{{route('activate_printzones', $printzone->id)}}">Activer</a>
                                            @endif
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item text-danger"
                                                onclick="return confirm('Êtes-vous sûr?')"
                                                href="{{route('destroy_printzones', $printzone->id)}}"> Supprimer
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