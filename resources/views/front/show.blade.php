@extends('layouts/templateFront')


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
    <div class="row">
        <div class="col lg-4">
            @if($event->logoName != NULL)
                    <div class="mt-3 mb-4"><img width="40%"  src="/uploads/{{$event->logoName}}" alt="logo évenement"></div>
                @else
                    <div class="mt-3 mb-4"><img width="40%"  src="/img/2000px-No_image_available_400_x_600.svg.png" alt="img_default"></div>
            @endif
                <div class="row">
                    <div class="col">
                    @if($event->imageName1 != NULL)
                            <div class="mt-3 mb-4"><img width="60%"  src="/uploads/{{$event->imageName1}}" alt="Image n°1 "></div>
                        @else
                            <div class="mt-3 mb-4"><img width="60%"  src="/img/2000px-No_image_available_400_x_600.svg.png" alt="img_default"></div>
                    @endif
                    </div>
                    <div class="col">
                    @if($event->imageName2 != NULL)
                            <div class="mt-3 mb-4"><img width="60%"  src="/uploads/{{$event->imageName2}}" alt="Image n°2 "></div>
                        @else
                            <div class="mt-3 mb-4"><img width="60%"  src="/img/2000px-No_image_available_400_x_600.svg.png" alt="img_default"></div>
                    @endif
                    </div>
            </div>
            <div class="grid mt-2">
                COULEUR
                    @foreach($couleurs as $couleur)
                        @if($event->product->color1 == $couleur->id)
                            <a href='index.php?couleur1=true'><img style="float:right" class="miniRoundedImage ml-1" src="/uploads/{{ $couleur->pantoneName }}"></a>
                        @elseif($event->product->color2 == $couleur->id)
                            <a href='index.php?couleur2=true'><img style="float:right" class="miniRoundedImage ml-1" src="/uploads/{{ $couleur->pantoneName }}"></a>
                        @elseif($event->product->color3 == $couleur->id)
                            <a href='index.php?couleur3=true'><img style="float:right" class="miniRoundedImage ml-1" src="/uploads/{{ $couleur->pantoneName }}"></a>
                        @endif
                    @endforeach
                <br><hr>
                sdsds
                <hr>
            </div>
        </div>
       
        <?php $background = $event->product->imageName;
        if (isset($_GET['couleur1'])) {
            color1();
        }

        elseif (isset($_GET['couleur2'])) {
            color2();
        }

        elseif (isset($_GET['couleur3'])) {
            color3();
        }
        
        function color1(){
            $background = $event->product->color1_FAV_imageName;
        }

        function color2(){
            $background = $event->product->color2_FAV_imageName;
        }

        function color3(){
            $background = $event->product->color3_FAV_imageName;
        }
        ?>
        
        <div class="col lg-8" style="background-image: url('/uploads/{{ $background }}');background-size: 100% auto">
            <canvas id="canvas" width="700" height="750">
                <input type="text" id="gabarit1">
            </canvas>
        </div>
    </div>
</div>

@section('javascripts')
<script>
    // var canvas = document.getElementById("canvas");
    // var ctx = canvas.getContext("2d");
    // var img = new Image();
    // img.src = '/img/blank_t.jpg'; 
    
    // img.onload = function(){
    //     ctx.drawImage(img, 0, 0);
    // };
    
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var img = new Image();

    img.onload = function() {

        // set size proportional to image
        canvas.height = canvas.width * (img.height / img.width);

        // step 1 - resize to 50%
        var oc = document.createElement('canvas'),
            octx = oc.getContext('2d');

        oc.width = img.width ;
        oc.height = img.height ;
        octx.drawImage(img, 0, 0, oc.width, oc.height);

        // step 2
        octx.drawImage(oc, 0, 0, oc.width, oc.height);

        // step 3, resize to final size
        ctx.drawImage(oc, 0, 0, oc.width, oc.height,
        0, 0, canvas.width, canvas.height);
    }
    // img.src = "/img/blank_t.jpg";
    //input dans le canvas
    var input = new CanvasInput({
    canvas: document.getElementById('canvas'),
    x:250,
    y:500,
    fontSize: 18,
    fontFamily: 'Arial',
    fontColor: '#212121',
    fontWeight: 'bold',
    width: 180,
    padding: 8,
    borderWidth: 1,
    borderColor: '#000',
    borderRadius: 3,
    boxShadow: '1px 1px 0px #fff',
    innerShadow: '0px 0px 5px rgba(0, 0, 0, 0.5)',
    placeHolder: 'Votre message ici...'
    });

</script>
    <script type="text/javascript" src="{{ asset('js/CanvasInput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/CanvasInput.min.js') }}"></script>

@endsection