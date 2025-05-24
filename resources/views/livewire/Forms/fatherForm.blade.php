<div class="parentContent container">
    <div class="row">
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="nameEnInput" wire:model="fatherNameEn" placeholder="name@example.com">
                <label for="nameEnInput">{{trans('parent.fatherNameEn')}}</label>
                @error('fatherNameEn')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="nameArInput" wire:model="fatherNameAr" placeholder="name@example.com">
                <label for="nameArInput">{{trans('parent.fatherNameAr')}}</label>
                @error('fatherNameAr')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="jobEnInput"  wire:model="fatherJobEn" placeholder="name@example.com">
                <label for="jobEnInput">{{trans('parent.fatherJobEn')}}</label>
                @error('fatherJobEn')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="jobArInput" wire:model="fatherJobAr" placeholder="name@example.com">
                <label for="jobArInput">{{trans('parent.fatherJobAr')}}</label>
                @error('fatherJobAr')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="idNumberInput" wire:model="fatherIdNumber" placeholder="name@example.com">
                <label for="idNumberInput">{{trans('parent.IdNumber')}}</label>
                @error('fatherIdNumber')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="passportNumberInput" wire:model="fatherPassportNumber" placeholder="name@example.com">
                <label for="passportNumberInput">{{trans('parent.PassportNumber')}}</label>
                @error('fatherPassportNumber')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="phoneInput" wire:model="fatherPhone" placeholder="name@example.com">
                <label for="phoneInput">{{trans('parent.phone')}}</label>
                @error('fatherPhone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <select class="form-select" id="nationalitySelect" wire:model="fatherNationality" aria-label="Floating label select example">
                    <option selected  >{{trans('parent.chooseNationality')}}</option>
                    @foreach($nationalities as $nationality)
                        <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                    @endforeach
                </select>
                <label for="nationalitySelect">{{trans('parent.nationality')}}</label>
                @error('fatherNationality')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <select class="form-select" id="bloodTypeSelect" wire:model="fatherBloodType" aria-label="Floating label select example">
                    <option selected>{{trans('parent.chooseBloodType')}}</option>
                    @foreach($bloodTypes as $bloodType)
                        <option value="{{$bloodType->id}}">{{$bloodType->type}}</option>
                    @endforeach
                </select>
                <label for="bloodTypeSelect">{{trans('parent.bloodType')}}</label>
                @error('fatherBloodType')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <select class="form-select" id="religionSelect"  wire:model="fatherReligion" aria-label="Floating label select example">
                    <option selected>{{trans('parent.chooseReligion')}}</option>
                    @foreach($religions as $religion)
                        <option value="{{$religion->id}}">{{$religion->name}}</option>
                    @endforeach
                </select>
                <label for="religionSelect">{{trans('parent.religion')}}</label>
                @error('fatherReligion')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="form-floating mb-4">
                <textarea class="form-control"  wire:model="fatherAddress" placeholder="Leave a comment here" id="addressTextarea" style="height: 100px"></textarea>
                <label for="addressTextarea">{{trans('parent.address')}}</label>
                @error('fatherAddress')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button class="btn btn-danger" wire:click="previous(0)">{{trans('parent.previous')}}</button>
    @if ($updateMode)
    <button class="btn btn-primary" wire:click="submitUpdateSecondStep">{{trans('parent.next')}}</button>
    @else
    <button class="btn btn-primary" wire:click="submitSecondStep">{{trans('parent.next')}}</button>
    @endif
</div>
