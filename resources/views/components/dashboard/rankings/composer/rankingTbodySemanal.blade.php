@if (isset($searchLive))
    @foreach ($usuarios as $key => $usuario)
        @if ($key == 1)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #ffff00;border:3px solid white;">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #ffff00">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif

        @elseif ($key == 2)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #f90;border:3px solid white;">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #f90">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif


        @elseif ($key == 3)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #f60;border:3px solid white;">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #f60">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif
        @else
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #01466f; color: white; border:3px solid white;">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: white;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #01466f; color: white">
                    <th scope="row">{{ $key }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: white;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif
        @endif
    @endforeach
@else
    @foreach ($usuarios as $key => $usuario)
        @if ($key + 1 == 1)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #ffff00;border:3px solid white;">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #ffff00">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif

        @elseif ($key+1 == 2)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #f90;border:3px solid white;">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #f90">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif


        @elseif ($key+1 == 3)
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #f60;border:3px solid white;">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #f60">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: black;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif
        @else
            @if ($usuario->id == auth()->user()->id)
                <tr style="background-color: #01466f; color: white; border:3px solid white;">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: white;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @else
                <tr style="background-color: #01466f; color: white">
                    <th scope="row">{{ $key + 1 }}</th>
                    <th>
                        <a href="{{ route('look.user.profile', $usuario->nombre) }}"
                            style="text-decoration: none; color: white;"> {{ $usuario->nombre }}</a>
                    </th>
                    <th>{{ $usuario->puntos }}</th>
                      @if (isset($besos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($besos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'besos' => true])</th>
                    @elseif (isset($jugos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($jugos_recibidos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'bebidas' => true])</th>
                    @elseif (isset($flores_enviadas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($flores_recibidas))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'flores' => true])</th>
                    @elseif (isset($uppers_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'uppercuts' => true])</th>
                    @elseif (isset($cocos_enviados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocos' => true])</th>
                    @elseif (isset($puntos_ninja))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ninja' => true])</th>
                    @elseif (isset($rings_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'ring' => true])</th>
                    @elseif (isset($senderos_ganados))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'sendero' => true])</th>
                    @elseif (isset($puntos_cocos))
                        <th class="p-0">@include('components.dashboard.rankings.levelsComposer.levels', ['usuario' =>
                            $usuario,
                            'cocosLocos' => true])</th>
                    @endif
                </tr>
            @endif
        @endif
    @endforeach
@endif
