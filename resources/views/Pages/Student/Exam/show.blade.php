@extends('layouts.master')
@section('css')
    @livewireStyles
@endsection
@section('title', trans('sidebar.ExamList'))


@section('headerTitle', trans('sidebar.ExamList'))

@section('content')
    <!-- row -->






    <div class="card">
        <div class="card-body">
            @livewire('show-question', ['exam_id' => $quiz->id, 'student_id' => $student_id])
        </div>
    </div>




    <!-- row closed -->
@endsection
@section('js')
    @livewireScripts
    @stack('questionScripts')
    
@endsection
