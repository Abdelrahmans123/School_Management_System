<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('stage.editStage') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subject.update', 'test') }}" method="POST" class="needs-validation " novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="teacherSelectEdit"
                                    aria-label="Floating label select example" name="teacherId" required>
                                    <option disabled selected value="">{{ trans('subject.selectTeacher') }}
                                    </option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $teacher->id == $item->teacher_id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectTeachers">{{ trans('section.teacherName') }}</label>
                                @error('teacherId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="subjectEnEdit" name="subjectEn"
                                    value="{{ $item->getTranslation('name', 'en') }}" required>
                                <label for="subjectEnEdit">{{ trans('subject.nameEn') }}</label>
                                @error('subjectEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control" id="subjectArEdit" name="subjectAr"
                                    value="{{ $item->getTranslation('name', 'ar') }}" required>
                                <label for="subjectArEdit">{{ trans('subject.nameAr') }}</label>
                                @error('stageAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating has-validation">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="stageId" required>
                            <option disabled selected value="">{{ trans('section.selectStage') }}</option>
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}"
                                    {{ $stage->id == $item->stage_id ? 'selected' : '' }}>
                                    {{ $stage->Name }}</option>
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
                            <option value="{{ $item->grade_id }}">{{ $item->grades->name }}</option>
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
