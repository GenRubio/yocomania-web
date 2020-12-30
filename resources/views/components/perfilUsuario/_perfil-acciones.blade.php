@php
$amigoAgregado = App\Models\BpadAmigo::where('ID_2', auth()->user()->id)
->where('ID_1', $usuario->id)->first();
@endphp
@if ($amigoAgregado != null)
    @if ($amigoAgregado->Solicitud == 0)
        <form id="eliminarAmigo">
            @csrf
            <input type="hidden" name="accion" value="eliminar">
            <input type="hidden" name="amigoId" value="{{ $usuario->id }}">
            <button type="submit" class="btn btn-outline-danger btn-lg shadow p-3 btn-block">
                <strong>Eliminar amigo</strong>
            </button>
        </form>
    @else
        <form id="cancelarSolicitudAmigo">
            @csrf
            <input type="hidden" name="accion" value="cancelar">
            <input type="hidden" name="amigoId" value="{{ $usuario->id }}">
            <button type="submit" class="btn btn-outline-info btn-lg shadow p-3 btn-block">
                <strong>Cancelar Solicitud</strong>
            </button>
        </form>
    @endif
@else
    <form id="agregarAmigo">
        @csrf
        <input type="hidden" name="accion" value="agregar">
        <input type="hidden" name="amigoId" value="{{ $usuario->id }}">
        <button type="submit" class="btn btn-outline-success btn-lg shadow p-3 btn-block">
            <strong>Agregar amigo</strong>
        </button>
    </form>
@endif
<script>
    $(document).ready(function() {
        $("#eliminarAmigo").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('obtener.accion.perfil') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#amigoOpciones').html(data.content);
                },
            })
        });
        $("#cancelarSolicitudAmigo").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('obtener.accion.perfil') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#amigoOpciones').html(data.content);
                },
            })
        });
        $("#agregarAmigo").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('obtener.accion.perfil') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#amigoOpciones').html(data.content);
                },
            })
        });
    });
</script>