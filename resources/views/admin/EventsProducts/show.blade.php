@extends('layouts/templateAdmin')

@section('content')

<div class="container">

        <!--~~~~~~~~~~~___________Variantes__________~~~~~~~~~~~~-->
        <table class="datatable table table-striped" >
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Couleurs</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        @foreach ($eventVariants as $eventVariant)
            @if($eventVariant->event_id == $event->id)
                <td>{{ $eventVariant->product->nom }}</td>
                <?php $list_productVariants = $eventVariant->productVariants->pluck('nom')->toArray();?>
                @if($list_productVariants)
                    <td><small><?php echo implode(', ', $list_productVariants); ?></small></td>
                @else
                    <td><small>Pas de couleurs séléctionnées</small></td>
                @endif
                {{-- <td>{{ $eventVariant->productVariants->nom }}</td> --}}
                <td><a class='btn btn-danger' href="{{route('destroy_eventVariants', $eventVariant->id)}}" title="Supprimer le produit">Supprimer</a></td></tr>
            @endif
        @endforeach
            </tbody>
</div>

    @section('javascripts')

    @endsection

@endsection