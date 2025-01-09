@extends('menu_student')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <head>
        <style>
            iframe {
                display: block;
                width: 100%;
                height: 0;
                padding-top: 56.25%;
                /* Aspect ratio for 16:9 video */
            }
        </style>
    </head>
    <div class="row">
        {{-- <div class="col-xl-6">
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
        </div> --}}


        <div class="col-xl-12">
            <div>
                <div>
                    <div>
                        <div class="text-center">
                            <h4><b>Exam</b></h4>

                            {{-- {{ $curso->nombre }} --}}
                        </div>

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

                <form method="POST" action="{{ url('catalogo/curso/show_examen_evaluar') }}">
                    @csrf


                    <div class="card-body">
                        @php($i = 1);
                        @foreach ($examen->preguntas->sortBy('id') as $pregunta)
                            @if ($pregunta->tipo_pregunta_id == 1)
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                    <input type="text" name="pregunta{{ $i }}" class="form-control" readonly>
                                </div>
                                <br>
                            @elseif ($pregunta->tipo_pregunta_id == 2)
                                @if ($pregunta->id == 1)
                                    <h5><b>PART 1
                                            <br>
                                            Click on the best word or phrase (a, b, c or d) to fill each blank.</b></h5>
                                @endif

                                @if ($pregunta->id == 21)
                                    <h5><b>PART 2
                                            <br>
                                            Reading.</b></h5>


                                    Read the text below. For questions 21 to 25, choose the best answer (a, b, c or d).
                                    <br>
                                    In 1895, the well-known scientist Lord Kelvin said, "Heavier than air flying machines
                                    are impossible." Kelvin was wrong. In 1943, Thomas Watson, the chairman of International
                                    Business Machines (IBM) was also wrong when he said that he thought there would be a
                                    world market for only five or so computers. Predictions can be wrong, and it is very
                                    difficult to predict what the world will be like in 100, 50, or even 20 years. But this
                                    is something that scientists and politicians often do. They do so because they invent
                                    things and make decisions that shape the future of the world that we live in. In the
                                    past they didn’t have to think too much about the impact that their decisions had on the
                                    natural world. But that is now changing. More and more people believe that we should
                                    live within the rules set by nature. In other words, they think that in a world of fixed
                                    and limited resources, what is used up today will no longer be available for our
                                    children. We need to look at each human activity and try to change it or create
                                    alternatives if it is not sustainable. The rules for this are set by nature, not by man.
                                @endif

                                @if ($pregunta->id == 26)
                                    <h5><b>PART 3
                                            <br>
                                            Structure.</b></h5>

                                            Click on the best word or phrase (a, b, c or d) to fill each blank.
                                    <br>
                                @endif

                                @if ($pregunta->id == 46)
                                    <h5><b>PART 4
                                            <br>
                                            Reading.</b></h5>

                                    Read the text below. For questions 46 to 50, choose the best answer (a, b, c or d). <br>
                                    Many hotel chains and tour operators say that they take their environmental commitments
                                    seriously, but often they do not respect their social and economic responsibilities to
                                    the local community. So is it possible for travellers to help improve the lives of
                                    locals and still have a good holiday?

                                    The charity, Tourism Concern, thinks so. It has pioneered the concept of the fair-trade
                                    holiday. The philosophy behind fair-trade travel is to make sure that local people get a
                                    fair share of the income from tourism. The objectives are simple: employing local people
                                    wherever possible; offering fair wages and treatment; showing cultural respect;
                                    involving communities in deciding how tourism is developed; and making sure that
                                    visitors have minimal environmental impact.

                                    Although there is currently no official fair-trade accreditation for holidays, the
                                    Association of Independent Tour Operators has worked hard to produce responsible tourism
                                    guidelines for its members. Some new companies, operated as much by principles as
                                    profits, offer a fantastic range of holidays for responsible and adventurous travellers.
                                @endif

                                @if ($pregunta->id == 51)
                                    <h5><b>PART 5
                                            <br>
                                            Structure.</b></h5>

                                            Click on the best word or phrase (a, b, c or d) to fill each blank.
                                    <br>
                                @endif



                                @if ($pregunta->id == 71)
                                    <h5><b>PART 6
                                            <br>
                                            Reading.</b></h5>

                                    Read the text below. For questions 71 to 76, choose the best answer (a, b, c or d). <br>
                                    Standards of spelling and grammar among an entire generation of English-speaking
                                    university students are now so poor that there is ‘a degree of crises in their written
                                    use of the language, the publisher of a new dictionary has warned. Its research revealed
                                    that students have only a limited grasp of the most basic rules of spelling, punctuation
                                    and meaning, blamed in part on an increasing dependence on ‘automatic tools’ such as
                                    computer spellcheckers and unprecedented access to rapid communication using e-mail and
                                    the Internet. The problem is not confined to the US, but applies also to students in
                                    Australia, Canada and Britain.
                                    Students were regularly found to be producing incomplete or rambling, poorly connected
                                    sentences, mixing metaphors ‘with gusto’ and overusing dull, devalued words such as
                                    ‘interesting’ and ‘good’. Overall they were unclear about appropriate punctuation,
                                    especially the use of commas, and failed to understand the basic rules of subject/verb
                                    agreement and the difference between ‘there’, ‘their’ and ‘they’re’.
                                    Kathy Rooney, editor-in-chief of the dictionary, said, ‘We need to be very concerned at
                                    the extent of the problems with basic spelling and usage that our research has revealed.
                                    This has significant implications for the future, especially for young people. We
                                    thought it would be useful to get in touch with teachers and academics to find out what
                                    problems their students were having with their writing and what extra help they might
                                    need from a dictionary. The results were quite shocking. We are sure that the use of
                                    computers has played a part. People rely increasingly on automatic tools such as
                                    spellcheckers that are much more passive than going to a dictionary and looking
                                    something up. That can lull them into a false sense of security.’
                                    Beth Marshall, an English professor, said, ‘The type of student we’re getting now is
                                    very different from what we were seeing 10 years ago and it is often worrying to find
                                    out how little students know. There are as many as 800 commonly misspelled words,
                                    particularly pairs of words that are pronounced similarly but spelled differently and
                                    that have different meanings – for example, “faze” and “phase”, and “pray” and “prey”.’
                                    <br>
                                @endif



                                @if ($pregunta->id == 77)
                                    <h5><b>PART 7
                                            <br>
                                            Listening.</b></h5>
                                    Listening part.
                                    For each question, you will hear a short sentence. The sentence will be spoken just one
                                    time. <br>
                                    The sentences you hear will not be written out for you.

                                    After you hear each sentence, read the 4 choices on the screen and decide which one is
                                    closest in meaning to the sentence you heard. Then select the best answer by clicking on
                                    it.

                                    <br>
                                    <audio controls>
                                        <source src="{{ asset('assets/images/audio77.mp3') }}" type="audio/mp3">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif

                                @if ($pregunta->id == 78)
                                    <audio controls>
                                        <source src="{{ asset('assets/images/audio78.mp3') }}" type="audio/mp3">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif

                                @if ($pregunta->id == 79)
                                    <audio controls>
                                        <source src="{{ asset('assets/images/audio79.mp3') }}" type="audio/mp3">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif

                                @if ($pregunta->id == 80)
                                    <h5><b>PART 8
                                            <br>
                                            Writing.</b></h5>
                                    <b>Global warming has become a serious threat to our planet.</b>
                                    <div>
                                        Explain what we can do as citizens to reduce the effects of global warming.
                                    </div>

                                    <div>
                                        You may want
                                        to consider factors, such as:
                                    </div>

                                    <ul>
                                        <li> Recycling</li>
                                        <li> The impact of fossil fuels (oil, gas and coal)</li>
                                        <li> The impact of consumerism (buying things).</li>
                                    </ul>


                                @endif




                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                        <div class="form-check">
                                            <input type="radio" style="background-color: #202947"
                                                onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                name="respuesta{{ $i }}" class="form-check-input">
                                            {{-- @if ($respuesta->correcta == '1')
                                                <label
                                                    class="form-check-label text-success">{{ $respuesta->descripcion }}</label>
                                            @else --}}
                                            <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            {{-- @endif --}}

                                            <input type="hidden" id="test{{ $respuesta->id }}"
                                                name="test{{ $respuesta->id }}" readonly />
                                        </div>
                                    @endforeach
                                </div>
                                <br>

                                @if ($pregunta->id ==80)
                                <textarea id="w3review" name="w3review" rows="4" cols="100">
                                    Write here.
                                    </textarea>
                                @endif
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
                                            <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                class="form-check-input">
                                            <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                            @endif
                            @php($i++);
                        @endforeach

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-info">&nbsp;&nbsp;Evaluar&nbsp;&nbsp;</button>
                    </div>
                </form>
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

        function setResponse(name, response) {
            var codigo = response;

            // alert(name);
            // alert(response);

            //alert('/get_correcta/' + codigo);

            $.ajax({
                url: 'http://154.12.255.170/cursos/public/get_correcta/' + codigo, // The URL to call the route
                type: 'GET', // Using GET request
                success: function(response) {

                    // Handle the successful response
                    console.log('Correcta: ', response);
                    document.getElementById(name).value = response;

                    // You can display the result somewhere on the page
                    //$('#result').text('Correcta: ' + response.correcta);
                },
                error: function(xhr, status, error) {
                    // Handle errors (e.g., record not found)
                    console.error('Error: ' + error);
                    document.getElementById(name).value = 'Error: Respuesta no encontrada';
                    //$('#result').text('Error: Respuesta no encontrada');
                }
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
