<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('exam.add') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.exam.store') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustom03" name="examEn"
                                    placeholder="{{ trans('exam.nameEn') }}" required>
                                <label for="validationCustom03">{{ trans('exam.nameEn') }}</label>
                                @error('examEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername" name="examAr"
                                    placeholder="{{ trans('exam.nameAr') }}" required>
                                <label for="validationCustomUsername">{{ trans('exam.nameAr') }}</label>
                                @error('examAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6   has-validation">
                            <label for="academicYearInput">{{ trans('student.academicYear') }}</label>
                            <select name="academicYear" class="form-select" id="academicYearInput" required>
                                <option selected disabled value="">{{ trans('student.chooseAcademicYear') }}
                                </option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            @error('academicYear')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="number" class="form-control" id="validationCustomUsername" name="term"
                                    placeholder="{{ trans('exam.term') }}" required>
                                <label for="validationCustomUsername">{{ trans('exam.term') }}</label>
                                @error('examAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="closeBtn">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
