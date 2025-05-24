@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('library.add'))


@section('headerTitle', trans('library.add'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('library.store') }}" method="POST" autocomplete="off" class="needs-validation"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="nameEnInput">{{ trans('library.bookName') }}</label>
                            <input type="text" class="form-control" name="book_name" id="nameEnInput" required>
                            @error('book_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6  mt-2 has-validation">
                            <label for="parentInput">{{ trans('quiz.teacherName') }}</label>
                            <select name="teacher_id" class="form-select" id="parentInput" required>
                                <option selected disabled value="">{{ trans('quiz.chooseTeacher') }}</option>
                                @foreach ($teachers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-2 has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="stage_id" class="form-select" id="stageInput" required>
                                <option selected disabled value="">{{ trans('student.chooseStage') }}</option>
                                @foreach ($stages as $item)
                                    <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                @endforeach
                            </select>
                            @error('stage_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-2  has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="grade_id" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGrade') }}</option>
                            </select>
                            @error('grade_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-2  has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="section_id" class="form-select" id="sectionInput" required>
                                <option selected disabled value="">{{ trans('student.chooseSection') }}</option>
                            </select>
                            @error('section_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-2  has-validation">
                            <div class="col mt-2  has-validation">
                                <label for="fileNameInput">{{ trans('student.fileName') }}</label>
                                <input type="file" class="form-control" name="file_name" id="fileNameInput" required>
                                @error('file_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mt-5">
                                <input type="submit" class="btn btn-primary" value="{{ trans('message.submit') }}">
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>


    <!-- row closed -->
@endsection
@section('js')
    <script>
        let stageSelect = document.querySelectorAll('select[name="stage_id"]');

        let gradeSelect = document.querySelectorAll('select[name="grade_id"]');
        const direction = document.body;
        for (let i = 0; i < stageSelect.length; i++) {
            stageSelect[i].addEventListener('change', (event) => {
                let stageId = event.target.value;
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    let res = JSON.parse(this.response);
                    console.log(res)
                    for (let j = 0; j < gradeSelect.length; j++) {
                        $(gradeSelect[j]).empty();
                        $(gradeSelect[j]).append(
                            `<option selected disabled>{{ trans('student.chooseGrade') }}</option>`);
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
        let sectionSelect = document.querySelectorAll('select[name="section_id"]');

        let gradesSelect = document.querySelectorAll('select[name="grade_id"]');
        for (let i = 0; i < gradesSelect.length; i++) {
            gradesSelect[i].addEventListener('change', (event) => {

                let gradeId = event.target.value;
                console.log(gradeId)
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    let res = JSON.parse(this.response);
                    console.log(res)
                    for (let j = 0; j < sectionSelect.length; j++) {
                        $(sectionSelect[j]).empty();
                        $(sectionSelect[j]).append(
                            `<option selected disabled>{{ trans('student.chooseSection') }}</option>`);
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
                            sectionSelect[j].appendChild(option);
                        }
                    }
                }
                xhttp.open("GET", `{{ $sectionUrl }}/` + gradeId);
                xhttp.send();
            })
        }
    </script>
    <script>
        const form = document.querySelector('.needs-validation')
        let text = document.querySelector('.invalid-feedback');
        if (text) {
            form.classList.add('was-validated')
        } else {
            form.classList.remove('was-validated')
        }
    </script>
@endsection
