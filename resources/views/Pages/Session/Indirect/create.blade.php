@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('session.add'))


@section('headerTitle', trans('session.add'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="container">
                @if(auth()->guard('admin')->check())
                <form action="{{ route('indirect.indirectSessionStore') }}" method="POST" autocomplete="off"
                class="needs-validation" novalidate>
                @elseif(auth()->guard('teacher')->check())
                <form action="{{ route('teacher.indirect.indirectSessionStore') }}" method="POST" autocomplete="off"
                class="needs-validation" novalidate>
                @endif
            
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 mt-2  has-validation">
                            <label for="nameEnInput">{{ trans('session.topic') }}</label>
                            <input type="text" class="form-control" name="topic" id="nameEnInput" required>
                            @error('topic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-2  has-validation">
                            <label for="datepicker">{{ trans('session.startTime') }}</label>
                            <input type="text" class="form-control" name="start_time" id="datepicker" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-2  has-validation">
                            <label>{{ trans('session.duration') }}</label>
                            <input type="text" class="form-control" name="duration" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label>{{ trans('session.meetingNumber') }}</label>
                            <input type="text" class="form-control" name="meeting_number" required>
                            @error('meeting_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label>{{ trans('session.meetingPassword') }}</label>
                            <input type="text" class="form-control" name="meeting_password" required>
                            @error('meeting_password')
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
                        <div class="col-lg-6 mt-2  has-validation">
                            <label>{{ trans('session.startLink') }}</label>
                            <input type="text" class="form-control" name="start_link" required>
                            @error('start_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2  has-validation">
                            <label>{{ trans('session.joinLink') }}</label>
                            <input type="text" class="form-control" name="join_link" required>
                            @error('join_link')
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
    <script>
        $("#datepicker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
@endsection
