@extends('layouts.master')
@section('css')
    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
        
        </style>
    @livewireStyles
    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card .calendar-container a {
            text-decoration: none;
            color: #007bff;

        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-container canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .btn-outline-primary,
        .btn-outline-success,
        .btn-outline-warning,
        .btn-outline-danger {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: #fff;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #000;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
@endsection
@section('title', trans('sidebar.adminDashboard'))



@section('headerTitle', trans('sidebar.adminDashboard'))
@section('userName', auth('admin')->user()->name)

@section('content')
    <!-- row -->

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user-graduate fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.studentCount') }}</h5>
                        <p class="card-text fw-bold">{{ App\Models\Student::count() }}</p>
                        <a href={{ route('student.index') }}
                            class="btn btn-outline-primary btn-sm">{{ trans('admin.showMore') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.teacherCount') }}</h5>
                        <p class="card-text fw-bold">{{ App\Models\Teacher::count() }}</p>
                        <a href={{ route('teacher.index') }} class="btn btn-outline-success btn-sm">View
                            Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-users fa-3x text-warning mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.parentCount') }}</h5>
                        <p class="card-text fw-bold">{{ App\Models\Guardian::count() }}</p>
                        <a href={{ route('parent.index') }} class="btn btn-outline-warning btn-sm">View
                            Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-school fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.classCount') }}</h5>
                        <p class="card-text fw-bold">{{ App\Models\Section::count() }}</p>
                        <a href={{ route('section.index') }} class="btn btn-outline-danger btn-sm">View
                            Details</a>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-2">
                <div class="card shadow-sm mb-4 h-100">
                    <div class="card-header">{{ trans('admin.attendanceSummary') }}</div>
                    <div class="card-body">
                        <div class="chart-containers" style="height: 400px">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-2">
                <div class="card shadow-sm mb-4 h-100">
                    <div class="card-header">{{ trans('admin.enrollmentSummary') }}</div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="enrollmentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="card shadow-sm mb-4 h-100">
                    <div class="card-header">{{ trans('admin.lastOperation') }}</div>
                    <ul class="nav nav-pills mb-3 p-2" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-student" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">{{ trans('sidebar.Student') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-teacher" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">{{ trans('sidebar.Teacher') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-parent" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">{{ trans('sidebar.Parent') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-fee" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">{{ trans('sidebar.Fee') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content p-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-student" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <table id="example" class="display" style="width:% p-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('student.studentName') }}</th>
                                        <th>{{ trans('student.stageName') }}</th>
                                        <th>{{ trans('student.gradeName') }}</th>
                                        <th>{{ trans('student.sectionName') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Student::latest()->take(5)->get() as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->stages->Name }}</td>
                                            <td>{{ $item->grades->name }}</td>
                                            <td>{{ $item->sections->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-teacher" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <table id="teacherTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('teacher.teacherName') }}</th>
                                        <th>{{ trans('teacher.gender') }}</th>
                                        <th>{{ trans('teacher.joinDate') }}</th>
                                        <th>{{ trans('teacher.specialize') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Teacher::latest()->take(5)->get() as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->genders->name }}</td>
                                            <td>{{ $item->joiningDate }}</td>
                                            <td>{{ $item->specializations->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-parent" role="tabpanel" aria-labelledby="pills-contact-tab"
                            tabindex="0">
                            <table id="fatherTable" class="display" style="width:100%;margin-bottom:10px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('parent.fatherName') }}</th>
                                        <th>{{ trans('parent.fatherJob') }}</th>
                                        <th>{{ trans('parent.IdNumber') }}</th>
                                        <th>{{ trans('parent.PassportNumber') }}</th>
                                        <th>{{ trans('parent.phone') }}</th>
                                        <th>{{ trans('parent.address') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Guardian::latest()->take(5)->get() as $guardian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $guardian->fatherName }}</td>
                                            <td>{{ $guardian->fatherJob }}</td>
                                            <td>{{ $guardian->fatherIdNumber }}</td>
                                            <td>{{ $guardian->fatherPassportNumber }}</td>
                                            <td>{{ $guardian->fatherPhone }}</td>
                                            <td>{{ $guardian->fatherAddress }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-fee" role="tabpanel" aria-labelledby="pills-fee-tab"
                            tabindex="0">
                            <table id="feeTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('fee.title') }}</th>
                                        <th>{{ trans('fee.amount') }}</th>
                                        <th>{{ trans('fee.stageName') }}</th>
                                        <th>{{ trans('fee.gradeName') }}</th>
                                        <th>{{ trans('fee.description') }}</th>
                                        <th>{{ trans('fee.year') }}</th>
                                        <th>{{ trans('fee.type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Fee::latest()->take(5)->get() as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->stages->Name }}</td>
                                            <td>{{ $item->grades->name }}</td>
                                            <td>
                                                @if ($item->description == null)
                                                    <span
                                                        class="badge text-bg-danger">{{ trans('message.noNotes') }}</span>
                                                @else
                                                    {{ $item->description }}
                                                @endif
                                            </td>
                                            <td>{{ $item->year }}</td>
                                            <td>
                                                @if ($item->type == 1)
                                                    {{ trans('fee.schoolFee') }}
                                                @else
                                                    {{ trans('fee.busFee') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="card shadow-sm mb-4 h-100">
                    <div class="card-header">{{ trans('admin.calendar') }}</div>
                    <div class="card-body calendar-container">
                        @livewire('calendar')

                    </div>
                </div>
            </div>
        </div>
        <!-- Attendance Summary Chart -->
    </div>


    <!-- row closed -->
@endsection

@section('js')

    @livewireScripts
    @stack('calenderScripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var colors = @json(
            $summary->pluck('status')->map(function ($status) {
                return $status ? '#28a745' : '#dc3545'; // Green for Present, Red for Absent
            }));
    </script>
    <script>
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var colors = @json(
            $summary->pluck('status')->map(function ($status) {
                return $status ? '#28a745' : '#dc3545'; // Green for Present, Red for Absent
            }));
        var attendanceData = {
            labels: @json(
                $summary->pluck('status')->map(function ($status) {
                    return $status ? trans('admin.present') : trans('admin.absent');
                })),
            datasets: [{
                label: @json(trans('admin.attendanceSummary')),
                data: @json($summary->pluck('count')),
                backgroundColor: colors, // Use dynamic colors een for Present, Red for Absent
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: attendanceData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: @json(trans('admin.attendanceOverview')),
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('enrollmentChart').getContext('2d');

        // Gradient background for the chart
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

        var enrollmentData = {
            labels: @json($enrollmentData->pluck('formatted_date')),
            datasets: [{
                label: @json(trans('admin.newEnrollment')),
                data: @json($enrollmentData->pluck('count')),
                backgroundColor: gradient,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                fill: true, // Fill the area under the line
            }]
        };

        new Chart(ctx, {
            type: 'line',
            data: enrollmentData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: @json(trans('admin.studentEnrollment')),
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: @json(trans('admin.monthYear')),
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: @json(trans('admin.enrollmentCount')),
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: {
                                bottom: 10
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
            $('#teacherTable').DataTable({
                "language": lang,
            });
            $('#fatherTable').DataTable({
                "language": lang,
            });
            $('#feeTable').DataTable({
                "language": lang,
            });
        });
    </script>
    
@endsection
