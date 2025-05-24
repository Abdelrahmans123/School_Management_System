<div class="parentContent container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{ trans('message.AreYouSure') }}</h1>
        </div>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">{{ trans('parent.uploads') }}</label>
        <div class="form-group mb-2">
            <input type="file" wire:model="photos" accept="image/*" multiple>
            @error('photos.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-danger" wire:click="previous(2)">{{ trans('parent.previous') }}</button>
        @if ($updateMode)
            <button class="btn btn-success" wire:click="edit">{{ trans('message.submit') }}</button>
        @else
            <button class="btn btn-success" wire:click="submitForm">{{ trans('message.submit') }}</button>
        @endif
    </div>
