@extends('layouts/templateAdmin')

@section('content')

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['action' => array('ProductController@update', 'id' => $product->id), 'files' => true]) !!}

        {{csrf_field()}}
        <!--~~~~~~~~~~~___________NOM__________~~~~~~~~~~~~-->
        <div class="form-group">
            {!! Form::text('title', $product->title, ['class' => 'form-control mt-2', 'id' => 'title','placeholder' => 'Nom du produit']) !!}
            @if($product->gender =='male')
            <div class="form-check">
                <input id="gender" class="form-check-input" type="radio" name="gender" value="male" checked>
                <label class="form-check-label" >
                    Homme
                </label>
            </div>
            <div class="form-check">
                <input id = "gender" class="form-check-input" type="radio" name="gender" value="female">
                <label class="form-check-label">
                    Femme
                </label>
            </div>
            @else
            <div class="form-check">
                <input id="gender" class="form-check-input" type="radio" name="gender" value="male">
                <label class="form-check-label" >
                    Homme
                </label>
            </div>
            <div class="form-check">
                <input id = "gender" class="form-check-input" type="radio" name="gender" value="female" checked>
                <label class="form-check-label">
                    Femme
                </label>
            </div>
            @endif

            {!! Form::text('vendor_name', $product->vendor['name'], ['class' => 'form-control', 'placeholder' => 'Marque du produit :']) !!}
            {!! Form::text('vendor_reference', $product->vendor['reference'], ['class' => 'form-control', 'placeholder' => 'Référence produit :']) !!}
            {!! Form::text('product_type', $product->product_type, ['class' => 'form-control mt-2', 'placeholder' => 'Type de produit :']) !!}
            {!! Form::text('product_zone_title', $product->product_zones['title'], ['class' => 'form-control mt-2', 'placeholder' => 'Zone d\'impression :']) !!}
            <!--mettre les printzones dans le select-->
            {{--{!! Form::select('product_zone_printzone_id', null, null, ['class' => 'form-control', 'placeholder' => '***************************** Séléctionner la zone d\'impression *****************************']) !!}--}}
            <!--mettre les tags ici-->
            <!--mettre les variantes ici-->
        </div>
    
        <!--~~~~~~~~~~~___________PHOTO PRINCIPALE__________~~~~~~~~~~~~-->
        <div class="form-group mt-2">
            {!! Form::label('image', 'Ajouter une photo d\'illustration: ') !!}
            {!! Form::file('image', array('class' => 'form-control', 'id' => 'image')) !!}
        </div>

        <!--~~~~~~~~~~~___________DESCRIPTION__________~~~~~~~~~~~~-->
        <textarea class="form-control" name="description" maxlength="350" rows="4" cols="50" placeholder="Vous pouvez ajouter ici une description concernant le produit.">{{$product->description}}</textarea>
        <hr>
        <input type="hidden" name="is_active" id="is_active" value="true">
        <input type="hidden" name="is_deleted" id="is_deleted" value="false">
        <input type="hidden" name="actual_title" id="actual_title" value="{{$product->title}}">
        <div>

    {!! Form::submit('Modifier', ['class' => 'btn btn-primary btn-sm', 'style' => 'float: right']) !!}       

    <a class='btn btn-secondary btn-sm' style="float: left" href="{{route('index_product')}}"> Retour </a>

    {!! Form::close() !!}
</div>
</div>

</div>
</div>
 @section('javascripts')
{{-- <script type="text/javascript">
    $("select[name='select_zone']").change(function(){
    var value = $(this).val();
    $("input#optionOutput").val(value);
    });
</script>  --}}

@endsection
@endsection