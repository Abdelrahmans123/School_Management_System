@extends('layouts.master')
@section('css')
    <style>
        #datatable_wrapper {
            display: flex;
            flex-direction: column;
        }

        #datatable_wrapper .dataTables_wrapper {
            flex: 1;
        }
    </style>
@endsection
@section('title', trans('student.studentInfo'))


@section('headerTitle', trans('student.studentInfo'))

@section('content')

    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('student.index') }}" class="btn btn-primary">{{ trans('student.back') }}</a>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">{{ trans('student.studentInfo') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">{{ trans('student.studentAttachment') }} </button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div id="datatable_wrapper">
                        <table id="datatable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('student.studentName') }}</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ trans('student.email') }}</th>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('student.birthDate') }}</th>
                                    <td>{{ $student->birthDate }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('student.academicYear') }}</th>
                                    <td>{{ $student->academicYear }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('student.gender') }}</th>
                                    <td>{{ $student->genders->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('student.nationality') }}</th>
                                    <td>{{ $student->nationality->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('student.bloodType') }}</th>
                                    <td>{{ $student->bloodType->type }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('parent.fatherName') }}</th>
                                    <td>{{ $student->parents->fatherName }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('parent.motherName') }}</th>
                                    <td>{{ $student->parents->motherName }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <form action="{{ route('uploadAttachment') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="studentId" value="{{ $student->id }}">
                        <input type="hidden" name="studentName" value="{{ $student->name }}">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Attachments</label>
                            <input type="file" class="form-control" aria-label="file example" name="images[]"
                                accept="image/*" multiple required>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-outline-success mb-3">
                    </form>
                    <table id="example" class="display " style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('student.fileName') }}</th>
                                <th>{{ trans('student.createdAt') }}</th>
                                <th>{{ trans('student.operation') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->images as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->url }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('downloadAttachment', ['studentName' => $item->imageable->name, 'fileName' => $item->url]) }}"
                                                class="btn btn-info btn-sm me-2">
                                                <i class="fa-solid fa-download"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                                @include('Pages.Student.Modal.deleteAttachmentModal')
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

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
            $('#datatable').DataTable({
                "language": lang,
                dom: 'ftip',
                retrieve: true,
                autoWidth: false,
                info: true,
                paging: false,
                scrollY: false,
                scrollX: true,
                scrollCollapse: false,
                fixedHeader: true,
                fixedColumns: {
                    leftColumns: 1
                },
            });
        });
    </script>

@endsection
