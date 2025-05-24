<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('subject.add') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subject.store') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="teacherSelect"
                                    aria-label="Floating label select example" name="teacherId" required>
                                    <option disabled selected value="">{{ trans('subject.selectTeacher') }}
                                    </option>
                                    @foreach ($teachers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectTeachers">{{ trans('section.teacherName') }}</label>
                                @error('teachersId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="subjectEn" name="subjectEn"
                                    placeholder="{{ trans('subject.nameEn') }}" required>
                                <label for="subjectEn">{{ trans('subject.nameEn') }}</label>
                                @error('subjectEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="subjectAr" name="subjectAr"
                                    placeholder="{{ trans('subject.nameAr') }}" required>
                                <label for="subjectAr">{{ trans('subject.nameAr') }}</label>
                                @error('subjectAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating has-validation">
                        <select class="form-select" id="stageSelect" aria-label="Floating label select example"
                            name="stageId" required>
                            <option disabled selected value="">{{ trans('section.selectStage') }}</option>
                            @foreach ($stages as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
