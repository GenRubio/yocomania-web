@if ($amigo->avatar == 1)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/nerd.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 2)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/vieja.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 3)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
           
            <img src="{{ url('/images/avataresSVG/bPads/rasta.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 4)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/viejo.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 5)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/india.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 6)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/mafioso.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 7)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/zeta.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 8)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/gata.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 9)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/boomer.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 10)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/DJ.svg') }}">
        </div>
    </div>
@elseif ($amigo->avatar == 11)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: 37px; height: 37px; overflow:hidden; border-radius: 50%;">
            <img src="{{ url('/images/avataresSVG/bPads/bruja.svg') }}">
        </div>
    </div>
@endif
