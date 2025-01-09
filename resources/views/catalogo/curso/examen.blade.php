@extends('menu')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ $examen->descripcion }}
                    </div>
                    <div class="prism-toggle">
                        <a href="{{ url('catalogo/curso') }}">
                            <button class="btn btn-outline-dark btn-wave">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>

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

                <div class="card-body">
                    <form id="form_examen">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">Pregunta</label>
                                <input type="hidden" name="examen_id" value="{{ $examen->id }}">
                                <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                                    required class="form-control" onblur="this.value = this.value.toUpperCase()">
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="adjunto" class="form-label">Tipo</label>
                                <select name="tipo_pregunta_id" id="tipo_pregunta_id" class="form-select"
                                    onchange="get_tipo(this.value)">
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="div_respuesta">
                            </div>


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                                <button type="button" onclick="saveRespuesta()"
                                    class="btn btn-info">&nbsp;&nbsp;Aceptar&nbsp;&nbsp;</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Previsualización
                    </div>
                    <div class="prism-toggle">

                    </div>
                </div>

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

                <div class="card-body">

                    @foreach ($examen->preguntas->sortBy('id') as $pregunta)
                        @if ($pregunta->tipo_pregunta_id == 1)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <br>
                        @elseif ($pregunta->tipo_pregunta_id == 2)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                    <div class="form-check">
                                        <input type="radio" name="pregunta{{ $pregunta->id }}" class="form-check-input">
                                        @if ($respuesta->correcta == '1')
                                            <label class="form-check-label text-success">{{ $respuesta->descripcion }}</label>
                                        @else
                                            <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                        @endif


                                    </div>
                                @endforeach
                            </div>
                            <br>
                        @elseif ($pregunta->tipo_pregunta_id == 3)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                <select class="form-select">
                                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                        <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <br>
                        @elseif ($pregunta->tipo_pregunta_id == 4)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                @foreach ($pregunta->respuestas as $respuesta)
                                    <div class="form-check">
                                        <input type="checkbox" name="pregunta{{ $pregunta->id }}" class="form-check-input">
                                        <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



    <script>
        function get_tipo(id) {
            const url = `{{ url('curso/examen') }}/${id}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.text(); // Cambiar a response.text() para manejar HTML
                })
                .then(html => {
                    document.getElementById('div_respuesta').innerHTML = html; // Insertar HTML en el div
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>






    <script>
        function saveRespuesta() {
            const form = document.getElementById('form_examen');
            let formData = new FormData(form);

            //alert(JSON.stringify(formData));

            let valid = true;

            Array.from(form.elements).forEach(element => {
                if (element.name) {

                    var x = element.name;
                    var index = x.search(/\d/); // Find the index of the first digit
                    var word = x.substring(0, index); // Extract the part before the number


                    if (!element.value.trim()) {
                        valid = false;
                        element.classList.add('is-invalid');
                    } else {
                        element.classList.remove('is-invalid');
                    }
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Por favor, rellena todos los campos.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ url('curso/examen') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la red: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        console.log(data);
                        window.location.href = "{{ url('catalogo/curso/show_examen/') }}/{{ $examen->id }}";

                        // Swal.fire({
                        //      icon: 'success',
                        //      title: 'Éxito',
                        //      text: data.message,
                        //      confirmButtonText: 'Aceptar'
                        //  });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al enviar el formulario.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al enviar el formulario.',
                        confirmButtonText: 'Aceptar'
                    });
                });
        }
    </script>





    <script>
        let counter = 1; // Contador inicial para los nombres de los inputs

        function addInput() {
            // Crear un nuevo elemento div
            const newDiv = document.createElement('div');
            newDiv.classList.add('col-xl-8', 'col-lg-8', 'col-md-8', 'col-sm-8', 'mb-2', 'd-flex',
                'align-items-center');
            newDiv.setAttribute('data-id', counter); // Establecer un atributo data-id único

            // Crear un nuevo botón de basurero
            const trashButton = document.createElement('button');
            trashButton.type = 'button';
            trashButton.classList.add('btn', 'btn-danger', 'me-2');
            trashButton.innerHTML = '<i class="bi bi-trash"></i>'; // Icono de Bootstrap

            // Añadir evento para eliminar el input al presionar el botón de basurero
            trashButton.onclick = function() {
                newDiv.remove();
                updateInputNames(); // Actualizar los nombres de los inputs restantes
            };

            // Crear un nuevo input
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'respuesta' + counter; // Asignar nombre incremental
            newInput.classList.add('form-control');
            newInput.placeholder = 'Respuesta ' + counter; // Placeholder

            const newDiv2 = document.createElement('div');
            newDiv2.classList.add('col-xl-4', 'col-lg-4', 'col-md-4', 'col-sm-4', 'mb-2', 'd-flex',
                'align-items-center');


            // Create a new checkbox element
            const newCheckbox = document.createElement('input');
            newCheckbox.type = 'checkbox';
            newCheckbox.name = 'option' + counter; // Assign an incremental name
            newCheckbox.id = 'checkbox' + counter; // Optional: Assign an ID
            newCheckbox.value = 'Option ' + counter; // Assign a value

            // Create a label for the checkbox
            const newLabel = document.createElement('label');
            newLabel.htmlFor = newCheckbox.id; // Associate label with checkbox
            newLabel.textContent = 'Es correcta? '; // Label text


            // Añadir el botón de basurero y el input al div
            newDiv.appendChild(trashButton);
            newDiv.appendChild(newInput);


            newDiv.appendChild(newCheckbox);
            newDiv.appendChild(newLabel);

            // Añadir el nuevo div al div principal
            document.getElementById('div_option').appendChild(newDiv);

            // Incrementar el contador
            counter++;
        }

        function updateInputNames() {
            // Obtener todos los divs hijos en el contenedor principal
            const inputs = document.querySelectorAll('#div_option > div');
            counter = 1; // Reiniciar el contador

            // Recorrer los divs y actualizar los nombres de los inputs
            inputs.forEach(div => {
                const input = div.querySelector('input');
                input.name = 'respuesta' + counter; // Asignar nuevo nombre basado en el contador
                input.placeholder = 'Respuesta ' + counter; // Actualizar el placeholder
                counter++; // Incrementar el contador
            });
        }
    </script>




@endsection
