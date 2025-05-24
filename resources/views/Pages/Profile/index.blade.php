{{-- start the blade extension and define the parent layout file --}}
@extends('layouts.master')
{{-- define any css or script files specific to this view --}}
@section('css')
    <style>
        .eye {
            top: 40px;
            right: 10px;
            cursor: pointer;
        }

        .eye i {
            color: #ccc;
        }
    </style>
@endsection
{{-- define the title for this view --}}
@section('title', trans('sidebar.Profile'))

{{-- define the header title for this view --}}
@section('headerTitle', trans('sidebar.Profile'))

{{-- start the main content for this view --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Profile Info Card --}}
                <div class="card mb-4">
                    <div class="card-header">{{ trans('sidebar.Profile') }}</div>
                    <div class="card-body text-center w-50 mx-auto">
                        @if (auth()->guard('teacher')->check())
                            <img src="{{ URL::asset('assets/images/teacher.png') }}" class="rounded-circle mb-3" width="120"
                            @elseif (auth()->guard('student')->check()) <img
                                src="{{ URL::asset('assets/images/student.png') }}" class="rounded-circle mb-3"
                                width="120" alt="Avatar">
                        @elseif (auth()->guard('parent')->check())
                            <img src="{{ URL::asset('assets/images/parent.png') }}" class="rounded-circle mb-3"
                                width="120" alt="Avatar">
                        @endif
                        <h4>{{ $user->fatherName }}</h4>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>

                {{-- Update Form --}}
                <div class="card">
                    <div class="card-header">{{ trans('profile.title') }}</div>
                    <div class="card-body">
                        @if (auth()->guard('teacher')->check())
                            <form action="{{ route('teacher.profile.update', 'test') }}" method="POST"
                                enctype="multipart/form-data">
                            @elseif (auth()->guard('student')->check())
                                <form action="{{ route('student.profile.update', 'test') }}" method="POST"
                                    enctype="multipart/form-data">
                                @elseif (auth()->guard('parent')->check())
                                    <form action="{{ route('parent.profile.update', 'test') }}" method="POST"
                                        enctype="multipart/form-data">
                        @endif
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        @if (auth()->guard('parent')->check())
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('parent.fatherName') }}</label>
                                <input type="text" class="form-control" id="name" name="fatherNameEn"
                                    value="{{ old('fatherName', $user->getTranslation('fatherName', 'en')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('parent.fatherNameAr') }}</label>
                                <input type="text" class="form-control" id="name" name="fatherNameAr"
                                    value="{{ old('fatherName', $user->getTranslation('fatherName', 'ar')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('parent.motherName') }}</label>
                                <input type="text" class="form-control" id="name" name="motherNameEn"
                                    value="{{ old('motherName', $user->getTranslation('motherName', 'en')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('parent.motherNameAr') }}</label>
                                <input type="text" class="form-control" id="name" name="motherNameAr"
                                    value="{{ old('motherName', $user->getTranslation('motherName', 'ar')) }}" required>
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('profile.nameEn') }}</label>
                                <input type="text" class="form-control" id="name" name="nameEn"
                                    value="{{ old('name', $user->getTranslation('name', 'en')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('profile.nameAr') }}</label>
                                <input type="text" class="form-control" id="name" name="nameAr"
                                    value="{{ old('name', $user->getTranslation('name', 'ar')) }}" required>
                            </div>
                            {{-- Avatar --}}
                        @endif
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">{{ trans('profile.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="position-absolute eye">
                                <i class="fa-solid fa-eye open__eye d-none"></i>
                                <i class="fa-solid fa-eye-slash  close__eye"></i>
                            </div>
                        </div>

                        {{-- Email --}}
                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary">{{ trans('profile.updateBtn') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- define any js or script files specific to this view --}}
@section('js')
    <script>
        $(document).ready(function() {
            $('.close__eye').click(function() {
                $('.close__eye').addClass('d-none');
                $('.open__eye').removeClass('d-none');
                $('#password').attr('type', 'text');
            });

            $('.open__eye').click(function() {
                $('.open__eye').addClass('d-none');
                $('.close__eye').removeClass('d-none');
                $('#password').attr('type', 'password');
            })
        })
    </script>

@endsection
