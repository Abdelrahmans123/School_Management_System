@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.QuestionList'))


@section('headerTitle', trans('sidebar.QuestionList') . ' ' . 'For Quiz: ' . $quiz->name)

@section('content')
    <!-- row -->






    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('teacher.question.customCreate', $quiz->id) }}" class="btn btn-primary">
                {{ trans('question.add') }}
            </a>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('question.questionTitle') }}</th>
                        <th>{{ trans('question.answers') }}</th>
                        <th>{{ trans('question.rightAnswer') }}</th>
                        <th>{{ trans('question.score') }}</th>
                        <th>{{ trans('grade.gradeOperation') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($questions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->answers }}</td>
                            <td>{{ $item->right_answer }}</td>
                            <td>{{ $item->score }}</td>
                            <td>
                                <a href="{{ route('teacher.question.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Pages.Question.Modals.deleteModel')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>




    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
        });
    </script>

@endsection
