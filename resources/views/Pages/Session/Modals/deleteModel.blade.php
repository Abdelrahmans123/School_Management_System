<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('session.deleteSession') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if(auth()->guard('admin')->check())
                <form action="{{ route('sessions.destroy', 'test') }}" method="POST" novalidate>
                @elseif(auth()->guard('teacher')->check())
                <form action="{{ route('teacher.sessions.destroy', 'test') }}" method="POST" novalidate>
                @endif
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $item->id }}" name="session_id">
                    <input type="hidden" value="{{ $item->meeting_id }}" name="meeting_id">
                    {{ trans('message.AreYouSure') }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('session.deleteSession') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
