@extends('layouts.master')
@section('title', trans('sidebar.studentList'))
@section('headerTitle', trans('sidebar.studentList'))

@section('css')
    <style>
        table { margin-top: 20px; }
        .attend:checked, .attend:hover, .attend:focus { background-color: green; border-color: green; }
        .attend:focus { box-shadow: 0 0 0 0.25rem green; outline: transparent; }
        .absent:checked, .absent:hover, .absent:focus { background-color: red; border-color: red; }
        .absent:focus { box-shadow: 0 0 0 0.25rem red; outline: transparent; }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $locale = app()->getLocale();
                $months = $locale == 'ar' ? ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'] :
                                            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $formattedDate = date('d') . ' ' . $months[date('n') - 1] . ' ' . date('Y');
                $firstStudent = $students->first();
                \Log::info('Current locale: ' . app()->getLocale());

            @endphp
            
            <h3>{{ trans('student.date') }}: {{ $formattedDate }}</h3>
            <form method="POST" action="{{ route('teacher.attendance.store', ['locale' => 'en']) }}">
                @csrf
                <table id="example" class="display" style="width:100%; margin-top: 20px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('student.studentName') }}</th>
                            <th>{{ trans('student.stageName') }}</th>
                            <th>{{ trans('student.gradeName') }}</th>
                            <th>{{ trans('student.sectionName') }}</th>
                            <th>{{ trans('sidebar.Attendance') }}</th>
                            @if ($firstStudent && $firstStudent->attendance()->where('date', date('Y-m-d'))->exists())
                                <th>{{ trans('student.operation') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            @php $attendance = $item->attendance()->where('date', date('Y-m-d'))->first(); @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->stages->name }}</td>
                                <td>{{ $item->grades->name }}</td>
                                <td>{{ $item->sections->name }}</td>
                                <td>
                                    @if ($attendance)
                                        @foreach ([1 => 'attend', 0 => 'absent'] as $status => $label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input {{ $label }}" type="radio"
                                                    name="attendance[{{ $item->id }}]" id="{{ $label }}-{{ $item->id }}"
                                                    value="{{ $label }}" {{ $attendance->status == $status ? 'checked' : '' }} disabled>
                                                <label class="form-check-label" for="{{ $label }}-{{ $item->id }}">{{ trans("student.$label") }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ([1 => 'attend', 0 => 'absent'] as $status => $label)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input {{ $label }}" type="radio"
                                                    name="attendance[{{ $item->id }}]" id="{{ $label }}-{{ $item->id }}"
                                                    value="{{ $label }}">
                                                <label class="form-check-label" for="{{ $label }}-{{ $item->id }}">{{ trans("student.$label") }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="studentId[]" value="{{ $item->id }}">
                                    <input type="hidden" name="stageId" value="{{ $item->stages->id }}">
                                    <input type="hidden" name="gradeId" value="{{ $item->grades->id }}">
                                    <input type="hidden" name="sectionId" value="{{ $item->sections->id }}">
                                </td>
                                @if ($attendance)
                                    <td>
                                        <button class="btn btn-info edit-attendance-btn" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editAttendanceModal"
                                            data-student-id="{{ $item->id }}" data-student-name="{{ $item->name }}"
                                            data-attendance-status="{{ $attendance->status }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="submit" class="btn btn-primary" value="Submit"
                    {{ $firstStudent && $firstStudent->attendance()->where('date', date('Y-m-d'))->exists() ? 'disabled' : '' }}>
            </form>
        </div>
    </div>
    @include('Pages.Student.Attendance.Modal.editAttendanceModal')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({ "language": {!! json_encode($translations) !!} });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".edit-attendance-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let studentId = this.dataset.studentId;
                    let studentName = this.dataset.studentName;
                    let attendanceStatus = this.dataset.attendanceStatus;

                    document.getElementById("modalStudentId").value = studentId;
                    document.getElementById("modalStudentName").textContent = "Edit Attendance for " + studentName;
                    document.getElementById("modalAttend").checked = attendanceStatus == 1;
                    document.getElementById("modalAbsent").checked = attendanceStatus == 0;
                });
            });
        });
    </script>
@endsection
