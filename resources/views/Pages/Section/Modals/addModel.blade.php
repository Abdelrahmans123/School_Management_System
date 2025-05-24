<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('section.add') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('section.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustom03" name="sectionEn"
                                    placeholder="{{ trans('section.nameEn') }}" required>
                                <label for="validationCustom03">{{ trans('section.nameEn') }}</label>
                                @error('sectionEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="validationCustomUsername"
                                    name="sectionAr" placeholder="{{ trans('section.nameAR') }}" required>
                                <label for="validationCustomUsername">{{ trans('section.nameAR') }}</label>
                                @error('sectionAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating has-validation">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="stageId" required>
                            <option disabled selected value="">{{ trans('section.selectStage') }}</option>
                            @foreach ($stages as $item)
                                <option value="{{ $item->id }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">{{ trans('section.stageName') }}</label>
                        @error('stageId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mt-2 mb-2">
                        <select class="form-select" id="grade" aria-label="Floating label select example"
                            name="gradeId" required>
                        </select>
                        <label for="grade">{{ trans('section.gradeName') }}</label>
                        @error('gradeId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <select multiple class="form-select" id="floatingSelectTeachers"
                            aria-label="Floating label select example" name="teachersId[]" required>
                            @foreach ($teachers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelectTeachers">{{ trans('section.teacherName') }}</label>
                        @error('teachersId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
