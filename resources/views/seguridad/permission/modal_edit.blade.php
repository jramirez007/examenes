<div class="modal fade" id="modal-edit-{{ $obj->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('permission.update', $obj->id) }}">
                @method('PUT')
                @csrf
                @if (count($errors) > 0)
                <br>
                <div class="mb-3 col-md-6 col-sm-12" style="margin-left: 20px">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Modificar registro
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  gy-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="input-label" class="form-label">Nombre</label>
                        <input type="text" name="name" value="{{ $obj->name }}" class="form-control"
                            value="{{ old('name') }}"   required onkeypress="return onlyLetters(event)">
                    </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
<script>
    function onlyLetters(event) {
        var char = String.fromCharCode(event.which);
        if (!/[a-zA-ZñÑ\s]/.test(char)) {
            event.preventDefault();
        }}
        </script>
</div>

