@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('result.ResultList'))


@section('headerTitle', trans('result.ResultList'))

@section('content')
    <!-- row -->






    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('student.studentName') }}</th>
                        <th>{{ trans('question.score') }}</th>
                        <th>{{ trans('quiz.quizName') }}</th>
                        <th>{{ trans('result.abuse') }}</th>
                        <th>{{ trans('student.date') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($degrees as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item->score }}</td>
                            <td>{{ $item->quiz->name }}</td>
                            <td>
                                @if ($item->abuse == '1')
                                    <span class="badge bg-danger">
                                        {{ trans('result.abuse') }}
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        {{ trans('result.notAbuse') }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $item->date }}</td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $item->id }}">
                                    <i class="fa-solid fa-arrow-rotate-left"></i>
                                </button>

                            </td>
                        </tr>
                        @include('Pages.Quiz.Result.Modal.restoreModal')
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
