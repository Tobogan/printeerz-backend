<div id="event_users">
    <div class="row fluid justify-content-center">
        <div class="col-12">
            <?php $i = 0; ?>
            @foreach($users as $user)
                @if(isset($event->user_ids))
                    @foreach($event->user_ids as $user_id)
                        @if($user_id == $user->id)
                            <?php $i++; ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center py-2">
                                        <div class="col-auto">
                                            @if(!empty($user->profile_img) && $disk->exists($user->profile_img))
                                                <img src="{{$disk->url($user->profile_img) }}" alt="User image" class="avatar-img rounded">
                                            @else <!--Initials-->
                                                <div class="avatar-lg">
                                                    <?php $userFirstLetter = $user->username[0]; ?>
                                                    <span class="avatar-title rounded">{{ $userFirstLetter }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col ml-n2">
                                            <h4 class="card-title mb-1 name">
                                                {{ $user->firstname.' '.$user->lastname }}
                                                @if($user->role == 2)
                                                    <p class="text-muted mt-2"><small>Administrateur</small></p>
                                                @elseif($user->role == 1)
                                                    <p class="text-muted mt-2"><small>Opérateur</small></p>
                                                @else
                                                    <p class="text-muted mt-2"><small>Technicien</small></p>
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="col-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if($i == 0)
                <div id="event_users">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card card-inactive">
                                <div class="card-body text-center">
                                    <!-- Image -->
                                    <img src="/img/svg/team_spirit.svg" alt="..." class="img-fluid" style="max-width: 182px;">
                                    <!-- Title -->
                                    <h1>
                                        Pas d'utilisateurs encore.
                                    </h1>
                                    <!-- Subtitle -->
                                    <p class="text-muted">
                                        Ajoutez votre premier utilisateur pour cet événement
                                    </p>
                                    <!-- Button -->
                                    <a href="#" class="btn btn-primary">
                                        Ajoutez un utilisateur
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>