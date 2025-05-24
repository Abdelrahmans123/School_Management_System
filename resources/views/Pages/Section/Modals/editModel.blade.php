<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">{{trans('section.editSection')}}</h1>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('section.update','test')}}" method="POST" class="needs-validation   @error('gradeAR') was-validated @enderror" novalidate >
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$item->id}}" name="sectionId">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control @error('sectionEn') is-invalid @enderror" id="validationCustom03" name="sectionEn" placeholder="{{trans('section.nameEn')}}" value="{{$item->getTranslation("name",'en')}}" required>
                                <label for="validationCustom03">{{trans('stage.nameEn')}}</label>
                                @error('sectionEn')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3 has-validation">
                                <input type="text" class="form-control  @error('sectionAr') is-invalid @enderror" id="validationCustomUsername" name="sectionAr"  placeholder="{{trans('section.nameAR')}}" value="{{$item->getTranslation("name",'ar')}}" required>
                                <label for="validationCustomUsername">{{trans('stage.nameAR')}}</label>
                                @error('sectionAr')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="stageId" onchange="console.log($(this).val())">
                            @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}" {{$stage->id==$item->stage_id?"selected":" "}}>{{ $stage->Name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">{{trans('section.stageName')}}</label>
                    </div>
                    <div class="form-floating mt-2 mb-2">
                        <select class="form-select" id="grade" aria-label="Floating label select example" name="gradeId">
                            <option value="{{$item->grade_id}}">{{$item->grades->name}}</option>
                        </select>
                        <label for="grade">{{trans('section.gradeName')}}</label>
                    </div>
                    <div class="form-floating">
                        <select multiple class="form-select" id="floatingSelect" aria-label="Floating label select example" name="teachersId[]">
                            @foreach ($item->teachers as $teacher)
                            <option selected value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">{{trans('section.teacherName')}}</label>
                    </div>

                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{$item->status==1?"checked":""}} name="status">
                        <label class="form-check-label" for="flexSwitchCheckDefault">{{trans('section.status')}}</label>
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
