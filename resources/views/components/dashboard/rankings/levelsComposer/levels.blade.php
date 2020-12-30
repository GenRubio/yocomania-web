@isset($besos)
    <img src="{{ url('/images/levelsSvg/204.svg') }}" height="43" , width="43">
@endisset
@isset($bebidas)
    <img src="{{ url('/images/levelsSvg/196.svg') }}" height="43" , width="43">
@endisset
@isset($flores)
    <img src="{{ url('/images/levelsSvg/188.svg') }}" height="43" , width="40">
@endisset
@isset($uppercuts)
    @include('components.dashboard.rankings.levelsComposer.levels.uppercut', ['usuario' => $usuario])
@endisset
@isset($cocos)
    @include('components.dashboard.rankings.levelsComposer.levels.coco', ['usuario' => $usuario])
@endisset
@isset($ring)
    @include('components.dashboard.rankings.levelsComposer.levels.uppercut', ['usuario' => $usuario])
@endisset
@isset($cocosLocos)
    @include('components.dashboard.rankings.levelsComposer.levels.coco', ['usuario' => $usuario])
@endisset
@isset($ninja)
    @include('components.dashboard.rankings.levelsComposer.levels.ninja', ['usuario' => $usuario])
@endisset
@isset($sendero)
<img src="{{ url('/images/levelsSvg/liana.png') }}" height="43" , width="40">
@endisset