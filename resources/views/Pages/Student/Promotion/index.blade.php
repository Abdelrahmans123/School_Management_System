@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.studentPromotion'))


@section('headerTitle', trans('sidebar.studentPromotion'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif




    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('promotion.create') }}" class="btn btn-primary">
                {{ trans('promotion.promote') }}
            </a>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#retreatAllModal">
                {{ trans('promotion.Retreat') }}
            </button>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('promotion.studentName') }}</th>
                        <th>{{ trans('promotion.fromStageName') }}</th>
                        <th>{{ trans('promotion.fromGradeName') }}</th>
                        <th>{{ trans('promotion.fromSectionName') }}</th>
                        <th>{{ trans('promotion.oldAcademicYear') }}</th>
                        <th>{{ trans('promotion.toStageName') }}</th>
                        <th>{{ trans('promotion.toGradeName') }}</th>
                        <th>{{ trans('promotion.toSectionName') }}</th>
                        <th>{{ trans('student.academicYear') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->students->name }}</td>
                            <td>{{ $item->fromStages->Name }}</td>
                            <td>{{ $item->fromGrades->name }}</td>
                            <td>{{ $item->fromSections->name }}</td>
                            <td>{{ $item->oldAcademicYear }}</td>
                            <td>{{ $item->toStages->Name }}</td>
                            <td>{{ $item->toGrades->name }}</td>
                            <td>{{ $item->toSections->name }}</td>
                            <td>{{ $item->academicYear }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-info me-1" data-bs-toggle="modal" title='retreat'
                                        data-bs-target="#retreatModal{{ $item->id }}">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                    <button type="button" class="btn btn-success " data-bs-toggle="modal" title='graduate'
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('Pages.Student.Promotion.Modal.retreatModal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('Pages.Student.Promotion.Modal.retreatAllModal')
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
