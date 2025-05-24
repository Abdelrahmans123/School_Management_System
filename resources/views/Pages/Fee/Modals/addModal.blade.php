<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('fee.add') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fee.store') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustom03" name="titleEn"
                                    placeholder="{{ trans('fee.titleEn') }}" required>
                                <label for="validationCustom03">{{ trans('fee.titleEn') }}</label>
                                @error('titleEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername" name="titleAR"
                                    placeholder="{{ trans('fee.titleAR') }}" required>
                                <label for="validationCustomUsername">{{ trans('fee.titleAR') }}</label>
                                @error('titleAR')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="number" class="form-control" id="validationCustom03" name="amount"
                                    min="1" placeholder="{{ trans('fee.amount') }}" required>
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
                                        <option value="{{ $year }}">{{ $year }}</option>
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
                                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
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
                                </select>
                                <label for="grade">{{ trans('section.gradeName') }}</label>
                                @error('gradeId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <div class="form-floating has-validation">
                                <select class="form-select" id="floatingSelect" name="feeType"
                                    aria-label="Floating label select example" required>
									<option value="" selected disabled>{{ trans('fee.selectFee') }}</option>
									<option value="1">{{ trans('fee.schoolFee') }}</option>
									<option value="2">{{ trans('fee.busFee') }}</option>
                                </select>
                                <label for="floatingSelect">{{ trans('fee.feeType') }}</label>
                                @error('feeType')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
						<div class="col-12">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description"></textarea>
								<label for="floatingTextarea">{{ trans('fee.description') }}</label>
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
