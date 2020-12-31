@if (count($usuarios) == 0)
<div class=" rounded shadow m-4">
    <div class="d-flex justify-content-center">
        <h4><strong>Usuario no encontrado</strong></h4>
    </div>
</div>
@endif
@foreach ($usuarios as $persona)
    <div class=" rounded shadow m-4">
        <div class="row">
            <div class="col border-right mb-2">
                @include('components.Avatares._dinamicAvatar', ['usuario' => $persona, 'height' => '100px', 'width' =>
                '100px', 'route' => '/images/avataresSVG/'])
            </div>
            <div class="col-5 text-center border-right">
                <div class="mt-3">
                    @if ($persona->vip > 0)
                        <div class="d-flex justify-content-center">
                            <div>
                                <h3><strong style="color: #ba0aba">{{ $persona->nombre }}</strong>
                            </div>
                            <div>
                                <img src="{{ url('/images/perfil/mariposa.png') }}" alt="">
                            </div>
                        </div>
                    @else
                        <h3><strong>{{ $persona->nombre }}</strong></h3>
                    @endif
                    <h6>{{ $persona->bocadillo }}</h6>
                </div>

            </div>
            <div class="col align-self-center text-center">
                <a href="{{ route('look.user.profile', $persona->nombre) }}"  style="color: white" class="btn btn btn-info btn-lg shadow p-3">
                    <strong>Visitar Perfil</strong>
                </a>
            </div>
        </div>
    </div>
@endforeach
<br>
<div class="d-flex justify-content-center">
    {{ $usuarios->links('pagination::bootstrap-4') }}
</div>
<br><br>