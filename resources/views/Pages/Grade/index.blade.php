@extends('layouts.master')
@section('css')
    <style>
        .modal {
            --bs-modal-width: 828px;
        }
    </style>
@endsection
@section('title', trans('sidebar.GradeList'))


@section('headerTitle', trans('sidebar.GradeList'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif




    <div class="card">
        <div class="container mt-3">
            <div class="row">
                <div class="col-4">
                    <button type="button" class="btn btn-primary" id="addBtn" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        {{ trans('grade.add') }}
                    </button>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger" id="deleteAll">
                        {{ trans('grade.checkboxSelected') }}
                    </button>
                    @include('Pages.Grade.Modals.deleteAll')
                </div>
                <div class="col-4">
                    <form action="{{ route('filterGrade') }}" method="POST">
                        @csrf
                        <select class="js-example-placeholder-single" name="stageId" style="width: 60%"
                            onchange="this.form.submit()">
                            <option selected disabled> {{ trans('grade.searchStage') }}</option>
                            <option value="0">{{ trans('grade.all') }}</option>
                            @foreach ($stage as $item)
                                <option value="{{ $item->id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>

                    </form>
                </div>
            </div>
        </div>


        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center"><input type="checkbox" name="selectAll" id="selectAll"
                                onclick="checkAll('box1',this)"></th>
                        <th>#</th>
                        <th>{{ trans('grade.gradeName') }}</th>
                        <th>{{ trans('grade.stageName') }}</th>
                        <th>{{ trans('grade.gradeOperation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (isset($details)) {
                            $grades = $details;
                        } else {
                            $grades = $grade;
                        }
                    @endphp
                    @foreach ($grades as $item)
                        <tr>
                            <td style="text-align: center"><input type="checkbox" value="{{ $item->id }}"
                                    class="box1"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stage->Name }}</td>
                            <td>
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
                        @include('Pages.Grade.Modals.editModel')
                        @include('Pages.Grade.Modals.deleteModel')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('Pages.Grade.Modals.addModel')



    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });

            $(".js-example-placeholder-single").select2();
        });
    </script>

    <script>
        function validationModal(form, text, myModal, closeBtn) {
            if (text) {
                myModal.show();
                form.classList.add('was-validated')
            } else {
                form.classList.remove('was-validated')
            }
            closeBtn.addEventListener('click', function() {
                // Close the modal
                myModal.hide();
            });
        }

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const addForm = document.querySelector('#addModal .needs-validation')
        let addFormTxt = document.querySelector('#addModal .invalid-feedback');
        const addModal = new bootstrap.Modal(document.getElementById('addModal'));
        const closeBtn = document.getElementById('closeBtn');
        // Loop over them and prevent submission
        validationModal(addForm, addFormTxt, addModal, closeBtn);
    </script>
    <script>
        function checkAll(className, mainCheckbox) {
            let checkbox = document.getElementsByClassName(className);
            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = mainCheckbox.checked === true;

            }
        }
    </script>
    <script>
        let deleteAllBtn = document.getElementById('deleteAll');
        let selected = [];

        const deleteAllModal = new bootstrap.Modal(document.getElementById('deleteAllModal'));
        let DeletecloseBtn = document.getElementById("DeletecloseBtn")
        deleteAllBtn.addEventListener("click", () => {
            let gradeInput = document.getElementById("gradeId");
            let checkbox = document.querySelectorAll("table input[type=checkbox]:checked");

            for (let i = 0; i < checkbox.length; i++) {
                console.log(selected)
                selected.push(checkbox[i].value);
            }
            if (selected.length > 0) {
                console.log(gradeInput)
                deleteAllModal.show();
                gradeInput.value = selected
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: '{{ trans('grade.mustChoose') }}',
                    icon: 'error',
                    confirmButtonText: '{{ trans('grade.ok') }}',
                    showClass: {
                        popup: `
      animate__animated
      animate__fadeInUp
      animate__faster
    `
                    },
                    hideClass: {
                        popup: `
      animate__animated
      animate__fadeOutDown
      animate__faster
    `
                    }
                })
            }
        })
        DeletecloseBtn.addEventListener('click', function() {
            // Close the modal
            deleteAllModal.hide();
        });
    </script>
@endsection
