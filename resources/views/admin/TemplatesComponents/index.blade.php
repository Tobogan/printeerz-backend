@extends('layouts/templateAdmin')

@section('content')

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
                                Composants
                            </h1>

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <a href="{{action('TemplateComponentsController@create')}}" class="btn btn-primary">
                                Créer un composant
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div id="printzonesTable" class="card mt-3" data-toggle="lists" data-lists-values='["templates-title", "templates-category", "printzones-width", "printzones-height", "printzones-tray_width", "printzones-tray_height"]'>
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
                                        <a href="#" class="text-muted sort" data-sort="templatesComponents-name">
                                            Titre
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="templatesComponents-type">
                                            Type
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="templatesComponents-size-width">
                                            Largeur
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-muted sort" data-sort="templatesComponents-size-height">
                                            Hauteur
                                        </a>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($template_components as $component)
                                    <tr>
                                        <td class="templatesComponents-title"><a href="{{route('edit_templatesComponents', $component->id)}}"><b>{{$component->title}}</b></a></td>
                                        <td class="templatesComponents-type">{{ $component->type }}</td>
                                        @if(isset($component->size["width"]))
                                            <td class="templatesComponents-size-width">{{ $component->size["width"] }}</td>
                                        @else
                                            <td class="templatesComponents-size-width">...</td>
                                        @endif
                                        @if(isset($component->size["height"]))
                                            <td class="templatesComponents-size-height">{{ $component->size["height"] }}</td>
                                        @else
                                            <td class="templatesComponents-size-height">...</td>
                                        @endif

                                    
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    data-boundary="window">
                                                    <i class="fe fe-more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('edit_templatesComponents', $component->id)}}" class="dropdown-item">
                                                        Modifier le gabarit
                                                    </a>
                                                    @if ($component->is_active == true)
                                                    <a class="dropdown-item" onclick="return confirm('Êtes-vous sûr?')"
                                                        href="{{route('desactivate_templatesComponents', $component->id)}}">
                                                        Désactiver </a>
                                                    @else
                                                    <a class="dropdown-item" href="{{route('activate_templatesComponents', $component->id)}}">Activer</a>
                                                    @endif
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr?')"
                                                        href="{{route('destroy_templatesComponents', $component->id)}}"> Supprimer
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