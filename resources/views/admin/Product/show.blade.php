@extends('layouts/templateAdmin')

@section('content')

<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col row">
            <div id="scrollbarProduct" class="col-lg-3 mt-3">
            </div>
        <div class="col-lg-9">
            @if(file_exists(public_path('uploads/'.$product->image)) && !empty($product->image))
            <br>
                <div class="image_principale">
                    <img  id="image_principale" width="100%" title="image principale" src="/uploads/{{$product->image}}" alt="Image produit">
                </div>
            @else
            <br>
                <div class="image_principale"><img id="image_principale" title="image par défaut" width="100%" src="/img/tee-shirt-blanc-gildan.jpg" alt="img_default"></div>
            @endif
        </div>
    </div>

        <div class="col-lg-5 ml-3">
            <h4 class="mt-3">#{{ $product->id . ' ' . ucfirst($product->title) }}</h4>
            <hr>

            <h6 class="mb-2">Sexe: <small>{{ ucfirst($product->gender) }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->vendor["name"] }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->product_type }}</small></h6>

            <h6 class="mb-2"> <small>{{ $product->product_zones["title"] }}</small></h6>

            <h6 class="mb-2">Référence fournisseur: <small>{{ $product->vendor["reference"] }}</small></h6>

            <h5 class="mt-2">Description: </h5>

            @if(strlen($product->description) != 0)
                <div><small>{{ $product->description }}</small></div>
            @else
                <td>{{ '...' }}</td>
                @if ($product->image == NULL)
                    <div><i>(image par défault)</i></div>
                @endif
            @endif
            <br>
            <a role="button" class='btn btn-success btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('edit_product', $product->id)}}" title="Modification du produit">Modifier</a>
            <a role="button" class='btn btn-danger btn-sm mt-2' onclick="return confirm('Êtes-vous sûr?')" href="{{route('destroy_product', $product->id)}}" title="Suppression du produit">Supprimer</a>
            <!--<a role="button" class='btn btn-primary btn-sm mt-2' href="{{route('create_productsVariants')}}" title="Ajouter une variante">Ajouter une variante</a>-->
            <span class="input-group-btn"><button type="button" class="btn btn-success btn-sm ml-1 mt-1" data-toggle="modal" style="float:right" data-target="#exampleModal">Ajouter une variante</button></span>

            <a class='btn btn-secondary btn-sm mt-2' href="{{route('index_product')}}"> Retour </a>
            <hr>
        </div>

        <!--~~~~~~~~~~~___________MODAL AJOUT DE COULEUR__________~~~~~~~~~~~~-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Nouvelle variante</h2>
                        @if (session('status'))
                            <div class="alert alert-success mt-1 mb-2">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            {!! Form::open(['id' => 'AddProductsVariants', 'files' => true]) !!}
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            {!! Form::label('name', 'Ajouter le nom de la variante: ') !!}
                            {!! Form::text('name', null, array('class'=>'form-control mb-2', 'placeholder' => 'Nom :', 'id'=>'name', 'name'=>'name')) !!}
                            {!! Form::label('color', 'Ajouter le couleur: ') !!}
                            {!! Form::text('color', null, array('class'=>'form-control mb-2', 'placeholder' => 'Couleur :','id' => 'color', 'name' => 'color')) !!}
                            {!! Form::label('size', 'Ajouter la taille: ') !!}
                            {!! Form::text('size', null, array('class'=>'form-control mb-2', 'placeholder' => 'Taille :','id' => 'size', 'name' => 'size')) !!}
                            {!! Form::label('quantity', 'Ajouter la quantité: ') !!}
                            {!! Form::text('quantity', null, array('class'=>'form-control mb-2', 'placeholder' => 'Quantité :','id' => 'quantity', 'name' => 'quantity')) !!}
                        </div>
                       {{ Form::submit('Valider', array('name'=>'submit',  'class'=>'btn btn-primary btn-sm', 'id' => 'submit_modal', 'onclick' => "this.value='Ajoutée'")) }} 
                        {{Form::close()}}
                    </div>
                    <div class="modal-footer">
                        <button id="close_modal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><hr>
</div>

    @section('javascripts')
    <script type="text/Javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        });</script>
    <script> var host = "{{URL::to('/')}}";</script>
    @endsection

@endsection