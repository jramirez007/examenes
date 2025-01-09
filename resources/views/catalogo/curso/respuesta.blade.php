@if ($id == 2)
    {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

        <label for="adjunto" class="form-label">Opcion 1</label>
        <input type="text" name="respuesta1" class="form-control">

    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

        <label for="adjunto" class="form-label">Opcion 2</label>
        <input type="text" name="respuesta2" class="form-control">

    </div> --}}
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="div_option"></div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
    <button class="btn btn-success btn-lg" type="button" onclick="addInput()">
        <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
    </button>
</div>
@elseif ($id == 3 || $id == 4)


<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="div_option"></div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
    <button class="btn btn-success btn-lg" type="button" onclick="addInput()">
        <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
    </button>
</div>



@endif
