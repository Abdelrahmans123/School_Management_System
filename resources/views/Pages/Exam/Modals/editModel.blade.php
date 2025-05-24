{{-- /**
* Renders a modal dialog for editing an exam.
*
* The modal is displayed when the user clicks on the "Edit" button for an exam.
* It allows the user to update the name of the exam in English and Arabic, as well as
* the academic year and term.
*
* The modal is implemented using Bootstrap's modal component, and the form is submitted
* using a POST request to the `exam.store` route.
*
* @param int $item->id - The ID of the exam being edited.
*/ --}}
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('exam.edit') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.exam.update', 'test') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
					@method('PUT')
					<input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustom03" name="examEn"
                                    value="{{ $item->getTranslation('name', 'en') }}" required>
                                <label for="validationCustom03">{{ trans('exam.nameEn') }}</label>
                                @error('examEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername" name="examAr"
                                    value="{{ $item->getTranslation('name', 'ar') }}" required>
                                <label for="validationCustomUsername">{{ trans('exam.nameAr') }}</label>
                                @error('examAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6   has-validation">
                            <label for="academicYearInput">{{ trans('student.academicYear') }}</label>
                            <select name="academicYear" class="form-select" id="academicYearInput" required>
                                <option disabled>{{ trans('student.chooseAcademicYear') }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ $year == $item->academicYear ? 'selected' : '' }}>{{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('academicYear')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="number" class="form-control" id="validationCustomUsername" name="term"
                                    value="{{ $item->term }}" required>
                                <label for="validationCustomUsername">{{ trans('exam.term') }}</label>
                                @error('term')
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
