@foreach($books as $library)
<div class="modal fade" id="deleteModal{{ $library->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('library.deleteBook') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('library.destroy', 'test') }}" method="POST" novalidate>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $library->id }}" name="id">


                    {{ trans('message.AreYouSure') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('library.deleteBook') }}</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
@endforeach
