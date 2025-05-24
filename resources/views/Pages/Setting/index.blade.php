@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.Settings'))

@section('headerTitle', trans('sidebar.Settings'))

@section('content')
    <!-- row -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>{{ trans('sidebar.Settings') }}</h5>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{ route('settings.update', 'test') }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <!-- Site Name -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('setting.siteName') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input name="site_name" value="{{ $setting['site_name'] }}" required type="text"
                                    class="form-control" placeholder="Name of Site">
                            </div>
                        </div>

                        <!-- Academic Year -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('student.academicYear') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select name="academic_year" id="current_session" class="form-control select-search"
                                    required>
                                    <option value="">{{ trans('student.chooseAcademicYear') }}</option>
                                    @for ($y = date('Y', strtotime('- 3 years')); $y <= date('Y', strtotime('+ 1 years')); $y++)
                                        <option
                                            {{ $setting['academic_year'] == ($y -= 1) . '-' . ($y += 1) ? 'selected' : '' }}>
                                            {{ ($y -= 1) . '-' . ($y += 1) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('parent.phone') }}</label>
                            <div class="col-md-8">
                                <input name="site_phone" value="{{ $setting['site_phone'] }}" type="text"
                                    class="form-control" placeholder="Phone">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('parent.email') }}</label>
                            <div class="col-md-8">
                                <input name="site_email" value="{{ $setting['site_email'] }}" type="email"
                                    class="form-control" placeholder="School Email">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('parent.address') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input name="site_address" value="{{ $setting['site_address'] }}" type="text" required
                                    class="form-control" placeholder="School Address">
                            </div>
                        </div>

                        <!-- First Term End -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('setting.firstTermEnd') }}</label>
                            <div class="col-md-8">
                                <input name="first_term_end" value="{{ $setting['first_term_end'] }}" type="text"
                                    class="form-control date-pick" placeholder="Date Term Ends">
                            </div>
                        </div>

                        <!-- Second Term End -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('setting.secondTermEnd') }}</label>
                            <div class="col-md-8">
                                <input name="second_term_end" value="{{ $setting['second_term_end'] }}" type="text"
                                    class="form-control date-pick" placeholder="Date Term Ends">
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="form-group row mb-2">
                            <label class="col-md-4 col-form-label">{{ trans('setting.logo') }}</label>
                            <div class="col-md-8">
                                <div class="mb-2">
                                    <img src="{{ URL::asset('Attachments/logo/' . $setting['site_logo']) }}"
                                        style="width: 100px; height: 100px;" alt="Logo">
                                </div>
                                <input name="site_logo" type="file" class="form-control-file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-lg">{{ trans('message.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
