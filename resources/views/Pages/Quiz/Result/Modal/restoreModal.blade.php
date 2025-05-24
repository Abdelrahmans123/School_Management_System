<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('result.restore') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teacher.quiz.restore') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type='hidden' name='id' value='{{ $item->id }}'>
                    <input type='hidden' name='quiz_id' value='{{ $item->quiz_id }}'>
                    <input type='hidden' name='student_id' value='{{ $item->student_id }}'>
                    <h3>{{ trans('result.restore') }} {{ $item->student->name }}</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
