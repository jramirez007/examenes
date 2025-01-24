@extends('menu_examen')
@section('contenido')
    <!-- Start:: row-1 -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">

        <h1 class="page-title fw-medium fs-18 mb-0">SECTION 9
        </h1>

    </div>
    <div class="row">
        <form method="POST" id="formExamen" action="{{ url('curso/examen/section_final') }}">
            @csrf
            <input type="hidden" value="8" name="section">
            <div class="col-xl-12">

                <div class="card custom-card">
                    <div class="card-header justify-content-between"
                        style="background-color:  #12498F !important; color: white  !important;">
                        <div class="card-title">
                            <h5 class="mb-3" style="color: inherit !important;">
                                Speaking
                            </h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column gap-2 mb-4 align-items-center justify-content-center text-center">
                            <h6 class="fw-medium mb-0">
                                <b>Speaking section.</b>
                                <br><br>
                                You have 30 seconds to prepare and 45 seconds to answer.<br>
                                Read the following question and record your answer.
                            </h6>
                        </div>



                        <div class="d-flex align-items-center">
                            <!-- Círculo azul con el id a la izquierda -->
                            <div class="circle-container">
                                <span class="circle-text">
                                    {{ $pregunta->id }}
                                </span>
                            </div>

                            <!-- Título de la pregunta, centrado verticalmente con el círculo -->
                            <div class="card-title ml-2">
                                <h5 class="mb-0">
                                    {{ $pregunta->descripcion }}
                                </h5>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div
                                class="d-flex flex-column gap-2 mb-4 align-items-center justify-content-center text-center">
                                <h6 class="fw-medium mb-0">
                                    When you press this button a microphone will be enabled so you can talk for 45 seconds
                                </h6>
                                <input type="hidden" name="audioData" id="audioData">
                                <br>
                                <button type="button" id="startButton" class="btn btn-info">&nbsp;&nbsp;Start speaking
                                    &nbsp;&nbsp;
                                </button>

                                <button type="button" id="stopButton" style="display: none"
                                    class="btn btn-danger">&nbsp;&nbsp;Stop speaking
                                    &nbsp;&nbsp;
                                </button>
                                <br>
                                <div id="div_speaking_animate" class="d-flex justify-content-center mb-3">
                                    <center>
                                        <div id="chronometer2">
                                            <table width="100%">
                                                <tr>
                                                    <td align="center">Remaining time</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">45</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <br />
                                        <div id="microphone" style="display: none">
                                            <img src="{{ asset('assets/audio/speaking_animate.gif') }}" alt="">

                                        </div>
                                    </center>
                                </div>

                                <br>
                                <div id="divPreview" style="display: none">
                                    <audio id="audioPreview" controls></audio>
                                </div>

                                <div id="alertDanger" class="alert alert-danger" style="display: none;">
                                    Please record the audio before continuing.
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div align='center' id="div_instrucctions" style="display: none">
                    <button type="button" id="stopButton" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    class="btn btn-danger">&nbsp;&nbsp;If you denied microphone permission by error, click here
                    &nbsp;&nbsp;
                </button>
                </div>


                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ url('curso/examen/section/8') }}"> <button type="button"
                            class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Preview&nbsp;&nbsp;</button></a>
                    <button type="button" class="btn btn-success btn-lg btn-wave"
                        onclick="validarFormulario()">&nbsp;&nbsp;Submit&nbsp;&nbsp;</button>
                </div>

                <br>
        </form>

    </div>



    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h4>

                            <b>
                                Instructions to enable the microphone again
                            </b>
                        </h4>

                        <br>
                        <br>

                        <p>
                            <h5><b>Step 1</b></h5>
                            <br>
                            Click on the figure of the microphone enclosed in the red box as shown below.

                        </p>

                        <img src="{{ asset('assets/audio/instructions0.png') }}" alt="">

                        <p>
                            <h5><b>Step 2</b></h5>
                            <br>
                            Then click on reset permission as shown below.


                        </p>


                        <img src="{{ asset('assets/audio/instructions.png') }}" alt="">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Aceptar</button>

                    </div>
                </div>

        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>


    <script>
        let timer2;
        let minutes2 = 0;
        let seconds2 = 45;
        let isRunning2 = false;

        let mediaRecorder;
        let audioChunks = [];

        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const audioPreview = document.getElementById('audioPreview');
        const divPreview = document.getElementById('divPreview'); // Seleccionar el div
        const audioDataInput = document.getElementById('audioData');
        const instructions = document.getElementById('div_instrucctions');
        // const submitButton = document.getElementById('submitButton');

        startButton.addEventListener('click', async () => {
            // if (startButton) {
            //     //startButton.style.display = 'none';
            //     startButton.style.display = 'none';
            //     microphone.style.display = 'block';

            //     seconds2 = 45;
            //     startStopTimer2();
            // }

            // if (stopButton) {
            //     stopButton.style.display = 'block';
            // }

            // Solicitar permiso para usar el micrófono
            // const stream = await navigator.mediaDevices.getUserMedia({
            //     audio: true
            // });




            navigator.mediaDevices.getUserMedia({
                    audio: true
                })
                .then(stream => {
                    console.log('Acceso al micrófono concedido');
                    // Aquí puedes enviar datos al servidor con fetch() o WebSockets

                    //startButton.style.display = 'none';
                    startButton.style.display = 'none';
                    stopButton.style.display = 'block';
                    microphone.style.display = 'block';

                    seconds2 = 45;
                    startStopTimer2();

                    // Crear el MediaRecorder
                    mediaRecorder = new MediaRecorder(stream);

                    // Manejar los datos de audio grabados
                    mediaRecorder.ondataavailable = (event) => {
                        audioChunks.push(event.data);
                    };

                    // Manejar el fin de la grabación
                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, {
                            type: 'audio/webm'
                        });
                        audioChunks = [];

                        // Crear una URL para previsualizar el audio grabado
                        const audioURL = URL.createObjectURL(audioBlob);
                        audioPreview.src = audioURL;

                        // Hacer visible el div solo si hay audio para reproducir
                        if (audioURL) {
                            divPreview.style.display = 'block';
                        }

                        // Convertir el Blob a Base64 para enviarlo en el formulario
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            audioDataInput.value = reader
                                .result; // Guardar Base64 en el campo oculto
                            // submitButton.disabled = false; // Habilitar el botón de envío
                        };
                        reader.readAsDataURL(audioBlob);
                    };

                    // Iniciar la grabación
                    mediaRecorder.start();
                    startButton.disabled = true;
                    stopButton.disabled = false;


                })
                .catch(error => {
                    //console.error('Acceso al micrófono denegado o error:', error);
                    //alert('Acceso al micrófono denegado o error:' + error);
                    instructions.style.display = 'block';
                });





        });

        stopButton.addEventListener('click', () => {
            // Detener la grabación
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;

            document.getElementById("microphone").style.display =
                "none";

            document.getElementById(
                    "chronometer2"
                ).innerHTML =
                `<table width='100%'><tr><td align="center">Remaining Time</td></tr><tr><td align="center">00</td></tr></table>`;

            seconds2 = 1;


            if (startButton) {
                startButton.style.display = 'block';
            }

            if (stopButton) {
                stopButton.style.display = 'none';
            }
        });


        // Function to start/stop the timer
        function startStopTimer2() {
            // console.log('isRunning2='+isRunning2);
            // console.log('seconds2='+seconds2);

            if (isRunning2) {
                clearInterval(timer2);
                //document.getElementById('startStopButton').textContent = 'Start';
            } else {
                timer2 = setInterval(() => {
                    console.log("isRunning2=" + isRunning2);
                    console.log("seconds2=" + seconds2);
                    seconds2--;
                    if (seconds2 == 0 - 1 || seconds2 == "0-1") {
                        //alert('detener');
                        //seconds2 = '00'; // Ensure seconds2 stays at '00'
                        // document.getElementById('chronometer2').value =
                        //     'Por favor subir el archivo generado en downloads llamado recorded_audio.wav';

                        // Stop the interval and set the timer state to false
                        clearInterval(timer2);
                        isRunning2 = false;

                        stopButton.click();
                    } else {
                        //alert('dos');
                        updateChronometer2();
                    }
                }, 1000);

                //document.getElementById('startStopButton').textContent = 'Stop';
            }
            //isRunning2 = !isRunning2;
        }


        // Function to update the chronometer display
        function updateChronometer2() {
            // Format minutes and seconds to be always two digits
            const formattedMinutes2 =
                minutes2 < 10 ? "0" + minutes2 : minutes2;
            const formattedSeconds2 =
                seconds2 < 10 ? "0" + seconds2 : seconds2;
            //document.getElementById('chronometer').textContent = `Remaining Time: ${formattedMinutes}:${formattedSeconds}`;

            document.getElementById(
                    "chronometer2"
                ).innerHTML =
                `<table width='100%'><tr><td align="center">Remaining Time</td></tr><tr><td align="center">${formattedSeconds2}</td></tr></table>`;
        }


        function validarFormulario() {
            const audioData = document.getElementById('audioData');
            const alertDanger = document.getElementById('alertDanger');
            const formExamen = document.getElementById('formExamen');

            // Validar si el campo oculto está vacío
            if (!audioData.value.trim()) {
                // Mostrar alerta de peligro con mensaje en español
                alertDanger.style.display = 'block';

                // Asegurarse de que la alerta desaparezca después de unos segundos (opcional)
                setTimeout(() => {
                    alertDanger.style.display = 'none';
                }, 5000); // Ocultar después de 5 segundos

                return false; // Detener el flujo
            }

            // Si el campo tiene datos, ocultar el mensaje de error y hacer submit
            alertDanger.style.display = 'none';

            // Enviar el formulario
            formExamen.submit();
        }
    </script>
@endsection
