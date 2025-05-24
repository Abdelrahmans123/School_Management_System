@extends('layouts.master')

@section('css')
@endsection

@section('title', trans('graduated.studentGraduated'))
@section('headerTitle', trans('graduated.studentGraduated'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('graduated.create') }}" class="btn btn-primary">
                {{ trans('graduated.add') }}
            </a>
        </div>

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
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->stages->Name }}</td>
                            <td>{{ $student->grades->name }}</td>
                            <td>{{ $student->sections->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" data-bs-toggle="modal" class="btn btn-success btn-sm me-3"
                                        data-bs-target="#returnModal{{ $student->id }}">
                                        <i class="fa-solid fa-right-left"></i>
                                    </button>
                                    <button type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm"
                                        data-bs-target="#deleteStudentModal{{ $student->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('Pages.Student.Graduated.Modal.deleteStudent')
                        @include('Pages.Student.Graduated.Modal.returnStudentModal')
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
