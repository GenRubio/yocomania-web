<div class="row ml-0 mr-0 shadow-lg">
    <div class="col"
        style="border-bottom: 5px solid white;background-color: #c6481d; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
        <div class="container" style="background-color: #c6481d;color:white">
            <br>
            <div class="d-flex justify-content-center">
                <h1><strong>FanArt</strong></h1>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <svg width="20px" height="20px" viewBox="0 0 20 20" class="bi bi-bootstrap-fill"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.5355339,10.7071068 L9,14.2426407 L7.58578644,12.8284271 L10.4142136,10 L7.58578644,7.17157288 L9,5.75735931 L13.2426407,10 L12.5355339,10.7071068 L12.5355339,10.7071068 Z M10,-5.68434189e-14 C4.4771525,-5.68434189e-14 -5.68434189e-14,4.4771525 -5.68434189e-14,10 C-5.68434189e-14,15.5228475 4.4771525,20 10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,-5.32907052e-14 10,-5.68434189e-14 L10,-5.68434189e-14 Z M2,10 C2,14.418278 5.581722,18 10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 L2,10 Z" />
                    </svg>
                </div>
                <div class="col col-lg-10">
                    <h4>
                        <strong>
                            Yocomania FanArt: dibujos realizados por nuestros queridos jugadores.<br> Puedes publicar tus dibujos desde el panel de usuario.
                        </strong>
                       
                    </h4>
                    <span style="color: #ffffff2e">PD: Algunas imagenes no pertenecen a Yocomania!!! Solo es un lorenipsu</span>
                </div>
            </div>
            <hr style="border-top: 1px dashed white">
            @include('components.fanart.fanart')
        </div>
    </div>
</div>
<script>
    baguetteBox.run('.cards-gallery-fanart', {
        animation: 'slideIn'
    });
</script>
