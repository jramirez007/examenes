<div class="modal fade" id="modal-clave-{{ $obj->id }}">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ url('seguridad/usuario/reset_clave') }}/{{$obj->id}}">

            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Clave del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-area relative">
                        <label for="" class="form-label">* Minimo de 8 caracteres</label>
                    </div>
                    <div class="input-area relative">
                        <label for="largeInput" class="inline-inputLabel">Clave</label>
                        <input type="password" minlength="8" name="password" class="form-control" required">

                    </div> &nbsp;
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </form>
    </div>
</div>
