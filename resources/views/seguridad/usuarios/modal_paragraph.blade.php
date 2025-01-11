<div class="modal fade" id="modal-paragraph-{{ $obj->id }}">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $obj->usuario->name ?? '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-base text-slate-900 dark:text-white leading-6">
                    <p class="lead mb-0">
                        {{$obj->getResposeText()}}
                    </p>
                </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
