@extends('layouts.master')
@section('css')
    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', trans('student.add'))


@section('headerTitle', trans('student.add'))

@section('content')
    <!-- row -->

    <div class="card">
        <div class="card-body">
            <div class="container">
                <h4 class="text-primary m-2">{{ trans('student.personalInfo') }}</h4>
                <form action="{{ route('student.store') }}" method="POST" autocomplete="off" class="needs-validation" enctype="multipart/form-data"
                    id="dropzone" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="emailInput">{{ trans('student.email') }}</label>
                            <input type="email" class="form-control" name="email" id="emailInput" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="passwordInput">{{ trans('teacher.password') }}</label>
                            <input type="password" class="form-control" name="password" id="passwordInput" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="nameEnInput">{{ trans('student.nameEn') }}</label>
                            <input type="text" class="form-control" name="nameEn" id="nameEnInput" required>
                            @error('nameEn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="nameArInput">{{ trans('student.nameAr') }}</label>
                            <input type="text" class="form-control" name="nameAr" id="nameArInput" required>
                            @error('nameAr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="gendersIdInput">{{ trans('student.gender') }}</label>
                            <select name="gendersId" class="form-select" id="gendersIdInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGender') }}</option>
                                @foreach ($data['genders'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('gendersId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="nationalityIdInput">{{ trans('student.nationality') }}</label>
                            <select name="nationalityId" class="form-select" id="nationalityIdInput" required>
                                <option selected disabled value="">{{ trans('student.chooseNationalities') }}</option>
                                @foreach ($data['nationalities'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('nationalityId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="bloodTypeIdInput">{{ trans('student.bloodType') }}</label>
                            <select name="bloodTypeId" class="form-select" id="bloodTypeIdInput" required>
                                <option selected disabled value="">{{ trans('student.chooseBlood') }}</option>
                                @foreach ($data['bloodTypes'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                            @error('bloodTypeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="birthDateInput">{{ trans('student.birthDate') }}</label>
                            <input type="text" class="form-control" name="birthDate" id="birthDateInput" required>
                            @error('birthDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h4 class="text-primary mt-5">{{ trans('student.studentInfo') }}</h4>
                        <div class="col-lg-2  has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="stageId" class="form-select" id="stageInput" required>
                                <option selected disabled value="">{{ trans('student.chooseStage') }}</option>
                                @foreach ($data['stages'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('stageId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-2   has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="gradeId" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGrade') }}</option>
                            </select>
                            @error('gradeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-2   has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="sectionId" class="form-select" id="sectionInput" required>
                                <option selected disabled value="">{{ trans('student.chooseSection') }}</option>
                            </select>
                            @error('sectionId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3   has-validation">
                            <label for="parentInput">{{ trans('student.parentName') }}</label>
                            <select name="parentId" class="form-select" id="parentInput" required>
                                <option selected disabled value="">{{ trans('student.chooseParent') }}</option>
                                @foreach ($data['parents'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->fatherName }}</option>
                                @endforeach
                            </select>
                            @error('parentId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3   has-validation">
                            <label for="academicYearInput">{{ trans('student.academicYear') }}</label>
                            <select name="academicYear" class="form-select" id="academicYearInput" required>
                                <option selected disabled value="">{{ trans('student.chooseAcademicYear') }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            @error('academicYear')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-2 ">
                            <label for="">{{ trans('student.addFile') }}</label>
                            <input type="file" class="form-control" aria-label="file example" name="images[]" accept="image/*" multiple>
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
        let stageSelect = document.querySelectorAll('select[name="stageId"]');

        let gradeSelect = document.querySelectorAll('select[name="gradeId"]');
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
        let sectionSelect = document.querySelectorAll('select[name="sectionId"]');

        let gradesSelect = document.querySelectorAll('select[name="gradeId"]');
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
    <script>
        $(function() {
            $("#birthDateInput").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
@endsection
