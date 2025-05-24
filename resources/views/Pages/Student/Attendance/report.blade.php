@extends('layouts.master')
@section('title', trans('sidebar.AttendanceReport'))
@section('headerTitle', trans('sidebar.AttendanceReport'))

@section('css')
    <!-- Include any custom CSS for styling here -->
@endsection
@php
    $studentSearch = session('studentSearch', collect());
@endphp


@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <div class="card">
        <div class="card-body">
            <h3>{{ trans('attendance.searchInfo') }}</h3>
            <div class="container">
                <form method="POST" action="{{ route('attendance.search') }}" class="row align-items-center"
                    autocomplete="off">
                    @csrf
                    <div class="col-md-4">
                        <label>{{ trans('attendance.students') }}</label>
                        <select class="form-select" aria-label="Default select example" name="student_id">
                            <option value="0" selected>{{ trans('attendance.all') }}</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mt-4">
                            <span class="input-group-text">{{ trans('attendance.startDate') }}</span>
                            <input type="text" id="startDateInput" name="start_date" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mt-4">
                            <span class="input-group-text">{{ trans('attendance.endDate') }}</span>
                            <input type="text" id="endDateInput" name="end_date" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <input type="submit" value="{{ trans('grade.submit') }}" class="btn btn-success my-3">
                </form>
            </div>

            @if ($studentSearch && $studentSearch->isNotEmpty())
                <table id="example" class="display" style="width:100%; margin-top: 20px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('student.studentName') }}</th>
                            <th>{{ trans('student.stageName') }}</th>
                            <th>{{ trans('student.gradeName') }}</th>
                            <th>{{ trans('student.sectionName') }}</th>
                            <th>{{ trans('student.date') }}</th>
                            <th>{{ trans('section.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentSearch as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->students->name }}</td>
                                <td>{{ $item->stages->name }}</td>
                                <td>{{ $item->grades->name }}</td>
                                <td>{{ $item->sections->name }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span
                                            class="badge rounded-pill text-bg-success">{{ trans('student.attend') }}</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">{{ trans('admin.absent') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
        $(function() {
            // Get the app locale from Laravel
            let locale = "{{ app()->getLocale() }}";

            // Define Arabic settings
            let arabicSettings = {
                closeText: 'إغلاق',
                prevText: 'السابق',
                nextText: 'التالي',
                currentText: 'اليوم',
                monthNames: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
                    'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                ],
                monthNamesShort: ['ينا', 'فبر', 'مار', 'أبر', 'ماي', 'يون',
                    'يول', 'أغس', 'سبت', 'أكت', 'نوف', 'ديس'
                ],
                dayNames: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                dayNamesShort: ['أحد', 'إثن', 'ثلا', 'أرب', 'خمي', 'جمع', 'سبت'],
                dayNamesMin: ['ح', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
                weekHeader: 'أسبوع',
                dateFormat: 'yy-mm-dd',
                firstDay: 6, // Arabic week starts on Saturday
                isRTL: true, // Right-to-left support
                showMonthAfterYear: false,
                yearSuffix: '',
                showAnim: 'slideDown'
            };

            // Define English settings (default)
            let englishSettings = {
                closeText: 'Close',
                prevText: 'Previous',
                nextText: 'Next',
                currentText: 'Today',
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ],
                monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0, // English week starts on Sunday
                isRTL: false, // Left-to-right support
                showMonthAfterYear: false,
                yearSuffix: '',
                showAnim: 'slideDown'
            };

            // Determine settings based on locale
            let datepickerSettings = (locale === 'ar') ? arabicSettings : englishSettings;

            // Apply settings to datepickers
            $("#startDateInput").datepicker(datepickerSettings);
            $("#endDateInput").datepicker(datepickerSettings);
        });
    </script>
@endsection
