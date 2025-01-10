@extends('menu_examen')
@section('contenido')

    <div class="row">
        <form method="POST" id="formExamen" action="{{ url('curso/examen/section8') }}">
            @csrf
            <input type="hidden" value="8" name="section">
            <div class="col-xl-12">

                <div class="card custom-card">
                    <div class="card-header justify-content-between align-items-center">
                        <div class="card-title">Writing</div>
                        <div class="btn-list">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-2 mb-4 align-items-center">
                            <h6 class="fw-medium mb-0">
                                Global warming has become a serious threat to our planet. Explain what we can do as citizens
                                to reduce the effects of global warming. You may want to consider factors, such as:
                                <li>Recycling</li>
                                <li>The impact of fossil fuels (oil, gas and coal)</li>
                                <li>The impact of consumerism (buying things).</li>
                            </h6>
                        </div>
                        <div class="fs-15 fw-medium mb-2">{{ $pregunta->descripcion }}</div>
                        <div id="contador">Words: 0 of 125</div><br>
                        <textarea class="form-control" rows="5" name="respuesta_80" id="miTextarea" placeholder="Write here...">
                            {{ $resultado ? $resultado->respuesta_text : '' }}
                        </textarea>

                        <div id="alerta" class="alert alert-danger d-none mt-2"></div>
                    </div>
                </div>


            </div>


            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ url('curso/examen/section/7') }}"> <button type="button"
                        class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Preview&nbsp;&nbsp;</button></a>
                <button type="button" class="btn btn-primary btn-lg btn-wave"
                    onclick="validarFormulario()">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
            </div>

            <br>
        </form>

    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>


    <script>
        // Obtener el textarea y el div del contador
        const textarea = document.getElementById("miTextarea");
        const contador = document.getElementById("contador");

        // Añadir un evento 'input' para contar las palabras mientras escribes
        textarea.addEventListener("input", function() {
            // Obtener el texto escrito
            const texto = textarea.value;

            // Dividir el texto en palabras (considerando los espacios como delimitadores)
            const palabras = texto.trim().split(
                /\s+/); // La expresión regular /\s+/ maneja los espacios y saltos de línea

            // Si el contenido del textarea está vacío, no contamos palabras
            const numPalabras = texto.trim() === "" ? 0 : palabras.length;

            // Actualizar el texto del contador
            contador.textContent = "Words: " + numPalabras + " of 125";
        });



        function validarFormulario() {
            const texto = textarea.value.trim();
            const palabras = texto === "" ? [] : texto.split(/\s+/);
            const numPalabras = palabras.length;

            // Validar que no esté vacío
            if (texto === "") {
                mostrarAlerta("Ingresar una respuesta");
                return false;
            }

            // Validar que no tenga más de 125 palabras
            if (numPalabras > 125) {
                mostrarAlerta("La respuesta debe tener has 125 palabras");
                return false;
            }

            document.getElementById("formExamen").submit();

            // Si todo está bien, quitar la alerta (si existe) y continuar
            alerta.classList.add("d-none");
            return true;
        }

        function mostrarAlerta(mensaje) {
            alerta.textContent = mensaje;
            alerta.classList.remove("d-none");
        }
    </script>
@endsection
