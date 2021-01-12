<div>
    <div class="d-flex justify-content-center">
        <h3 class="p-3">Crear Producto</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="crear" encrypt="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nombre producto</label>
            @error('nombre') <span class="error" style="color: red">{{ $message }}</span> @enderror
            <input wire:model.debounce.500ms="nombre" type="text" class="form-control" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label>Precio</label>
            @error('precio') <span class="error" style="color: red">{{ $message }}</span> @enderror
            <input wire:model="precio" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Créditos</label>
            @error('creditos') <span class="error" style="color: red">{{ $message }}</span> @enderror
            <input wire:model="creditos" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Imagen producto</label>
            @error('image') <span class="error" style="color: red">{{ $message }}</span> @enderror
            <input id="image" type="file" class="form-control-file" wire:model="image">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
