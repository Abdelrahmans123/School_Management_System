@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('student.edit'))
@section('headerTitle', trans('student.edit'))
@section('content')
    <!-- row -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h4 class="text-primary m-2">{{ trans('student.personalInfo') }}</h4>
                <form action="{{ route('student.update',['student'=>$student->id] ) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="studentId" value="{{ $student->id }}">
                    <div class="row">
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="emailInput">{{ trans('teacher.email') }}</label>
                            <input type="email" class="form-control" name="email" id="emailInput"
                                value="{{ $student->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="passwordInput">{{ trans('teacher.password') }}</label>
                            <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Enter new password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="nameEnInput">{{ trans('student.nameEn') }}</label>
                            <input type="text" class="form-control" name="nameEn" id="nameEnInput"
                                value="{{ $student->getTranslation('name', 'en') }}" required>
                            @error('nameEn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label for="nameArInput">{{ trans('student.nameAr') }}</label>
                            <input type="text" class="form-control" name="nameAr" id="nameArInput"
                                value="{{ $student->getTranslation('name', 'ar') }}" required>
                            @error('nameAr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="gendersIdInput">{{ trans('student.gender') }}</label>
                            <select name="gendersId" class="form-select" id="gendersIdInput" required>
                                <option selected disabled>{{ trans('student.chooseGender') }}</option>
                                @foreach ($data['genders'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $student->gender_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('gendersId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="nationalityIdInput">{{ trans('student.nationality') }}</label>
                            <select name="nationalityId" class="form-select" id="nationalityIdInput" required>
                                <option selected disabled>{{ trans('student.chooseNationalities') }}</option>
                                @foreach ($data['nationalities'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $student->nationality_id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nationalityId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="bloodTypeIdInput">{{ trans('student.bloodType') }}</label>
                            <select name="bloodTypeId" class="form-select" id="bloodTypeIdInput" required>
                                <option selected disabled>{{ trans('student.chooseBlood') }}</option>
                                @foreach ($data['bloodTypes'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $student->bloodType_id ? 'selected' : '' }}>{{ $item->type }}</option>
                                @endforeach
                            </select>
                            @error('bloodTypeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="birthDateInput">{{ trans('student.birthDate') }}</label>
                            <input type="text" class="form-control" name="birthDate" id="birthDateInput"
                                value="{{ $student->birthDate }}" required>
                            @error('birthDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h4 class="text-primary mt-5">{{ trans('student.studentInfo') }}</h4>
                        <div class="col-lg-2  has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="stageId" class="form-select" id="stageInput" required>
                                <option selected disabled>{{ trans('student.chooseStage') }}</option>
                                @foreach ($data['stages'] as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $student->stage_id ? 'selected' : '' }}>
                                        {{ $item->Name }}</option>
                                @endforeach
                            </select>
                            @error('stageId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-2   has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="gradeId" class="form-select" id="gradeInput" required>
                                {{-- <option selected disabled>{{ trans('student.chooseGrade') }}</option> --}}
                                <option value="{{ $student->grade_id }}">{{ $student->grades->name }}</option>
                            </select>
                            @error('gradeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-2   has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="sectionId" class="form-select" id="sectionInput" required>
                                {{-- <option selected disabled>{{ trans('student.chooseSection') }}</option> --}}
                                <option value="{{ $student->section_id }}">{{ $student->sections->name }}</option>
                            </select>
                            @error('sectionId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3   has-validation">
                            <label for="parentInput">{{ trans('student.parentName') }}</label>
                            <select name="parentId" class="form-select" id="parentInput" required>
                                <option selected disabled>{{ trans('student.chooseParent') }}</option>
                                @foreach ($data['parents'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $student->parent_id ? 'selected' : '' }}>{{ $item->fatherName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parentId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-3   has-validation">
                            <label for="academicYearInput">{{ trans('student.academicYear') }}</label>
                            <select name="academicYear" class="form-select" id="academicYearInput" required>
                                <option  disabled>{{ trans('student.chooseAcademicYear') }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ $year == $student->academicYear ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('academicYear')
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
                            @if (App::getLocale() == 'ar') text = document.createTextNode(res[k].name.ar);
                    @else
                        text = document.createTextNode(res[k].name.en); @endif
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
                            @if (App::getLocale() == 'ar') text = document.createTextNode(res[k].name.ar);
                @else
                    text = document.createTextNode(res[k].name.en); @endif
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
