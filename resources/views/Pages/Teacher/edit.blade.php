@extends('layouts.master')
@section('css')
@endsection
@section('title',
trans('teacher.edit'))


@section('headerTitle',trans('teacher.edit'))

@section('content')
    <!-- row -->
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('teacher.update', 'test') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $teacher->id }}" name="teacherId">
                    <div class="row">
                        <div class="col-lg-6 mt-4 has-validation">
                            <label for="emailInput">{{ trans('teacher.email') }}</label>
                            <input type="email" class="form-control" name="email" id="emailInput" value="{{ $teacher->email }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-4 has-validation">
                            <label for="passwordInput">{{ trans('teacher.password') }}</label>
                            <input type="password" class="form-control" name="password" id="passwordInput" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 has-validation">
                            <label for="nameEnInput">{{ trans('teacher.nameEn') }}</label>
                            <input type="text" class="form-control" name="nameEn" id="nameEnInput" value="{{ $teacher->getTranslation('name', 'en') }}" required>
                            @error('nameEn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 has-validation">
                            <label for="nameArInput">{{ trans('teacher.nameAr') }}</label>
                            <input type="text" class="form-control" name="nameAr" id="nameArInput" value="{{ $teacher->getTranslation('name', 'ar') }}" required>
                            @error('nameAr')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 has-validation">
                            <label for="specializeIdInput">{{ trans('teacher.specialize') }}</label>
                            <select name="specializeId" class="form-select" id="specializeIdInput">
                                <option selected disabled>{{ trans('teacher.chooseSpecialize') }}</option>
                                @foreach ($specialize as $item )
                                    <option value="{{ $item->id }}" {{ $teacher->specialization_id == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('specializeId')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-5 has-validation">
                            <label for="genderIdInput">{{ trans('teacher.gender') }}</label>
                            <select name="genderId" class="form-select" id="genderIdInput">
                                <option selected disabled>{{ trans('teacher.chooseGender') }}</option>
                                @foreach ($gender as $item )
                                    <option value="{{ $item->id }}" {{ $teacher->gender_id == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('genderId')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-5 has-validation">
                            <label for="joinDateInput">{{ trans('teacher.joinDate') }}</label>
                            <input type="date" class="form-control" name="joinDate" id="joinDateInput" value="{{ $teacher->joiningDate }}" required>
                            @error('joinDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-5 has-validation">
                            <label for="addressInput">{{ trans('teacher.address') }}</label>
                            <textarea name="address" id="addressInput" cols="30" rows="10" class="form-control">{{ $teacher->address }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mt-5 ">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

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
@endsection
