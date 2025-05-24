<!-- Modal -->
<div class="modal fade" id="deleteStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('graduated.deleteStudentInfo') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('graduated.destroy', ['graduated' => $student->id]) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $student->id }}" name="id">
                    {{ trans('message.AreYouSure') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('graduated.deleteStudent') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
