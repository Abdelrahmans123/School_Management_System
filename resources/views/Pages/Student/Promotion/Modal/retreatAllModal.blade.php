<div class="modal fade" id="retreatAllModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('promotion.Retreat') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form action="{{ route('promotion.retreat') }}" method="POST">
					@csrf
					<input type="hidden" name="pageId" value="1">
                {{ trans('message.AreYouSure') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('promotion.Retreat') }}</button>
            </div>
			</form>
        </div>
    </div>
</div>
