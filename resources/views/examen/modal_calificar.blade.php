<div class="modal fade" id="modal-calificar-{{ $obj->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="POST" action="{{ route('evaluate_section89') }}">
                @csrf

                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Set Score</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h6 class="modal-title">Section 8</h6>
                    <label for="nombre" class="form-check-label">
                        <b>
                            <center>Writing</center>
                            <input type="hidden" value="{{ $obj->getSeccion8Id() }}" name="seccion8_id" readonly />
                        </b>

                        Global warming has become a serious threat to our planet.
                        Explain what we can do as citizens to reduce the effects of global warming. You
                        may want to consider factors, such as:
                        <ul>
                            <li>Recycling</li>
                            <li>The impact of fossil fuels (oil, gas and coal)</li>
                            <li>The impact of consumerism (buying things).</li>
                        </ul>

                    </label>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><strong>(80) Write a paragraph with no less
                                than
                                125 words talking about "Global warming":</strong></label>
                        @if ($obj->getResposeText() == null || $obj->getResposeText() == '')
                            <textarea class="form-control" rows="3" name="respuesta_text" readonly> Text not found </textarea>
                        @else
                            <textarea class="form-control" rows="3" name="respuesta_text" readonly> {{ $obj->getResposeText() }}</textarea>
                        @endif

                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><strong>Observations</strong></label>
                        @if ($obj->getResposeText() == null || $obj->getResposeText() == '')
                            <textarea class="form-control" name="observations_section8" readonly> Text not found </textarea>
                        @else
                            <textarea class="form-control" name="observations_section8"></textarea>
                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><strong>Points</strong></label>
                        <select class="form-select" name="points80" required>
                            <option value="">Select</option>
                            @if ($obj->getResposeText() == null || $obj->getResposeText() == '')

                                    <option value="0" selected>0 Points</option>

                            @else
                                @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Points</option>
                                @endfor
                            @endif

                        </select>
                    </div>

                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"></h6>
                    </div>
                    <br>
                    <h6 class="modal-title">Section 9</h6>

                    <p class="card-text d-flex justify-content-center">
                        <label for="nombre" class="form-check-label">
                            <b>
                                <center>Speaking </center>
                                <input type="hidden" value="{{ $obj->getSeccion9Id() }}" name="seccion9_id" readonly />
                            </b>


                            You have 30 seconds to prepare and 45 seconds to answer.
                            <br>

                            Read the following question and record your answer.

                        </label>
                    </p>


                    <div class="audio-container">
                        <audio controls>
                            <source src="{{ $obj->getAudio() }}" type="audio/mp3">
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                    </div>


                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><strong>Observations</strong></label>
                        @if ($obj->getAudio() == null || $obj->getAudio() == '')
                        <textarea class="form-control" name="observations_section9" readonly> Audio not found </textarea>
                        @else
                        <textarea class="form-control" name="observations_section9"></textarea>
                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><strong>Points</strong></label>
                        <select class="form-select" name="points85" required>
                            <option value="">Select</option>
                            @if ($obj->getAudio() == null || $obj->getAudio() == '')

                                    <option value="0" selected>0 Points</option>

                            @else
                                @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Points</option>
                                @endfor
                            @endif
                        </select>
                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Save changes</button>
                </div>

            </form>
        </div>

        {{--
        <form method="POST" action="#">
            @method('delete')
            @csrf
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Set Score
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  gy-5">

                <div id="seccion8">
                    <div class="card text-black mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <div class="card-text d-flex justify-content-center">
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label">
                                        SECTION 8</label>
                                </p>

                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text d-flex justify-content-center">
                                <label for="nombre" class="form-check-label">
                                    <b>
                                        <center>Writing</center>
                                    </b>

                                    Global warming has become a serious threat to our planet.
                                    Explain what we can do as citizens to reduce the effects of global warming. You
                                    may want to consider factors, such as:
                                    <ul>
                                        <li>Recycling</li>
                                        <li>The impact of fossil fuels (oil, gas and coal)</li>
                                        <li>The impact of consumerism (buying things).</li>
                                    </ul>

                                </label>

                        </div>
                    </div>


                    <div class="card text-black mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <div class="card-text d-flex justify-content-between">
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label">
                                        <div id="pregunta_seccion8"></div>
                                    </label>
                                </p>
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label" style="color: #8c8c8c"></label>
                                </p>
                            </div>
                        </div>
                        <div class="card-body">


                            <p class="card-text">

                                <center>
                                    <div id="contador">Words: <span id='number_words'></span> of 125</div>



                                    <div id="respuesta_text"></div>

                                </center>
                            </p>
                        </div>
                    </div>


                    <div class="card-header">
                        <div class="card-text d-flex justify-content-between">
                            <div class="card-title">

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="text-area" class="form-label">Observations</label>
                                    <textarea class="form-control" name="observations_section8" id="observations_section8" rows="5" cols="200"></textarea>
                                </div>
                            </div>
                            <div class="card-title"  style="margin-right: 130px" >

                                <div>
                                    <label for="points" class="form-label">Puntos</label>

                                    <!-- Point 0 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk0_points_section8" name="chk0_points_section8" value="0">
                                        <label class="form-check-label ms-2" for="chk0_points_section8">0 Puntos</label>
                                    </div>

                                    <!-- Point 1 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk1_points_section8" name="chk1_points_section8" value="1">
                                        <label class="form-check-label ms-2" for="chk1_points_section8">1 Punto</label>
                                    </div>

                                    <!-- Point 2 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk2_points_section8" name="chk2_points_section8" value="2">
                                        <label class="form-check-label ms-2" for="chk2_points_section8">2 Puntos</label>
                                    </div>

                                    <!-- Point 3 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk3_points_section8" name="chk3_points_section8" value="3">
                                        <label class="form-check-label ms-2" for="chk3_points_section8">3 Puntos</label>
                                    </div>

                                    <!-- Point 4 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk4_points_section8" name="chk4_points_section8" value="4">
                                        <label class="form-check-label ms-2" for="chk4_points_section8">4 Puntos</label>
                                    </div>

                                    <!-- Point 5 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk5_points_section8" name="chk5_points_section8" value="5">
                                        <label class="form-check-label ms-2" for="chk5_points_section8">5 Puntos</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <br>



                </div>

                <div id="seccion9">
                    <div class="card text-black mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <div class="card-text d-flex justify-content-center">
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label">
                                        SECTION 9</label>
                                </p>

                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text d-flex justify-content-center">
                                <label for="nombre" class="form-check-label">
                                    <b>
                                        <center>Speaking</center>
                                    </b>


                                    You have 30 seconds to prepare and 45 seconds to answer.
                                    <br>

                                    Read the following question and record your answer.

                                </label>

                        </div>
                    </div>


                    <div class="card text-black mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <div class="card-text d-flex justify-content-between">
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label">
                                        <div id="pregunta_seccion9"></div>
                                    </label>
                                </p>
                                <p class="card-title">
                                    <label for="nombre" class="form-check-label" style="color: #8c8c8c"></label>
                                </p>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="audio-container">
                                <audio controls>
                                    <source id="audioSource" type="audio/mp3">
                                    Tu navegador no soporta el elemento de audio.
                                </audio>
                            </div>

                        </div>
                    </div>


                    <br>


                    <div class="card-header">
                        <div class="card-text d-flex justify-content-between">
                            <div class="card-title">

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="text-area" class="form-label">Observations</label>
                                    <textarea class="form-control" name="observations_section9" id="observations_section9" rows="5" cols="200"></textarea>
                                </div>
                            </div>
                            <div class="card-title"  style="margin-right: 130px" >

                                <div>
                                    <label for="points" class="form-label">Puntos</label>

                                    <!-- Point 0 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk0_points_section9" name="chk0_points_section9" value="0">
                                        <label class="form-check-label ms-2" for="chk0_points_section9">0 Puntos</label>
                                    </div>

                                    <!-- Point 1 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk1_points_section9" name="chk1_points_section9" value="1">
                                        <label class="form-check-label ms-2" for="chk1_points_section9">1 Punto</label>
                                    </div>

                                    <!-- Point 2 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk2_points_section9" name="chk2_points_section9" value="2">
                                        <label class="form-check-label ms-2" for="chk2_points_section9">2 Puntos</label>
                                    </div>

                                    <!-- Point 3 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk3_points_section9" name="chk3_points_section9" value="3">
                                        <label class="form-check-label ms-2" for="chk3_points_section9">3 Puntos</label>
                                    </div>

                                    <!-- Point 4 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk4_points_section9" name="chk4_points_section9" value="4">
                                        <label class="form-check-label ms-2" for="chk4_points_section9">4 Puntos</label>
                                    </div>

                                    <!-- Point 5 -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="chk5_points_section9" name="chk5_points_section9" value="5">
                                        <label class="form-check-label ms-2" for="chk5_points_section9">5 Puntos</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <br>





                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-info">Aceptar</button>
            </div>
        </form> --}}
    </div>
</div>

<script>
    // function load_sections89(id) {
    //     //alert(id);
    //     $('#modalSetScore').modal('show');

    //     // alert(id);
    //     // alert(control);

    //     if (id > 0) {
    //         //var selector = "#" + control;
    //         //console.log(selector);
    //         $.get("{{ url('http://localhost/cursos/public/curso/examen/get_sections_89') }}" + '/' + id, function(
    //         //$.get("{{ url('https://cursos.coopweb.info/public/curso/examen/get_sections_89') }}" + '/' + id, function(
    //             data) {
    //             console.log('====================================');
    //             console.log(data);
    //             console.log('====================================');

    //             document.getElementById('pregunta_seccion8').innerHTML = data.pregunta_seccion8;
    //             document.getElementById('number_words').innerHTML = data.number_words;
    //             document.getElementById('respuesta_text').innerHTML = data.respuesta_text;

    //             document.getElementById('pregunta_seccion9').innerHTML = data.pregunta_seccion9;




    //             var audioUrl = data.audio_actual; // Laravel Blade syntax to pass the value to JS

    //             // Get the source element by its ID
    //             var audioSource = document.getElementById('audioSource');

    //             // Set the src attribute to the dynamically generated audio URL
    //             audioSource.src = audioUrl;

    //             // If the audio is already loaded, you can also play it directly
    //             var audioElement = document.querySelector('audio');
    //             audioElement.load(); // Reloads the audio with the new source
    //             //audioElement.play(); // Plays the audio





    //             //$(selector).html(_table);
    //         });
    //     }
    // }
</script>
