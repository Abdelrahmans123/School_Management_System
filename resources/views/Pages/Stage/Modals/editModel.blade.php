<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('stage.editStage') }}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stage.update', 'test') }}" method="POST"
                    class="needs-validation   @error('gradeAR') was-validated @enderror" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $item->id }}" name="stageId">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control @error('stageEn') is-invalid @enderror"
                                    id="validationCustom03" name="stageEn" placeholder="{{ trans('grade.nameEn') }}"
                                    value="{{ $item->getTranslation('Name', 'en') }}" required>
                                <label for="validationCustom03">{{ trans('stage.nameEn') }}</label>
                                @error('stageEn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control  @error('stageAr') is-invalid @enderror"
                                    id="validationCustomUsername" name="stageAr"
                                    placeholder="{{ trans('grade.nameAR') }}"
                                    value="{{ $item->getTranslation('Name', 'ar') }}" required>
                                <label for="validationCustomUsername">{{ trans('stage.nameAR') }}</label>
                                @error('stageAr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="note">{{ $item->Notes }}</textarea>
                        <label for="floatingTextarea">{{ trans('stage.note') }}</label>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('message.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
