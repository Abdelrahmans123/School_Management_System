@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.studentList'))


@section('headerTitle', trans('sidebar.studentList'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif




    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('student.studentName') }}</th>
                        <th>{{ trans('student.stageName') }}</th>
                        <th>{{ trans('student.gradeName') }}</th>
                        <th>{{ trans('student.sectionName') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stages->name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>{{ $item->sections->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ trans('student.operation') }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('parent.student.results', $item->id) }}">{{ trans('result.ResultList') }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
