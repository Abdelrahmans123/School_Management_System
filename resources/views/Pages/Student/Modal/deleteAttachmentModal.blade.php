<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('student.deleteAttachment') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('deleteAttachment', 'test') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id }}" name="id">
                    <input type="hidden" value="{{ $item->imageable->name }}" name="studentName">
                    <input type="hidden" value="{{ $item->imageable->id }}" name="studentId">
                    <input  type="hidden" name="fileName" value="{{ $item->url }}"
                        >
                    <h2>{{ trans('message.AreYouSure') }}</h2>
                    {{-- <input type="text" readonly value="{{ $item->url}}" name="fileName"> --}}
                    <input class="form-control" type="text" name="fileName" value="{{ $item->url }}" disabled
                        >
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('student.deleteAttachment') }}</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
