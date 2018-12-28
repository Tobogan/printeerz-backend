@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3 mb-3">
            
            <!--~~~~~~~~~~~___________Variantes__________~~~~~~~~~~~~-->
    <table class="datatable table table-striped" >
        <thead>
            <tr>
                <th>Product</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Gabarit 1</th>
                <th>Zone n°1</th>
                <th>Zone n°2</th>
                <th>Zone n°3</th>
                <th>Zone n°4</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        @foreach($eventVariants as $eventVariant)
        @if($event->id == $eventVariant->event_id)
            <?php 
            $list_product = $eventVariant->productVariants->pluck('product_nom')->toArray();
            $list_couleur = $eventVariant->productVariants->pluck('couleur_nom')->toArray();
            $list_taille = $eventVariant->productVariants->pluck('taille_nom')->toArray();
            $list_gabarit1 = $eventVariant->productVariants->pluck('gabarit1')->toArray();
            $list_zone1 = $eventVariant->productVariants->pluck('zone1')->toArray();
            $list_zone2 = $eventVariant->productVariants->pluck('zone2')->toArray();
            $list_zone3 = $eventVariant->productVariants->pluck('zone3')->toArray();
            $list_zone4 = $eventVariant->productVariants->pluck('zone4')->toArray();
            ?>
            @if($list_product)
                <td><small><?php echo implode(', ', $list_product); ?></small></td>
            @else
                <td><small>Pas de produits spécifiés</small></td>
            @endif

            @if($list_couleur)
                <td><small><?php echo implode(', ', $list_couleur); ?></small></td>
            @else
                <td><small>Pas de couleurs spécifiées</small></td>
            @endif

            @if($list_taille)
                <td><small><?php echo implode(', ', $list_taille); ?></small></td>
            @else
                <td><small>Pas de tailles spécifiées</small></td>
            @endif

            @if($list_gabarit1)
                <td><small><?php echo implode(', ', $list_gabarit1); ?></small></td>
            @else
                <td><small>Pas de gabarits spécifiés</small></td>
            @endif

            @if($list_zone1)
                <td><small><?php echo implode(', ', $list_zone1); ?></small></td>
            @else
                <td><small>Pas de zone 1 spécifiée</small></td>
            @endif

            @if($list_zone2)
                <td><small><?php echo implode(', ', $list_zone2); ?></small></td>
            @else
                <td><small>Pas de zone 2 spécifiée</small></td>
            @endif

            @if($list_zone3)
                <td><small><?php echo implode(', ', $list_zone3); ?></small></td>
            @else
                <td><small>Pas de zone 3 spécifiée</small></td>
            @endif

            @if($list_zone4)
                <td><small><?php echo implode(', ', $list_zone4); ?></small></td>
            @else
                <td><small>Pas de zone 4 spécifiée</small></td>
            @endif

            <td><a class='btn btn-danger' style="float:right;" href="{{route('destroy_eventVariants', $eventVariant->id)}}" title="Supprimer le produit">Supprimer</a></td></tr>
        @endif
    @endforeach


    </tbody>

    <a class='btn btn-secondary btn-sm mt-2 mb-2' style="float:bottom" href="{{route('show_event', $event->id)}}" title="Détails de l'événement"> Retour </a>
</div> 

<!-- ~~~~~~~~ JAVASCRIPT ~~~~~~~~ -->
    @section('javascripts')
    @endsection
    
@endsection