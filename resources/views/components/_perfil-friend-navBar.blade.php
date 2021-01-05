<div class="p-1 shadow bg-white" style="background-color: white">
    <div class="container">
        <ul class="nav nav-pills ml-1">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('me') ? 'active' : '' }}" href="{{ url('/me') }}">
                    <div class="d-flex">
                        <div class="mr-1">
                            <i class="fas fa-home"></i>
                        </div>
                        <div>
                            <strong>{{ auth()->user()->nombre }}</strong>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a type="button border" class="nav-link" data-toggle="modal" data-target="#playModal">
                    <div class="d-flex">
                        <div class="mr-1" style="color: #dc7e05">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <div>
                            <strong style="color:#dc7e05;">Jugar desde WEB</strong>
                        </div>
                    </div>  
                </a>
                <style>
                    @media screen and (min-width: 676px) {
                        .play-modal {
                            max-width: 1014px;
                        }
                    }

                </style>
                <!-- Modal -->
                <div class="modal fade" id="playModal" tabindex="-1" role="dialog" aria-labelledby="playModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog play-modal" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="playModalLabel"><strong
                                        style="color: #3490dc;">Yocomania Chat &
                                        Play</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @include('webPlay.play')
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ranking.ring') }}">
                    <div class="d-flex">
                        <div class="mr-1">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div>
                            <strong>Rankings</strong>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('shop') ? 'active' : '' }}"
                    href="{{ url('/shop') }}">
                    <div class="d-flex">
                        <div class="mr-1">
                            <i class="fas fa-store"></i>
                        </div>
                        <div>
                            <strong>Tienda</strong>
                        </div>
                    </div>  
                </a>
            </li>
            <li class="nav-item">
                <form id="cerrarSession" method="POST"
                    action="{{ route('logout', ['usuario' => auth()->user()->id]) }}">
                    @csrf
                    <a class="nav-link" href="javascript:{}"
                        onclick="document.getElementById('cerrarSession').submit();">
                        <div class="d-flex">
                            <div class="mr-1" style="color: rgb(240, 71, 71)">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <div>
                                <strong style="color: rgb(240, 71, 71)">Cerrar sesíon</strong>
                            </div>
                        </div>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
