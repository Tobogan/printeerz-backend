<div class="container" id="event_infos">
    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h5 class="mb-0">
                                Date de début
                            </h5>
                        </div>
                        <div class="col-auto">
                            <time class="small text-muted">
                                {{ date('d-m-Y', strtotime($event->start_datetime)) }}
                            </time>
                        </div>
                    </div> <!-- / .row -->

                    <!-- Divider -->
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h5 class="mb-0">
                                Date de fin
                            </h5>

                        </div>
                        <div class="col-auto">

                            <span class="small text-muted">
                                {{ date('d-m-Y', strtotime($event->end_datetime)) }}
                            </span>

                        </div>
                    </div> <!-- / .row -->

                    <!-- Divider -->
                    <hr>

                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h5 class="mb-0">
                                Type d'événement
                            </h5>

                        </div>
                        <div class="col-auto">

                            <small class="text-muted">
                                {{ $event->type }}
                            </small>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <!-- Card -->
            <div class="card" style="overflow:hidden">
                <div class="card-header">
                    <!-- Title -->
                    <h4 class="card-header-title">
                        Adresse
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">
                                {{ $event->location['address'] }}, {{ $event->location['postal_code'] }}, {{ $event->location['city'] }}, {{ $event->location['country'] }}
                            </span>
                        </div>
                    </div> <!-- / .row -->
                </div>
                @if($event->location['lattitude'] && $event->location['longitude'])
                    <div style="position:relative; display: block; width: 100%; height: 300px;">
                            <div id="map"></div>
                    </div>
                @endif
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <!-- Title -->
                    <h4 class="card-header-title">
                        Description
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="small">
                                {{ $event->description }}
                            </span>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>

@if($event->location['lattitude'] && $event->location['longitude'])

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />
<style>
#map { position:absolute; top:0; bottom:0; width:100%; }
</style>
<script>
        mapboxgl.accessToken = 'pk.eyJ1IjoicmVkam9yIiwiYSI6ImNqaTFzajJmbjFoOXkzcG55anRjaGIxcHIifQ.Yea7bd-MCJYIOs8tKcrb9Q';
        var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
        center: [{{ $event->location['longitude'] }}, {{ $event->location['lattitude'] }}], // starting position [lng, lat]
        zoom: 15 // starting zoom
        });
        
        marker = new mapboxgl.Marker()
        .setLngLat([{{ $event->location['longitude'] }}, {{ $event->location['lattitude'] }}])
        .addTo(map);</script>
@endif