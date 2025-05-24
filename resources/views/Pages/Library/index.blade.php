@extends('layouts.master')

@section('css')
@endsection

@section('title', trans('sidebar.LibraryList'))

@section('headerTitle', trans('sidebar.LibraryList'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('library.create') }}" class="btn btn-primary">
                {{ trans('library.add') }}
            </a>
        </div>

        <div class="card-body">
            <table id="library-table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('library.bookName') }}</th>
                        <th>{{ trans('student.stageName') }}</th>
                        <th>{{ trans('student.gradeName') }}</th>
                        <th>{{ trans('student.sectionName') }}</th>
                        <th>{{ trans('teacher.teacherName') }}</th>
                        <th>{{ trans('grade.gradeOperation') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- row closed -->
	@include('Pages.Library.Modals.deleteModal')
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {
            $('#library-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('libraries.list') }}", // Replace with your actual route to fetch data
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'book_name',
                        name: 'name'
                    },
                    {
                        data: 'stage_name',
                        name: 'stages.Name'
                    }, // Referencing stages relation
                    {
                        data: 'grade_name',
                        name: 'grades.name'
                    }, // Referencing grades relation
                    {
                        data: 'section_name',
                        name: 'sections.name'
                    }, // Referencing sections relation
                    {
                        data: 'teacher_name',
                        name: 'teachers.name'
                    }, // Referencing teachers relation
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            // Escaping the Blade route inside the JS template literal
                            let downloadUrl = "{{ route('libraries.download', ':file_name') }}";
                            downloadUrl = downloadUrl.replace(':file_name', row.file_name);
                            let editUrl = "{{ route('library.edit', ':id') }}";
                            editUrl = editUrl.replace(':id', row.id);
                            return `
                            <a href="${downloadUrl}" class="btn btn-info btn-sm">
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <a href="${editUrl}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal${row.id}">
                                <i class="fa-solid fa-trash"></i>
                            </button>`;
                        }
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                responsive: true,
                language: {!! json_encode($translations) !!} // Assuming $translations is passed from the controller
            });
        });
    </script>

@endsection
