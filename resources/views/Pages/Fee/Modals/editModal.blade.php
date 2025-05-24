<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('fee.edit') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fee.update','test') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustom03" name="titleEn"
                                    placeholder="{{ trans('fee.titleEn') }}"value="{{ $item->getTranslation('title', 'en') }}"
                                    required>
                                <label for="validationCustom03">{{ trans('fee.titleEn') }}</label>
                                @error('titleEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername" name="titleAR"
                                    placeholder="{{ trans('fee.titleAR') }}"
                                    value="{{ $item->getTranslation('title', 'ar') }}" required>
                                <label for="validationCustomUsername">{{ trans('fee.titleAR') }}</label>
                                @error('titleAR')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="number" class="form-control" id="validationCustom03" name="amount"
                                    min="1" placeholder="{{ trans('fee.amount') }}" value="{{ $item->amount }}"
                                    required>
                                <label for="validationCustom03">{{ trans('fee.amount') }}</label>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <select name="year" class="form-select" id="academicYearInput" required>
                                    <option selected disabled value="">{{ trans('fee.chooseYear') }}
                                    </option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}"
                                            {{ $year == $item->year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                <label for="validationCustomUsername">{{ trans('fee.year') }}</label>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating has-validation">
                                <select class="form-select" id="floatingSelect" name="stageId"
                                    aria-label="Floating label select example" required>
                                    <option disabled selected value="">{{ trans('section.selectStage') }}
                                    </option>
                                    @foreach ($stages as $stage)
                                        <option value="{{ $stage->id }}"
                                            {{ $stage->id == $item->stage_id ? 'selected' : '' }}>{{ $stage->Name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">{{ trans('fee.stageName') }}</label>
                                @error('stageId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <select class="form-select" id="grade" aria-label="Floating label select example"
                                    name="gradeId" required>
                                    <option value="{{ $item->grade_id }}">{{ $item->grades->name }}</option>
                                </select>
                                <label for="grade">{{ trans('section.gradeName') }}</label>
                                @error('gradeId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description"></textarea>
                        <label for="floatingTextarea">{{ trans('fee.description') }}</label>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="editCloseBtn">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

