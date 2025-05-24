<div class="parentContent container">
    <div class="row">
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="nameEnInput" wire:model="motherNameEn" placeholder="name@example.com">
                <label for="nameEnInput">{{trans('parent.motherNameEn')}}</label>
                @error('motherNameEn')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="nameArInput" wire:model="motherNameAr" placeholder="name@example.com">
                <label for="nameArInput">{{trans('parent.motherNameAr')}}</label>
                @error('motherNameAr')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="jobEnInput"  wire:model="motherJobEn" placeholder="name@example.com">
                <label for="jobEnInput">{{trans('parent.motherJobEn')}}</label>
                @error('motherJobEn')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="jobArInput" wire:model="motherJobAr" placeholder="name@example.com">
                <label for="jobArInput">{{trans('parent.motherJobAr')}}</label>
                @error('motherJobAr')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="idNumberInput" wire:model="motherIdNumber" placeholder="name@example.com">
                <label for="idNumberInput">{{trans('parent.IdNumber')}}</label>
                @error('motherIdNumber')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="passportNumberInput" wire:model="motherPassportNumber" placeholder="name@example.com">
                <label for="passportNumberInput">{{trans('parent.PassportNumber')}}</label>
                @error('motherPassportNumber')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 mt-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="phoneInput" wire:model="motherPhone" placeholder="name@example.com">
                <label for="phoneInput">{{trans('parent.phone')}}</label>
                @error('motherPhone')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="form-floating">
                <select class="form-select" id="nationalitySelect" wire:model="motherNationality" aria-label="Floating label select example">
                    <option selected >{{trans('parent.chooseNationality')}}</option>
                    @foreach($nationalities as $nationality)
                        <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                    @endforeach
                </select>
                <label for="nationalitySelect">{{trans('parent.nationality')}}</label>
                @error('motherNationality')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <select class="form-select" id="bloodTypeSelect" wire:model="motherBloodType" aria-label="Floating label select example">
                    <option   selected >{{trans('parent.chooseBloodType')}}</option>
                    @foreach($bloodTypes as $bloodType)
                        <option value="{{$bloodType->id}}">{{$bloodType->type}}</option>
                    @endforeach
                </select>
                <label for="bloodTypeSelect">{{trans('parent.bloodType')}}</label>
                @error('motherBloodType')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 mt-4">
            <div class="form-floating">
                <select class="form-select" id="religionSelect"  wire:model="motherReligion" aria-label="Floating label select example">
                    <option selected >{{trans('parent.chooseReligion')}}</option>
                    @foreach($religions as $religion)
                        <option value="{{$religion->id}}">{{$religion->name}}</option>
                    @endforeach
                </select>
                <label for="religionSelect">{{trans('parent.religion')}}</label>
                @error('motherReligion')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="form-floating mb-4">
                <textarea class="form-control"  wire:model="motherAddress" placeholder="Leave a comment here" id="addressTextarea" style="height: 100px"></textarea>
                <label for="addressTextarea">{{trans('parent.address')}}</label>
                @error('motherAddress')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button class="btn btn-danger" wire:click="previous(1)">{{trans('parent.previous')}}</button>
    @if ($updateMode)
    <button class="btn btn-primary" wire:click="submitUpdateThirdStep">{{trans('parent.next')}}</button>
    @else
    <button class="btn btn-primary" wire:click="submitThirdStep">{{trans('parent.next')}}</button>
    @endif
</div>