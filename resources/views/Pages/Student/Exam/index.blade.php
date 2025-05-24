@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.ExamList'))


@section('headerTitle', trans('sidebar.ExamList'))

@section('content')
    <!-- row -->






    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('quiz.quizName') }}</th>
                        <th>{{ trans('quiz.subject') }}</th>
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
                            <td>{{ $item->teachers->name }}</td>
                            <td>{{ $item->exams->name }}</td>
                            <td>
                                @if ($item->degree->count() > 0 && $item->degree->first()->score !== null)
                                    <span
                                        class="badge rounded-pill text-bg-success">{{ $item->degree->first()->score }}</span>
                                @else
                                    <a href="{{ route('student.exam.show', $item->id) }}"
                                        class="btn btn-outline-success btn-sm" onclick="alertAbuse()">
                                        <i class="fa-solid fa-door-open"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
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
    <script>
        const alertAbuse = () => {
            alert('Do not refresh the page or click back button');
        }
    </script>
@endsection
