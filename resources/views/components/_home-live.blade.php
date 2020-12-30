
<div class="d-flex justify-content-center">
    <h2><strong>Live</strong></h2>
</div>
@foreach ($videos as $video)
    <hr style="border-top: 1px dashed white">
    <div class="embed-responsive embed-responsive-4by3 shadow-lg rounded">
        <iframe class="embed-responsive-item" src="{{ $video->link }}" allowfullscreen></iframe>
    </div>
    <br>
@endforeach
<div class="d-flex justify-content-center">
    {{ $videos->links('pagination::bootstrap-4') }}
</div>
