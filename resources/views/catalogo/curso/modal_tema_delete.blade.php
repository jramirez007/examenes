<div class="modal fade" id="modal-delete-tema-{{$tema->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <form method="POST" action="{{ url('catalogo/curso/delete_tema') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Eliminar tema
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $tema->id }}" required class="form-control">
                <p>¿Desea eliminar el registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info">Aceptar</button>
            </div>
        </div>
    </form>
</div>
</div>
