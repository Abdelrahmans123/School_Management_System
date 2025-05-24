@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('teacher.add'))


@section('headerTitle', trans('teacher.add'))

@section('content')
    <!-- row -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('teacher.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mt-4  has-validation">
                            <label for="emailInput">{{ trans('teacher.email') }}</label>
                            <input type="email" class="form-control" name="email" id="emailInput" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-4  has-validation">
                            <label for="passwordInput">{{ trans('teacher.password') }}</label>
                            <input type="password" class="form-control" name="password" id="passwordInput" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5  has-validation">
                            <label for="nameEnInput">{{ trans('teacher.nameEn') }}</label>
                            <input type="text" class="form-control" name="nameEn" id="nameEnInput" required>
                            @error('nameEn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5  has-validation">
                            <label for="nameArInput">{{ trans('teacher.nameAr') }}</label>
                            <input type="text" class="form-control" name="nameAr" id="nameArInput" required>
                            @error('nameAr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5  has-validation">
                            <label for="specializeIdInput">{{ trans('teacher.specialize') }}</label>
                            <select name="specializeId" class="form-select" id="specializeIdInput" required>
                                <option selected disabled value="">{{ trans('teacher.chooseSpecialize') }}</option>
                                @foreach ($specialize as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('specializeId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5  has-validation">
                            <label for="genderIdInput">{{ trans('teacher.gender') }}</label>
                            <select name="genderId" class="form-select" id="genderIdInput" required>
                                <option selected disabled value="">{{ trans('teacher.chooseGender') }}</option>
                                @foreach ($gender as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('genderId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-5  has-validation">

							<label for="joinDateInput">{{ trans('teacher.joinDate') }}</label>
                            <input type="text" class="form-control" name="joinDate" id="joinDateInput" required>
                            @error('joinDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-5  has-validation">
                            <label for="addressInput">{{ trans('teacher.address') }}</label>
                            <textarea name="address" id="addressInput" cols="30" rows="10" class="form-control" required></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-5">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- @include('Pages.Stage.Modals.addModel') --}}

    <!-- row closed -->
@endsection
@section('js')

    <script>
        const form = document.querySelector('.needs-validation')
        let text = document.querySelector('.invalid-feedback');
        if (text) {
            form.classList.add('was-validated')
        } else {
            form.classList.remove('was-validated')
        }
    </script>
	<script>
        $(function() {
            $("#joinDateInput").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
@endsection
