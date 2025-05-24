<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('grade.editGrade')}}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('grade.update','test')}}" method="POST" class="needs-validation   @error('gradeAR') was-validated @enderror" novalidate >
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$item->id}}" name="gradeId">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control @error('gradeEn') is-invalid @enderror" id="validationCustom03" name="gradeEn" placeholder="trans('grade.gradeNameEn')" value="{{$item->getTranslation("name",'en')}}" required>
                                <label for="validationCustom03">{{trans('grade.gradeNameEn')}}</label>
                                @error('gradeEn')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control  @error('stageAr') is-invalid @enderror" id="validationCustomUsername" name="gradeAr"  placeholder="{{trans('grade.gradeNameAr')}}" value="{{$item->getTranslation("name",'ar')}}" required>
                                <label for="validationCustomUsername">{{trans('grade.gradeNameAr')}}</label>
                                @error('stageAr')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="stageId">
                                    @foreach($stage as $content)
                                        <option value="{{$content->id}}" {{$item->stage_id==$content->id?"selected":" "}}>{{$content->Name}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">{{trans('grade.stageName')}}</label>
                            </div>
                        </div>
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('message.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('message.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
