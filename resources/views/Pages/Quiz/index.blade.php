@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.QuizList'))


@section('headerTitle', trans('sidebar.QuizList'))

@section('content')
    <!-- row -->






    <div class="card">

        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('teacher.quiz.create') }}" class="btn btn-primary">
                {{ trans('quiz.add') }}
            </a>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('quiz.quizName') }}</th>
                        <th>{{ trans('quiz.subject') }}</th>
                        <th>{{ trans('student.stageName') }}</th>
                        <th>{{ trans('student.gradeName') }}</th>
                        <th>{{ trans('student.sectionName') }}</th>
                        <th>{{ trans('quiz.teacherName') }}</th>
                        <th>{{ trans('quiz.examName') }}</th>
                        <th>{{ trans('grade.gradeOperation') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($quizzes as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->subjects->name }}</td>
                            <td>{{ $item->stages->name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>{{ $item->sections->name }}</td>
                            <td>{{ $item->teachers->name }}</td>
                            <td>{{ $item->exams->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('teacher.question.show', $item->id) }}"
                                        class="btn btn-info btn-sm me-1">
                                        <i class="fas fa-question"></i>
                                    </a>
                                    <a href="{{ route('teacher.quiz.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm me-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('teacher.quiz.result', $item->id) }}"
                                        class="btn btn-warning btn-sm me-1">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                        @include('Pages.Quiz.Modals.deleteModel')
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
