<div class="modal fade" id="modal-paragraph-{{ $obj->id }}">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student name: <b>{{$obj->name}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <h5><b>Section 8 </b><br>
                (80) Write a paragraph with no less than 125 words talking about "Global warming".</h5>
                <h6 class="text-base text-slate-900 dark:text-white leading-6">
                    <p class="lead mb-0">
                        {{$obj->paragraph_section8}}
                    </p>
                </h6>
                <h6 class="text-base text-slate-900 dark:text-white leading-6">
                    <p class="lead mb-0">
                        <label for="">select score</label>
                        <select name="" id="">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>

                        </select>
                    </p>
                </h6>
                <br>
                <h5><b>Section 9</b> <br>
                    (85) What activity would you do if you had unlimited money?</h5>
                <h6 class="text-base text-slate-900 dark:text-white leading-6">
                    <p class="lead mb-0">
                        <audio controls>
                            <source src="{{ $obj->audio_section9 }}" type="audio/mp3">
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                    </p>
                </h6>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
