@if (count($amigos) <= 0)
    <div class="shadow-sm rounded border mb-2">
        <div class="d-flex justify-content-center">
            <strong style="font-size: 19px">Aun no tienes amigos</strong>
        </div>
    </div>
@else
    @foreach ($amigos as $amigo)

        <div class="shadow-sm rounded border mb-2">
            <button type="button" data-toggle="modal" data-target="#chatAmigo" class="btn start_chat p-0"
                style="height: 53px;background-color: transparent; width:100%" data-touserid="{{ $amigo->id }}"
                data-tousername="{{ $amigo->nombre }}">

                <div class="d-flex flex-wrap align-content-center">
                    @php
                    $status = '';
                    $current_timestamp = strtotime(date('Y-m-d H:i:s'). '-10 second');
                    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
                    $user_last_activity = user_last_activity_fetch($amigo->id);
                    $user_last_activityYo = user_last_activity_fetch(auth()->user()->id);

                    if ($user_last_activity > $current_timestamp){
                    $status = 'color:#68dd10';
                    }
                    else{
                    $status = 'color:#a2a2a2';
                    }

                    @endphp
                    <div class="ml-1" style="{{ $status }}">
                        <svg width="10px" height="10px" viewBox="0 0 20 20" class="bi bi-bootstrap-fill"
                            fill="currentColor">
                            <path
                                d="M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M6.99999861,6.00166547 C6.99999861,4.34389141 8.3465151,3 9.99999722,3 C11.6568507,3 12.9999958,4.33902013 12.9999958,6.00166547 L12.9999958,7.99833453 C12.9999958,9.65610859 11.6534793,11 9.99999722,11 C8.34314374,11 6.99999861,9.66097987 6.99999861,7.99833453 L6.99999861,6.00166547 Z M3.34715433,14.4444439 C5.37306718,13.5169611 7.62616222,13 10,13 C12.3738388,13 14.6269347,13.5169615 16.6528458,14.4444437 C15.2177146,16.5884188 12.7737035,18 10,18 C7.22629656,18 4.78228556,16.5884189 3.34715433,14.4444439 L3.34715433,14.4444439 Z"
                                id="Combined-Shape"></path>
                        </svg>
                    </div>
                    <div>
                        @include('components.perfilUsuario._avatarBpad')
                    </div>
                    <div>
                        <div class="m-1">
                            <div class="d-flex">
                                <div>
                                    <strong style="font-size: 24px; color: #3490dc;">{{ $amigo->nombre }}</strong>
                                </div>
                                <div class="d-flex align-items-center m-2">
                                    <span class="badge badge-success"
                                        style="font-size: 15px;">{{ count_unseen_message($amigo->id, auth()->user()->id) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
        </div>
    @endforeach
@endif
