<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <strong>Recuperar datos Yocomania</strong>
            </div>
        </div>
        <div class="card-body">
            <p>Hola, {{ auth()->user()->nombre }}. Aquí podrás recuperar los datos de tus cuentas de Yocomania.<br>
                Al recuperar una cuenta los datos del personaje se sumarán a los datos de esta cuenta.<br>
                Una vez recuperados los datos no podrán ser recuperados otra vez.<br>
                Puedes recuperar todas tus cuentas y sumar los datos.</p>
            <div class="d-flex justify-content-center">
                <a type="button" data-toggle="modal" data-target="#infoRecuDatos">
                    <strong style="color: #3490dc;text-decoration: none;">Más información</strong>
                </a>
            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form wire:submit.prevent="crearSolicitud">
                @csrf
                <div class="form-group">
                    <label>Nombre de Usuario: </label>
                    @error('nombre') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    <input wire:model.debounce.500ms="nombre" type="text" class="form-control" placeholder="Nombre de Usuario" required>
                </div>
                <div class="form-group">
                    <label>Password: </label>
                    @error('password') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    <input wire:model.debounce.500ms="password" type="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Clave de Seguridad: </label>
                    @error('clave') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    <input wire:model.debounce.500ms="clave" type="password" class="form-control" placeholder="Clave de Seguridad">
                    <small class="form-text text-muted">En caso de que no tengas clave deja vacío este campo.</small>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <div class="modal fade" id="infoRecuDatos" tabindex="-1" role="dialog" aria-labelledby="infoRecuDatosLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoRecuDatosLabel">Recuperar datos Yocomania</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <h3><strong style="color: #3490dc">Datos recuperables</strong></h3>
                            </div>
                            <p>1. Créditos Oro<br>
                                2. Créditos Plata<br>
                                3. Besos enviados<br>
                                4. Besos recibidos<br>
                                5. Flores enviadas<br>
                                6. Flores recibidas<br>
                                7. Bebidas enviadas<br>
                                8. Bebidas recibidas<br>
                                9. Uppercuts enviados<br>
                                10. Uppercuts recibidos<br>
                                11. Cocos enviados<br>
                                12. Cocos recibidos<br>
                                13. Ring's ganados<br>
                                14. Senderos ganados<br>
                                15. Puntos Cocos Locos<br>
                                16. Puntos Camino Ninja<br>
                                Los datos serán a los datos actuales de la cuenta.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
