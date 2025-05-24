<div class="modal fade" id="deleteModal{{$guardian->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('stage.deleteStage')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                    {{trans('stage.AreYouSure')}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('stage.close')}}</button>
                        <button type="submit" wire:click='delete({{ $guardian->id }})' class="btn btn-danger">{{trans('stage.deleteStage')}}</button>
                    </div>

            </div>


        </div>
    </div>
</div>
