<div class="p-1"></div>
<div class="row ml-1 mr-1 border p-2 rounded mb-1" style="background-color: aliceblue;">
    <div class="col text-center">
        <h4><strong style="color: #3490dc;">Estadísticas</strong></h4>
    </div>
</div>

<div class="row ml-1 mr-1 mb-1">
    <table class="table table-bordered">
        <thead style="background-color: aliceblue; color: #3490dc;">
            <tr>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Besos</strong></h4>
                        </div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/besos.png') }}">
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Cocktails</strong></h4>
                        </div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/coctails.png') }}">
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Flores</strong></h4>
                        </div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/rozas.png') }}">
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Enviados:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->besos_enviados }}</strong>
                </td>
                <td>
                    <strong>Enviados:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->jugos_enviados }}</strong>
                </td>
                <td>
                    <strong>Enviados:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->flores_enviadas }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Recibidos:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->besos_recibidos }}</strong>
                </td>
                <td>
                    <strong>Recibidos:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->jugos_recibidos }}</strong>
                </td>
                <td>
                    <strong>Recibidos:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->flores_recibidas }}</strong>
                </td>
            </tr>
        </tbody>
        <thead style="background-color: aliceblue; color: #3490dc;">
            <tr>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Uppercuts</strong></h4>
                        </div>
                        <div class="col">
                            @include('components.perfilUsuario.estadisticas._upper', ['usuario' => $usuario])
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Cocos</strong></h4>
                        </div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/cocos.png') }}">
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Ring</strong></h4>
                        </div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/ring.png') }}">
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Enviados:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->uppers_enviados }}</strong>
                </td>
                <td>
                    <strong>Enviados:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->cocos_enviados }}</strong>
                </td>
                <td>
                    <strong>Ganados:</strong> <strong
                        style="color: #fdc200;">{{ $usuario->rings_ganados }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Recibidos:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->uppers_recibidos }}</strong>
                </td>
                <td>
                    <strong>Recibidos:</strong> <strong
                        style="color: #3490dc;">{{ $usuario->cocos_recibidos }}</strong>
                </td>
            </tr>
        </tbody>
        <thead style="background-color: aliceblue; color: #3490dc;">
            <tr>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Sendero Oculo</strong></h4>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col">
                            <img src="{{ url('/images/estadisticas/sendero.png') }}">
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Cocos Locos</strong></h4>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col">
                            @include('components.perfilUsuario.estadisticas._coco', ['usuario' => $usuario])
                        </div>
                    </div>
                </th>
                <th>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4><strong>Camino Ninja</strong></h4>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col">
                            @include('components.perfilUsuario.estadisticas._ninja', ['usuario' => $usuario])
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Ganados:</strong> <strong
                        style="color:#fdc200">{{ $usuario->senderos_ganados }}</strong>
                </td>
                <td>
                    <strong>Puntos:</strong> <strong style="color: #fdc200">{{ $usuario->puntos_cocos }}</strong>
                </td>
                <td>
                    <strong>Puntos:</strong> <strong style="color: #fdc200">{{ $usuario->puntos_ninja }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
