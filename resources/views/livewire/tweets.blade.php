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
                <livewire:tweets-create/>
            </div>
            <div class="tab-pane fade" id="nav-mis-tweets" role="tabpanel" aria-labelledby="nav-mis-tweets-tab">
                <livewire:tweets-delete />
            </div>
        </div>
    </div>
</div>
