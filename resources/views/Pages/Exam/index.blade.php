@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.ExamList'))


@section('headerTitle', trans('sidebar.ExamList'))

@section('content')
    <!-- row -->
    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                {{ trans('exam.add') }}
            </button>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('exam.name') }}</th>
                        <th>{{ trans('exam.term') }}</th>
                        <th>{{ trans('exam.academicYear') }}</th>
                        <th>{{ trans('stage.stageOperation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->term }}</td>
                            <td>{{ $item->academicYear }}</td>
                            <td>
                                <a href="{{ route('teacher.quiz.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-question-circle"></i>
                                </a>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Pages.Exam.Modals.editModel')
                        @include('Pages.Exam.Modals.deleteModel')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('Pages.Exam.Modals.addModel')

    <!-- row closed -->
@endsection
@section('js')
    {{-- /**
     * Initializes a DataTable with the provided translations.
     *
     * This script is responsible for setting up a DataTable instance on the element with the ID 'example'. It retrieves the translations from the `$translations` variable and applies them to the DataTable configuration.
     *
     * @param {Object} lang - An object containing the translations for the DataTable.
     */ --}}
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
        });
    </script>
    {{-- /**
     * This script handles the validation and submission of the form in the 'addModal' modal.
     * It first selects the form element and the invalid feedback element.
     * It then creates a new Bootstrap modal instance for the 'addModal' and gets a reference to the close button.
     *
     * If the invalid feedback element is present, it shows the modal and adds the 'was-validated' class to the form.
     * If the invalid feedback element is not present, it removes the 'was-validated' class from the form.
     *
     * The close button event listener is added to hide the modal when clicked.
     */ --}}
    <script>
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const form = document.querySelector('#addModal .needs-validation')
        let text = document.querySelector('.invalid-feedback');
        const myModal = new bootstrap.Modal(document.getElementById('addModal'));
        const closeBtn = document.getElementById('closeBtn');
        // Loop over them and prevent submission


        if (text) {
            console.log(form)
            myModal.show();
            form.classList.add('was-validated')
        } else {
            form.classList.remove('was-validated')
        }
        closeBtn.addEventListener('click', function() {
            // Close the modal
            myModal.hide();
        });
    </script>
@endsection
