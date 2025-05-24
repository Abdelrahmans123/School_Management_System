<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('grade.add') }}
                </h5>
                <button type="button" class="btn-close modelClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30 needs-validation" novalidate action="{{ route('grade.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="grades">
                                <div data-repeater-item>
                                    <div class="container">
                                        <div class="row">

                                            <div class="col has-validation">
                                                <label for="Name" class="mr-sm-2">{{ trans('grade.gradeNameEn') }}
                                                    :</label>
                                                <input class="form-control  @error('gradeEn') is-invalid @enderror"
                                                    type="text" name="gradeEn" required />
                                                @error('grades.*.gradeEn')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col has-validation">
                                                <label for="Name" class="mr-sm-2">{{ trans('grade.gradeNameAr') }}
                                                    :</label>
                                                <input class="form-control  @error('gradeAr') is-invalid @enderror"
                                                    type="text" name="gradeAr" required />
                                                @error('grades.*.gradeAr')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col has-validation">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('grade.stageName') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="form-select" name="stageId">
                                                        @foreach ($stage as $item)
                                                            <option value="{{ $item->id }}">{{ $item->Name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('grade.gradeOperation') }}
                                                    :</label>
                                                <br>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ trans('grade.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <input class="btn btn-info" data-repeater-create type="button"
                                        value="{{ trans('grade.addInput') }}" />
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    id="closeBtn">{{ trans('message.close') }}</button>
                                <button type="submit"
                                    class="btn btn-primary submitBtn">{{ trans('message.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>
