<div id="event_infos">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">
                                Crée par
                            </h5>
                        </div>
                        <div class="col-auto">
                            <time class="small text-muted">
                                {{$event->created_by}}
                            </time>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">
                                Date & heure de début
                            </h5>
                        </div>
                        <div class="col-auto">
                            <time class="small text-muted">
                                {{ date('d/m/y', strtotime($event->start_datetime)) }} à {{$event->start_time}}
                            </time>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">
                                Date & heure de fin
                            </h5>
                        </div>
                        <div class="col-auto">

                            <span class="small text-muted">
                                {{ date('d/m/y', strtotime($event->end_datetime)) }} à {{$event->end_time}}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">
                                Type d'événement
                            </h5>
                        </div>
                        <div class="col-auto">
                            <small class="text-muted">
                                {{ $event->type }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @if($event->description)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Description
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">
                                {!! $event->description !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12 col-lg-4">
            <div class="card" style="overflow:hidden">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Adresse
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">
                                {{ $event->location['address'] }}
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">{{ $event->location['postal_code'] }}
                                {{ $event->location['city'] }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">{{ $event->location['country'] }}</span>
                        </div>
                    </div>
                </div>
                @if($event->location['lattitude'] && $event->location['longitude'])
                <div style="position:relative; display: block; width: 100%; height: 300px;">
                    <div id="map"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($event->location['lattitude'] && $event->location['longitude'])

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />
<style>
    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
</style>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoicmVkam9yIiwiYSI6ImNqaTFzajJmbjFoOXkzcG55anRjaGIxcHIifQ.Yea7bd-MCJYIOs8tKcrb9Q';
    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
        center: [
            '{!! $event->location['longitude'] !!}', '{!! $event->location['lattitude'] !!}'
        ], // starting position [lng, lat]
        zoom: 15 // starting zoom
    });

    map.on("load", function () {
        /* Image: An image is loaded and added to the map. */
        map.loadImage("https://i.imgur.com/MK4NUzI.png", function (error, image) {
            if (error) throw error;
            map.addImage("custom-marker", image);
            /* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
            map.addLayer({
                id: "markers",
                type: "symbol",
                /* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
                source: {
                    type: "geojson",
                    data: {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: "Point",
                                coordinates: ['{!! $event->location['longitude'] !!}', '{!! $event->location['lattitude'] !!}'
                                ]
                            }
                        }]
                    }
                },
                layout: {
                    "icon-image": "custom-marker",
                }
            });
        });
    });
</script>
@endif