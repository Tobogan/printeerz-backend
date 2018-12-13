@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col row">
            <div id="scrollbarProduct" class="col-lg-3 mt-3">
            </div>
            <div class="col-lg-9">
                @if($event->logoName != NULL)
                <br>
                    <div class="image_principale">
                        <img id="image_principale" width="100%" title="Logo évenement" src="/uploads/{{$event->logoName}}">
                    </div>
                @else
                <br>
                    <div class="image_principale"><img id="image_principale" title="image par défaut" width="100%" src="/img/2000px-No_image_available_400_x_600.svg.png"></div>
                @endif
            </div>
        </div>

        <div class="col-lg-5 ml-3">
            <h2 class="mt-2">#{{ $event->id . ' ' . $event->nom }}</h2>
        <hr>
        <h6 class="mt-2">Annonceur: </h6>
            <div><small>{{ $event->annonceur }}</small></div>
        
        <h6 class="mt-2">Client: </h6>
        @if($event->customer)
            <div><small>{{ $event->customer->denomination}}</small></div>
        @else
            <div><i><small>Inconnu</small></i></div>
        @endif

        <h6 class="mt-2">Utilisateurs autorisés: </h6>
            <?php $list_users = $event->users->pluck('prenom')->toArray();?>
        @if($list_users)
            <div><small><?php echo implode(', ', $list_users); ?></small></div>
        @else
            <div><small>Pas d'utilisateurs spécifiés</small></div>
        @endif
            <h6 class="mt-2">Produit sélectionné: </h6>
        @if($event->product)
            <div><small>{{ $event->product->nom}}</small></div>
        @else
            <div><small><i>Inconnu</i></small></div>
        @endif

        

        <h6 class="mt-2">Lieu: </h6>
            <div><small>{{ $event->lieu }}</small></div>

        <h6 class="mt-2">Type d'événement: </h6>
            <div><small>{{ $event->type }}</small></div>

        <h6 class="mt-2">Date: </h6>
            <div><small>{{ date('d-m-Y', strtotime($event->date)) }}</small></div>

            @if($event->BAT_name != null)
                <a class='btn btn-light btn-sm mt-2' role="button" href="#" onclick="window.open('/uploads/{{ $event->BAT_name }}', '_blank', 'fullscreen=yes'); return false;"><i class="uikon">send_round</i> Voir le BAT</a>
            @else
                <div><i>(Pas de BAT)</i></div>
            @endif
                <h6 class="mt-2 mb-1">Description: </h6>
            @if(strlen($event->description) != 0)
                <div class="mb-2">{{ $event->description }}</div>
            @else
            <td>{{ '...' }}</td>
                @if (!$event->logoName)
                    <div><i>(logo par défault)</i></div>
                @endif
            @endif
                    
            <br>
            <a class='btn btn-primary btn-sm mt-2' href="{{route('create_eventVariants', $event->id)}}" title="Ajouter une variante du produit"><i class="uikon">add</i> Ajouter un produit</a>

            <a role="button" class='btn btn-warning btn-sm mt-2' href="{{route('show_front', $event->id)}}"  title="Lancer l'event"><i class="uikon">send_round</i> Lancer</a>
            <a role="button" class='btn btn-success btn-sm mt-2' href="{{route('edit_event', $event->id)}}"  title="Modification du produit"><i class="uikon">edit</i> Modifier</a>
            <a role="button" class='btn btn-danger btn-sm mt-2' href="{{route('destroy_event', $event->id)}}" onclick="return confirm('Êtes-vous sûr?')" title="Suppression du produit">Supprimer</a>
            <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_event')}}"> Retour </a>
        </div> <!-- col lg-5 --->
    </div> <!-- row --->
<!-- container --->

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

    <!--~~~~~~~~~~~___________Commentaires__________~~~~~~~~~~~~-->

<section class="mt-3" id="comments">
<div class="container">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    @foreach($event->comments as $comment)
    <div class="" id="{{ $comment->id }}">
        <div class="row"> 
            <div class="col-3">
            @if($comment->user->imageName)
                <div><img src="/uploads/{{$comment->user->imageName}}" class="miniRoundedImage" alt="img_profile" >
            @else
                <div><img src="/uploads/no_image.jpg" class="miniRoundedImage" style="no-repeat center" alt="img_profile" >
            @endif
               {{ $comment->user->prenom . ' ' . $comment->user->nom }} <br>(<small>{{ date('Y-m-d H:i:s', strtotime($comment->created_at)) }}</small>)</div>
                </div>
            <div class="col">
                {{ $comment->name }}
                <hr>
                {{ $comment->message }}
                <br>
                @if(Auth::user()->role == 'admin')
                <button class="delete_comment btn btn-danger btn-sm"  data-id="{{ $comment->id }}" data-token="{{ csrf_token() }}" style="float:right"> Supprimer </button>
                @endif
            </div>
        </div>
        <br><br>
    </div>
    @endforeach
        <div class="event_comments_list1"></div>
        <div class="event_comments_list2"></div>
    </div>
</section>
<br>
    <!-- ~~~~~~~~ Commentaires Events ~~~~~~~~ -->
    {!! Form::open(['id' => 'commentForm']) !!}
    {{csrf_field()}}
    <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="user_prenom" id="user_prenom" value="{{ Auth::user()->prenom }}">
    <input type="hidden" name="user_nom" id="user_nom" value="{{ Auth::user()->nom }}">

    <div class="row">
        <div class="inner col-xs-12 col-sm-12 col-md-11 form-group">
            {{Form::label('name', 'Objet')}}
            {{Form::text('name', null, array('class'=>'form-control', 'style' => 'width:600px', 'id'=>'name', 'name'=>'name'))}}
        </div>
        <div class="inner col-xs-12 col-sm-12 col-md-12 form-group">
            {{Form::label('message', 'Commentaire')}}
            {{Form::textarea('message', null, array('class'=>'form-control', 'id'=>'message', 'name'=>'message', 'rows'=>'5'))}}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 submit form-group">
            {{Form::submit('Commenter', array('name'=>'submit', 'class'=>'btn btn-orange'))}}
        </div>
    </div>
{{ Form::close() }}
</div>
</div>



<!-- ~~~~~~~~ JAVASCRIPT ~~~~~~~~ -->
    @section('javascripts')
    <script> var host = "{{URL::to('/')}}"; </script>

    <script type="text/javascript">
        $(document).ready(function(){
        $('.your-class').slick();
    });
    </script>
    <script>
        $('.side_img').on('click', function(){
            swap(this)
        })
    function swap(img) {
        var tmp = img.src;
        img.src = document.getElementById('image_principale').src;
        document.getElementById('image_principale').src = tmp;

        var tmp2 = img.title;
        img.title = document.getElementById('image_principale').title;
        document.getElementById('image_principale').title = tmp2;
    }
    </script>
    {{-- <script type="text/javascript">
    $('.image_principale').each(function() {
    $(this).after( $(this).attr('title') ); 
    });
    </script> --}}
    @endsection
    
@endsection