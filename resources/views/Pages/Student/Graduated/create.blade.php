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
@section('title', trans('graduated.add'))


@section('headerTitle', trans('graduated.add'))

@section('content')
    <!-- row -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('graduated.store') }}" method="POST" autocomplete="off" class="needs-validation" enctype="multipart/form-data"
                    id="dropzone" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-4  has-validation">
                            <label for="stageInput">{{ trans('student.stageName') }}</label>
                            <select name="stageId" class="form-select" id="stageInput" required>
                                <option selected disabled value="">{{ trans('student.chooseStage') }}</option>
                                @foreach ($data['stages'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->Name }}</option>
                                @endforeach
                            </select>
                            @error('stageId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4   has-validation">
                            <label for="gradeInput">{{ trans('student.gradeName') }}</label>
                            <select name="gradeId" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('student.chooseGrade') }}</option>
                            </select>
                            @error('gradeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4   has-validation">
                            <label for="sectionInput">{{ trans('student.sectionName') }}</label>
                            <select name="sectionId" class="form-select" id="sectionInput" required>
                                <option selected disabled value="">{{ trans('student.chooseSection') }}</option>
                            </select>
                            @error('sectionId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-3">
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
