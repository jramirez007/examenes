@extends('menu_examen')
@section('contenido')
    <!-- Start:: row-1 -->
    <div class="row">
        <form method="POST" id="formExamen" action="{{ url('curso/examen/section_final') }}">
            @csrf
            <input type="hidden" value="8" name="section">
            <div class="col-xl-12">

                <div class="card custom-card">
                    <div class="card-header justify-content-between align-items-center">
                        <div class="card-title">Speaking</div>
                        <div class="btn-list">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2 mb-4 align-items-center justify-content-center text-center">
                            <h6 class="fw-medium mb-0">
                                You have 20 seconds to prepare and 45 seconds to answer.<br>
                                Read the following question and record your answer.
                            </h6>
                        </div>
                    </div>

                    <div class="card-header justify-content-between align-items-center">
                        <div class="card-title">{{ $pregunta->descripcion }}</div>

                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2 mb-4 align-items-center justify-content-center text-center">
                            <h6 class="fw-medium mb-0">
                                When you press this button a microphone will be enabled so you can talk for 45 seconds
                            </h6>
                            <input type="hidden" name="audioData" id="audioData">
                            <br>
                            <button type="button" id="startButton" class="btn btn-info">&nbsp;&nbsp;Start speaking
                                test&nbsp;&nbsp;
                            </button>

                            <button type="button" id="stopButton" style="display: none"
                                class="btn btn-danger">&nbsp;&nbsp;Stop speaking
                                test&nbsp;&nbsp;
                            </button>
                            <br>
                            <div id="divPreview" style="display: none">
                                <audio id="audioPreview" controls></audio>
                            </div>

                            <div id="alertDanger" class="alert alert-danger" style="display: none;">
                                Por favor, grabe el audio antes de continuar.
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ url('curso/examen/section/8') }}"> <button type="button"
                        class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Preview&nbsp;&nbsp;</button></a>
                <button type="button" class="btn btn-primary btn-lg btn-wave"
                    onclick="validarFormulario()">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
            </div>

            <br>
        </form>

    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>


    <script>
        let mediaRecorder;
        let audioChunks = [];

        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const audioPreview = document.getElementById('audioPreview');
        const divPreview = document.getElementById('divPreview'); // Seleccionar el div
        const audioDataInput = document.getElementById('audioData');
        // const submitButton = document.getElementById('submitButton');

        startButton.addEventListener('click', async () => {
            if (startButton) {
                startButton.style.display = 'none';
            }

            if (stopButton) {
                stopButton.style.display = 'block';
            }

            // Solicitar permiso para usar el micrófono
            const stream = await navigator.mediaDevices.getUserMedia({
                audio: true
            });

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
                    audioDataInput.value = reader.result; // Guardar Base64 en el campo oculto
                    // submitButton.disabled = false; // Habilitar el botón de envío
                };
                reader.readAsDataURL(audioBlob);
            };

            // Iniciar la grabación
            mediaRecorder.start();
            startButton.disabled = true;
            stopButton.disabled = false;
        });

        stopButton.addEventListener('click', () => {
            // Detener la grabación
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;

            if (startButton) {
                startButton.style.display = 'block';
            }

            if (stopButton) {
                stopButton.style.display = 'none';
            }
        });



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
