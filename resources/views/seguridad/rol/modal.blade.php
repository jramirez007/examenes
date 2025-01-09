<div class="modal fade" id="modal-delete-{{ $obj->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('rol.destroy', $obj->id) }}">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Eliminar registro
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  gy-5">
                    <p>¿Desea eliminar el registro?</p>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

