<div>
    <div style="min-height: 400px">
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-yocomania-tab" data-toggle="tab" href="#nav-yocomania"
                    role="tab" aria-controls="nav-yocomania" aria-selected="true"><strong>Yocomania</strong></a>
                <a class="nav-item nav-link" id="nav-mis-tweets-tab" data-toggle="tab" href="#nav-mis-tweets" role="tab"
                    aria-controls="nav-mis-tweets" aria-selected="false"><strong>Mis Tweets</strong></a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-yocomania" role="tabpanel"
                aria-labelledby="nav-yocomania-tab">
                <br>
                <div class="shadow p-3 ml-0 mr-0 rounded">
                    <div class="d-flex justify-content-center">
                        <h3 style="color: #3490dc" ;><strong>Yoco<i class="fab fa-twitter"></i>Tweet</strong></h3>
                    </div>
                    <form wire:submit.prevent="publicar">
                        <div class="row">
                            <div class="col col-lg-2">
                                @include('components.Avatares._dinamicAvatar', ['usuario' =>
                                getUsuario(auth()->user()->id),
                                'height' =>
                                '100px', 'width' =>
                                '100px', 'route' => '/images/avataresSVG/'])
                            </div>
                            <div class="col-md-auto p-0"></div>
                            <div class="col p-0 mt-2 mr-2">
                                <textarea wire:model="comentario" id="tweetText" class="form-control" rows="4"
                                    placeholder="¿Qué está pasando?"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-1">
                            <button  id="publicTweet" type="submit" class="btn btn-primary"><strong>Publicar <i
                                        class="fab fa-twitter"></i>Tweet</strong></button>
                        </div>
                    </form>
                </div>
                <br><br>

            </div>
            <div class="tab-pane fade" id="nav-mis-tweets" role="tabpanel" aria-labelledby="nav-mis-tweets-tab">
                <livewire:tweets-delete />
            </div>
        </div>
    </div>
    <script>


    </script>
</div>
