<div>
    <div class="d-flex justify-content-center">
        <h3><strong>Crea Noticia</strong></h3>
    </div>
    <form wire:submit.prevent="create">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-group">
            <label>Titulo</label>
            @error('titulo') <span class="error">{{ $message }}</span> @enderror
            <input wire:model="titulo" type="text" class="form-control" placeholder="Titulo" required>
        </div>
        <div class="form-group">
            <label>Contenido</label>
            @error('descripcion') <span class="error">{{ $message }}</span> @enderror
            <textarea wire:model="descripcion" class="form-control" rows="8" required></textarea>
        </div>
        <div class="form-group">
            <label>Imagen</label>
            <input wire:model="imagen" type="file" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
