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
        <a href="{{action('ZoneController@create')}}"><button type="button" title="Ajout d'une nouvelle zone" class="btn btn-primary right btn-sm mt-2 mb-2">Nouvelle zone</button></a>
        <a class='btn btn-secondary btn-sm mt-3' style="float: right" href="{{route('index_product')}}"> Retour </a>

            <table class="display table table-striped datatable" >
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nom</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($zones as $zone)
                <tr>
                    @if($zone->imageName)
                    <td><img src="/uploads/{{$zone->imageName}}" class="miniRoundedImage" alt="img_zone" ></td>
                    @else
                    <td><img src="/uploads/no_image.jpg" class="miniRoundedImage" alt="img_zone" ></td>
                    @endif
                    <td>{{ $zone->nom }}</td>
                    <td><a class='btn btn-success btn-sm ml-1' style="float: right" href="{{route('edit_zone', $zone->id)}}"> Modifier </a>
                    <a class='btn btn-danger btn-sm' style="float: right" href="{{route('destroy_zone', $zone->id)}}"> Supprimer </a></td></tr>
                </tr>
            @endforeach
                </tbody>
            </table>
            

        </div>
        <div class="col">

    </div>
    </div>
    
</div>


@endsection
