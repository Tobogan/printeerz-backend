@extends('layouts/templateAdmin')

@section('content')
<div id="tabs">

    @include('admin.Customer.includes.header')
    <?php //dd($customer->shows_id())?> 
    
    <!-- #OVERVIEW -->

  {{--}}  @foreach($customer->shows_id as $row => $key)

    @foreach($key as $event)
        @foreach($events as $event_obj)
            @if($event_obj->id == $event)
                {{  $event_obj->name }}
            @endif
        @endforeach
    @endforeach
@endforeach--}}

    <!-- #INFORMATIONS -->
    <div class="container" id="informations">
        <div class="row">
            <div class="col-12 col-lg-8">

                <!-- Card -->
                <div class="card">

                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Adresse
                                    
                                </h5>

                            </div>
                            <div class="col-auto">

                                <time class="small text-muted">
                                    {{ $customer->location["address"] .' '. $customer->location["postal_code"] .' '. $customer->location["city"] }}
                                    <?php //dd($customer->events_id ?>
                                    
                                </time>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    SIREN
                                </h5>

                            </div>
                            <div class="col-auto">

                                <span class="small text-muted">
                                    {{ $customer->SIREN }}
                                </span>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Activité
                                </h5>

                            </div>
                            <div class="col-auto">

                                <small class="text-muted">
                                    {{ $customer->activity_type }}
                                </small>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-4">

                <!-- Card -->
                <div class="card">
                    <div class="card-header">

                        <!-- Title -->
                        <h4 class="card-header-title">
                            Contact
                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Nom
                                </h5>

                            </div>
                            <div class="col-auto">
                                <span class="small text-muted">
                                    {{ $customer->contact_person["lastname"] }}
                                </span>
                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Prénom
                                </h5>

                            </div>
                            <div class="col-auto">

                                <span class="small text-muted">
                                    {{ $customer->contact_person["firstname"] }}
                                </span>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Téléphone
                                </h5>

                            </div>
                            <div class="col-auto">

                                <small class="text-muted">
                                    {{ $customer->contact_person["phone"] }}
                                </small>

                            </div>
                        </div> <!-- / .row -->

                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Email
                                </h5>

                            </div>
                            <div class="col-auto">

                                <small class="text-muted">
                                    {{ $customer->contact_person["email"] }}
                                </small>

                            </div>
                        </div> <!-- / .row -->


                        <!-- Divider -->
                        <hr>

                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="mb-0">
                                    Poste
                                </h5>

                            </div>
                            <div class="col-auto">

                                    <small class="text-muted">
                                        {{ $customer->contact_person["job_title"] }}
                                    </small>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>

    <!-- #COMMENTS -->
    <div class="container" id="comments">
        <div class="row">
            <div class="col-12">
                @if($customer->informations)
                {{ $customer->informations }}
                @endif
            </div>
        </div> <!-- / .row -->
    </div>
</div>


@include('admin.Customer.includes.modalDelete')
@endsection