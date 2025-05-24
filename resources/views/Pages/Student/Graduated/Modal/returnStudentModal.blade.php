<!-- Modal -->
<div class="modal fade" id="returnModal{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('graduated.returnStudent') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('graduated.update', 'test') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $student->id }}" name="id">


                    {{ trans('message.AreYouSure') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="closeBtn">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('message.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
