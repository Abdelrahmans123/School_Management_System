@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('question.add'))


@section('headerTitle', trans('question.add'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('teacher.question.store') }}" method="POST" autocomplete="off" class="needs-validation"
                    novalidate>
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <div class="row">
                        <div class="col-lg-12 mt-2  has-validation">
                            <label for="nameArInput">{{ trans('question.questionTitle') }}</label>
                            <input type="text" class="form-control" name="title" id="nameArInput" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-2  has-validation">
                            <label>{{ trans('question.answers') }} <span class="text-danger">{{ trans('question.addLine') }}
                                    - </span></label>
                            <textarea class="form-control" name="answers" required></textarea>
                            @error('answers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12  mt-2 has-validation">
                            <label for="parentInput">{{ trans('question.rightAnswer') }}</label>
                            <input type="text" id="parentInput" class="form-control" name="right_answer" required>
                            @error('right_answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mt-2  has-validation">
                            <label for="gradeInput">{{ trans('question.score') }}</label>
                            <select name="score" class="form-select" id="gradeInput" required>
                                <option selected disabled value="">{{ trans('question.chooseScore') }}</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                            @error('score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class=" mt-5">
                        <input type="submit" class="btn btn-primary" value="{{ trans('message.submit') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- row closed -->
@endsection
@section('js')

@endsection
