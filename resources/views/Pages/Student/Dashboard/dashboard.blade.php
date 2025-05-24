@extends('layouts.master')
@section('css')
    @livewireStyles
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endsection
@section('title', trans('sidebar.studentDashboard'))



@section('headerTitle', trans('sidebar.studentDashboard'))
@section('dashboard', true)
@section('userName', auth('student')->user()->name)

@section('content')
    <!-- row -->


    <div class="card h-100">
        <div class="card-body">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Courses</h5>
                                <p class="card-text">5</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Recent Courses</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Math 101</li>
                            <li class="list-group-item">Physics 201</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Notifications</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Assignment 2 is due tomorrow</li>
                            <li class="list-group-item">New lecture material uploaded</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <canvas id="gradesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            <livewire:student-calendar />
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')
    @livewireScripts
    @stack('calenderScripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('gradesChart').getContext('2d');
        const gradesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Math', 'English', 'Science', 'History'],
                datasets: [{
                    label: 'Grades',
                    data: [85, 90, 78, 88],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
@endsection
