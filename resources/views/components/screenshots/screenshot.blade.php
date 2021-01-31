<section class="gallery-block cards-gallery">
    <div class="container">
        <!-- /images/screenshots/1.png  -->
        <div class="row">
            @foreach ($screenshots as $imagen)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 transform-on-hover">
                        <a class="lightbox" href=".{{ $imagen->link }}"><img
                                src=".{{ $imagen->link }}" class="card-img-top"></a>
                        <div class="card-body">
                            <p class="text-muted card-text"><strong style="color:#3490dc;">{{ $imagen->descripcion }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
