<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{route('usuario.store')}}">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Crear Usuario
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body gy-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="input-label" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required onkeypress="return onlyLetters(event)">
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="margin-top: 10px">
                        <label for="input-label" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="margin-top: 10px">
                        <label for="input-label" class="form-label">Contraseña</label>
                        <input type="password" minlength="8" name="password" class="form-control" value="{{ old('password') }}" required>
                    </div>

                   
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 gy-4">
                        <br>
                        <label for="input-label" class="form-label">Departamento</label>
                        <select name="departamento_id" class="form-select" data-trigger id="choices-single-default">
                        <option value="">Seleccione...</option>
                            @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}"
                                {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                {{ $departamento->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
