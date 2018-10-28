@extends('layouts/templateAdmin')

@section('content')
<div class="container">
@if (session('status'))
    <div class="alert alert-success mt-1">
        {{ session('status') }}
    </div>
@endif
    <div class="row">
        <div class="col">
        <a href="{{action('CouleurController@createAdmin')}}"><button type="button" title="Ajout d'une nouvelle couleur" class="btn btn-primary btn-sm mt-2 mb-2"><i class="uikon">add</i> Nouvelle couleur</button></a>
        <a class='btn btn-secondary btn-sm btn-sm mt-2 mb-2' style="float: right" href="{{route('index_product')}}"> Retour </a>
            <table class="display table table-striped datatable" >
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($couleurs as $couleur)
                <tr>
                    @if($couleur->pantoneName)
                    <td><img src="/uploads/{{$couleur->pantoneName}}" class="miniRoundedImage" alt="pantone" ></td>
                    @else
                    <td><img src="/img/pointd'interrogation.jpg" class="miniRoundedImage" alt="pantone" ></td>
                    @endif
                    <td>{{ $couleur->nom }}</td>
                    <td><a class='btn btn-danger btn-sm ml-1' style="float: right" onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_couleur', $couleur->id)}}"> Supprimer </a>
                    <a class='btn btn-success btn-sm' style="float: right" href="{{route('edit_couleur', $couleur->id)}}"><i class="uikon">edit</i> Modifier </a></td></tr>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>

        <div class="col">
            <a href="{{action('TailleController@create')}}"><button type="button" title="Ajout d'une nouvelle taille" class="btn btn-primary btn-sm mt-2 mb-2"><i class="uikon">add</i> Nouvelle taille</button></a>
            <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float: right" href="{{route('index_product')}}"> Retour </a>
            <table class="display table table-striped datatable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($tailles as $taille)
                <tr>
                    <td>{{ $taille->nom }}</td>
                    <td><a class='btn btn-danger btn-sm ml-1' style="float: right" onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_taille', $taille->id)}}"> Supprimer </a>
                    <a class='btn btn-success btn-sm' style="float: right" href="{{route('edit_taille', $taille->id)}}"><i class="uikon">edit</i> Modifier </a></td></tr>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
