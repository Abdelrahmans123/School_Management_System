@extends('layouts.master')
@section('css')
    @livewireStyles
    <style>
        a {
            text-decoration: none;
        }

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

@section('title', trans('sidebar.teacherDashboard'))
@section('dashboard', true)
@section('userName', auth('teacher')->user()->name)


@section('headerTitle', trans('sidebar.teacherDashboard'))

@section('content')
    <!-- row -->
    {{-- @dd(app()->getLocale()); --}}

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user-graduate fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.studentCount') }}</h5>
                        <p class="card-text fw-bold">{{ $studentCount }}</p>
                        <a href={{ route('teacher.attendance.index') }}
                            class="btn btn-outline-primary btn-sm">{{ trans('admin.showMore') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-school fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">{{ trans('admin.classCount') }}</h5>
                        <p class="card-text fw-bold">{{ $sectionCount }}</p>
                        <a href={{ route('teacher.section.index') }} class="btn btn-outline-danger btn-sm">View
                            Details</a>
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
    </div>
    <!-- Attendance Summary Chart -->

    <!-- row closed -->
@endsection
@section('js')
    @livewireScripts
    @stack('calenderScripts')
@endsection
