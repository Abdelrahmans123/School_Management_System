@extends('layouts.master')
@section('css')
    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="card-body">
            <div class="container">
                <h4 class="text-primary m-2">{{ trans('promotion.lastStage') }}</h4>
                <form action="{{ route('promotion.store') }}" method="POST" autocomplete="off" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="oldStageId" class="form-select" id="stageInput" required>
                                <option selected disabled value="">{{ trans('student.chooseStage') }}</option>
                                @foreach ($stages as $item)
                                    <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                @endforeach
                            </select>
                            @error('oldStageId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="oldGradeId" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGrade') }}</option>
                            </select>
                            @error('oldGradeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="oldSectionId" class="form-select" id="sectionInput" required>
                                <option selected disabled value="">{{ trans('student.chooseSection') }}</option>
                            </select>
                            @error('oldSectionId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3 mt-2  has-validation">
                            <label for="academicYearInput">{{ trans('student.academicYear') }}</label>
                            <select name="oldAcademicYear" class="form-select" id="academicYearInput" required>
                                <option selected disabled value="">{{ trans('student.chooseAcademicYear') }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            @error('oldAcademicYear')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h4 class="text-primary mt-5">{{ trans('promotion.newStage') }}</h4>
                        <div class="col-lg-3  has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="stageId" class="form-select" id="stageInput" required>
                                <option selected disabled value="">{{ trans('student.chooseStage') }}</option>
                                @foreach ($stages as $item)
                                    <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                @endforeach
                            </select>
                            @error('stageId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3   has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="gradeId" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGrade') }}</option>
                            </select>
                            @error('gradeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3   has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="sectionId" class="form-select" id="sectionInput" required>
                                <option selected disabled value="">{{ trans('student.chooseSection') }}</option>
                            </select>
                            @error('sectionId')
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
        // Function to handle XMLHttpRequest and populate select elements
        function populateSelect(url, selectElement, defaultOptionText, locale) {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if (this.status === 200) {
                    const data = JSON.parse(this.response);
                    selectElement.innerHTML = `<option selected disabled>${defaultOptionText}</option>`;
                    data.forEach(item => {
                        const option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = locale === 'ar' ? item.name.ar : item.name.en;
                        selectElement.appendChild(option);
                    });
                } else {
                    console.error("Failed to fetch data:", this.status);
                }
            };
            xhttp.open("GET", url);
            xhttp.send();
        }

        // Event listeners for stage change
        document.querySelectorAll('select[name="oldStageId"], select[name="stageId"]').forEach(select => {
            select.addEventListener('change', (event) => {
                const stageId = event.target.value;
                const url = `{{ $url }}/${stageId}`;
                const selectName = select.name === 'oldStageId' ? 'oldGradeId' : 'gradeId';
                const selectElements = document.querySelectorAll(`select[name="${selectName}"]`);
                const defaultOptionText = '{{ trans('student.chooseGrade') }}';
                const locale = '{{ App::getLocale() }}';
                selectElements.forEach(selectElement => {
                    populateSelect(url, selectElement, defaultOptionText, locale);
                });
            });
        });

        // Event listener for grade change
        document.querySelectorAll('select[name="oldGradeId"],select[name="gradeId"]').forEach(select => {
            select.addEventListener('change', (event) => {
                const gradeId = event.target.value;
                const url = `{{ $sectionUrl }}/${gradeId}`;
                const selectName = select.name === 'oldGradeId' ? 'oldSectionId' : 'sectionId';
                const selectElements = document.querySelectorAll(`select[name="${selectName}"]`);
                const defaultOptionText = '{{ trans('student.chooseSection') }}';
                const locale = '{{ App::getLocale() }}';
                selectElements.forEach(selectElement => {
                    populateSelect(url, selectElement, defaultOptionText, locale);
                });
            });
        });
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
