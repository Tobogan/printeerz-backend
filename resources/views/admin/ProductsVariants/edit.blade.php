@extends('layouts/templateAdmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="header-pretitle">
                                CONFIGURATION
                            </h6>
                            <h1 class="header-title">
                                Configurer une variante
                            </h1>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::open(['action' => array('ProductsVariantsController@update'), 'id' => $products_variant->id, 'files' => true,
            'class' => 'mb-4']) !!}
            <div class="row">
                {{csrf_field()}}
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Couleur de la variante
                        </label>
                        <!-- Input -->
                        {!! Form::text('color', $products_variant->color, ['class' => 'form-control'])
                        !!}
                    </div>
                </div>
                <div class="col-12">
                    <!-- First name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Taille
                        </label>
                        <!-- Input -->
                        {!! Form::text('size', $products_variant->size, ['class' => 'form-control'])
                        !!}
                    </div>
                </div>
                <hr class="mt-4 mb-5">
                <div class="col-12">
                    <!-- First name -->

                    <div class="form-group">
                        <!-- Label -->
                        <label>
                            Quantité stock
                        </label>
                        <!-- Input -->
                            {!! Form::text('quantity', $products_variant->quantity, ['class' => 'form-control', 'placeholder' =>
                        'Saisissez la quantité en stock :']) !!}
                    </div>
                    <?php $i = 1; ?>
                    @if($product->printzones_id)
                        @foreach($printzones as $printzone)
                            @foreach($product->printzones_id as $print)
                                @if($printzone->id == $print)
                                    <hr class="mt-4 mb-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="h3"> {{ $printzone->name }}</p>
                                            <p class="mb-4">Ajouter l'image du produit en format 1:1</p>
                                        </div>
                                        <div class="col-12">
                                            <!-- First name -->
                                            <div class="form-group">
                                                {!! Form::file('printzone'.$i, array('class' => 'form-group')) !!}
                                                <input type="hidden" class="form-control" name="{{'printzone_name_'.$i}}" value="{{ $printzone->name }}">
                                                <input type="hidden" class="form-control" name="{{'printzone_id_'.$i}}" value="{{ $printzone->id }}">
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                    <input type="hidden" class="form-control" name="printzones_nb" value="{{ $i }}">
                    <hr class="mt-4 mb-5">
                    <div class="row">
                        <div class="col-12">
                            <p class="h3">Image</p>
                            <p class="mb-4">Modifier l'image du produit en format 1:1</p>
                        </div>
                        <div class="col-12">
                            <!-- First name -->
                            <div class="form-group">
                                {!! Form::file('image', array('class' => '', 'id' => 'logo_img')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="buttons">
                                {!! Form::submit('Modifier', ['style' => 'float: right', 'class' => 'btn btn-primary']) !!}
                                <a class="btn btn-secondary" style="float: left" class href="{{route('show_product', $products_variant->product_id)}}"><b>Annuler</b></a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="actual_color" value="{{$products_variant->color}}">
                    <input type="hidden" class="form-control" name="products_variant_id" value="{{$products_variant->id}}">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection