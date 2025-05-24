@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.SubjectList'))


@section('headerTitle', trans('sidebar.SubjectList'))

@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif





    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                {{ trans('subject.add') }}
            </button>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('subject.name') }}</th>
                        <th>{{ trans('subject.stageName') }}</th>
                        <th>{{ trans('subject.gradeName') }}</th>
                        <th>{{ trans('subject.teacherName') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stages->name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>{{ $item->teachers->name }}</td>
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
                        @include('Pages.Subject.Modals.editModel')
                        @include('Pages.Subject.Modals.deleteModel')
                    @endforeach
                </tbody>
            </table>
            @include('Pages.Subject.Modals.addModal')
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
    <script>
        let stageSelect = document.querySelectorAll('select[name="stageId"]');

        let gradeSelect = document.querySelectorAll('#grade');
        const direction1 = document.body;
        for (let i = 0; i < stageSelect.length; i++) {
            stageSelect[i].addEventListener('change', (event) => {

                let stageId = event.target.value;
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    let res = JSON.parse(this.response);
                    console.log(res)
                    for (let j = 0; j < gradeSelect.length; j++) {
                        $(gradeSelect[j]).empty();
                        for (let k = 0; k < res.length; k++) {
                            let option = document.createElement("option");
                            option.value = res[k].id;
                            let text;
                            @if (App::getLocale() == 'ar')
                                text = document.createTextNode(res[k].name.ar);
                            @else
                                text = document.createTextNode(res[k].name.en);
                            @endif
                            option.appendChild(text);
                            gradeSelect[j].appendChild(option);
                        }
                    }
                }
                xhttp.open("GET", `{{ $url }}/` + stageId);
                xhttp.send();
            })
        }
    </script>
    <script>
        let teacherSelect = document.querySelector('#teacherSelect');

        let subjectEnText = document.querySelector('#subjectEn');
        let subjectArText = document.querySelector('#subjectAr');
        const direction = document.body;
        teacherSelect.addEventListener('change', (event) => {
            console.log("🚀 ~ teacherSelect.addEventListener ~ event:", event)

            let teacherId = event.target.value;
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                let res = JSON.parse(this.response);
                console.log(res)
                $(subjectEnText).empty();
                $(subjectArText).empty();
                for (let k = 0; k < res.length; k++) {
                    let text;
                    subjectArText.value = res[k].name.ar;
                    subjectEnText.value = res[k].name.en;
                }
            }
            xhttp.open("GET", `{{ $teacherUrl }}/` + teacherId);
            xhttp.send();
        })
    </script>

@endsection
