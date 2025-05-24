<!-- Modal -->
<div class="modal fade" id="retreatModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    {{ trans('promotion.retreatOne') . ' ' . $item->students->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promotion.retreat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pageId" value="2">
                    <input type="hidden" name="promotionId" value={{ $item->id }}>
                    {{ trans('message.AreYouSure') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('promotion.retreatOne') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
