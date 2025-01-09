<div class="modal fade" id="modal-delete-{{ $obj->id }}">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('usuario.destroy', $obj->id) }}">
            @method('delete')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-base text-slate-900 dark:text-white leading-6">
                        Confirme si desea dehabilitar al Usuario
                    </h6>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
