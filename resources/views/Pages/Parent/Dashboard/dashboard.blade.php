@extends('layouts.master')

@section('css')
    <!-- Add custom styles here -->
    <style>
        .subject-gpa-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .subject-gpa-card:hover {
            transform: translateY(-5px);
        }

        .subject-gpa-card h4 {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 15px;
        }

        .subject-gpa-card p {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .student-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .student-card:hover {
            transform: translateY(-5px);
        }

        .student-card .card-body {
            padding: 20px;
        }

        .student-card .card-body h5 {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .student-card .card-body p {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn-outline-primary {
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .chart-container {
            margin-top: 30px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
            font-size: 1.2rem;
            font-weight: 600;
            color: #495057;
        }

        /* New styles for enhanced dashboard */
        .dashboard-summary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .summary-item {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .summary-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .summary-item i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .summary-item h3 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .summary-item p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .notification-card {
            border-left: 4px solid #007bff;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .notification-card:hover {
            transform: translateX(5px);
        }

        .notification-time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .action-buttons .btn {
            margin-right: 5px;
            border-radius: 20px;
            font-size: 0.8rem;
            padding: 5px 15px;
        }
    </style>
@endsection

@section('title', trans('sidebar.parentDashboard'))

@section('headerTitle', trans('sidebar.parentDashboard'))
@section('dashboard', true)
@section('userName', auth('parent')->user()->fatherName)

@section('content')
    <!-- row -->
    <div class="card h-100">
        <div class="card-body">
            <div class="container mt-4">
                <!-- Dashboard Summary -->
                <div class="dashboard-summary">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="summary-item">
                                <i class="fa-solid fa-user-graduate"></i>
                                <h3>{{ count($students) }}</h3>
                                <p>{{ trans('parent.children') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <i class="fa-solid fa-calendar-check"></i>
                                <h3>{{ array_sum(
                                    array_map(function ($student) use ($studentAttendance) {
                                        return array_reduce(
                                            $studentAttendance[$student->id]->toArray(),
                                            function ($acc, $item) {
                                                return $acc + $item['present'];
                                            },
                                            0,
                                        );
                                    }, $students->all()),
                                ) }}
                                </h3>
                                <p>{{ trans('parent.totalAttendance') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <i class="fa-solid fa-chart-line"></i>
                                <h3>{{ number_format(
                                    array_sum(
                                        array_map(function ($subjectGpa) {
                                            return $subjectGpa['gpa'];
                                        }, $subjectGpas->toArray()),
                                    ) / count($subjectGpas),
                                    1,
                                ) }}
                                </h3>
                                <p>{{ trans('parent.averageGPA') }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <i class="fa-solid fa-book"></i>
                                <h3>{{ count($subjectGpas) }}</h3>
                                <p>{{ trans('parent.subjects') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Cards -->
                <h4 class="mb-4"><i class="fa-solid fa-users me-2"></i>{{ trans('parent.yourChildren') }}</h4>
                <div class="row g-4">
                    @foreach ($students as $student)
                        <div class="col-md-4">
                            <div class="student-card shadow-sm border-0 h-100">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-user-graduate fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title text-dark">{{ $student->name }}</h5>
                                    <p class="card-text text-muted">{{ $student->stages->name }}</p>
                                    <p class="card-text text-muted">{{ $student->grades->name }}</p>
                                    <p class="card-text text-muted">{{ $student->sections->name }}</p>
                                    <div class="action-buttons mt-3">
                                        <a href="#" class="btn btn-outline-primary btn-sm"><i
                                                class="fa-solid fa-chart-simple me-1"></i>{{ trans('parent.grades') }}</a>
                                        <a href="#" class="btn btn-outline-info btn-sm"><i
                                                class="fa-solid fa-calendar-days me-1"></i>{{ trans('parent.attendance') }}</a>
                                        <a href="#" class="btn btn-outline-success btn-sm"><i
                                                class="fa-solid fa-message me-1"></i>{{ trans('parent.contact') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row g-4 mt-5">
                    <!-- Recent Notifications -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <i class="fa-solid fa-bell me-2"></i>{{ trans('parent.recentNotifications') }}
                            </div>
                            <div class="card-body">
                                <div class="notification-card p-3 bg-light">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ trans('parent.upcomingExam') }}</h6>
                                        <span class="notification-time">2 {{ trans('parent.hoursAgo') }}</span>
                                    </div>
                                    <p class="mb-0">{{ trans('parent.mathExamScheduled') }}</p>
                                </div>
                                <div class="notification-card p-3 bg-light">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ trans('parent.attendanceAlert') }}</h6>
                                        <span class="notification-time">1 {{ trans('parent.daysAgo') }}</span>
                                    </div>
                                    <p class="mb-0">{{ trans('parent.ahmadWasAbsent') }}</p>
                                </div>
                                <div class="notification-card p-3 bg-light">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ trans('parent.gradePosted') }}</h6>
                                        <span class="notification-time">3 {{ trans('parent.daysAgo') }}</span>
                                    </div>
                                    <p class="mb-0">{{ trans('parent.scienceGradePosted') }}</p>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="#"
                                        class="btn btn-outline-primary btn-sm">{{ trans('parent.viewAllNotifications') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subject-wise GPA -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <i class="fa-solid fa-graduation-cap me-2"></i>{{ trans('parent.subjectPerformance') }}
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach ($subjectGpas as $subjectGpa)
                                        <div class="col-md-6">
                                            <div class="subject-gpa-card shadow-sm">
                                                <h4>{{ $subjectGpa['subject'] }}</h4>
                                                <p><strong>{{ trans('parent.averageScore') }}:</strong>
                                                    {{ $subjectGpa['average'] }}%</p>
                                                <p><strong>{{ trans('parent.gpa') }}:</strong> {{ $subjectGpa['gpa'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Performance & Attendance Charts -->
                <div class="row g-4 mt-5">
                    <!-- Performance Chart -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header"><i
                                    class="fa-solid fa-chart-line me-2"></i>{{ trans('parent.studentPerformance') }}</div>
                            <div class="card-body chart-container">
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                @foreach ($students as $student)
                                    <h5 class="text-center mb-4">{{ $student->name }}</h5>
                                    <canvas id="performanceChart{{ $student->id }}"></canvas>
                                    <script>
                                        var performanceData{{ $student->id }} = @json($studentPerformance[$student->id]);

                                        var performanceChart{{ $student->id }} = new Chart(document.getElementById(
                                            'performanceChart{{ $student->id }}'), {
                                            type: 'line',
                                            data: {
                                                labels: performanceData{{ $student->id }}.map(item => item.month),
                                                datasets: [{
                                                    label: '{{ trans('parent.performanceScore') }}',
                                                    data: performanceData{{ $student->id }}.map(item => item.score),
                                                    fill: false,
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    tension: 0.1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        max: 100,
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Chart -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header"><i
                                    class="fa-solid fa-calendar-check me-2"></i>{{ trans('parent.attendanceOverview') }}
                            </div>
                            <div class="card-body chart-container">
                                @foreach ($students as $student)
                                    <h5 class="text-center mb-4">{{ $student->name }}</h5>
                                    <canvas id="attendancePieChart{{ $student->id }}"></canvas>
                                    <script>
                                        var attendanceData{{ $student->id }} = @json($studentAttendance[$student->id]);

                                        var presentDays = attendanceData{{ $student->id }}.reduce(function(acc, item) {
                                            return acc + item.present;
                                        }, 0);

                                        var absentDays = attendanceData{{ $student->id }}.reduce(function(acc, item) {
                                            return acc + item.absent;
                                        }, 0);

                                        var attendancePieChart{{ $student->id }} = new Chart(document.getElementById(
                                            'attendancePieChart{{ $student->id }}'), {
                                            type: 'pie',
                                            data: {
                                                labels: ['{{ trans('admin.present') }}', '{{ trans('admin.absent') }}'],
                                                datasets: [{
                                                    data: [presentDays, absentDays],
                                                    backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                                                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        position: 'top',
                                                    },
                                                    tooltip: {
                                                        callbacks: {
                                                            label: function(tooltipItem) {
                                                                return tooltipItem.label + ': ' + tooltipItem.raw +
                                                                    ' {{ trans('parent.days') }}';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <!-- Add custom JS scripts here -->
@endsection
