<div class="modal fade" id="modal-update-tema-{{$tema->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <form method="POST" action="{{ url('catalogo/curso/update_tema') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Modificar tema
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $tema->id }}" required class="form-control">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="input-label" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                        value="{{ $tema->nombre }}" required onblur="this.value = this.value.toUpperCase()">
                </div>


                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="input-label" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control"   required onblur="this.value = this.value.toUpperCase()">{{ $tema->descripcion }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info">Aceptar</button>
            </div>
        </div>
    </form>
</div>
</div>
