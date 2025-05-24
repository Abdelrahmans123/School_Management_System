<div class="parentContent container">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="email" class="form-control" wire:model="email" id="emailInput" placeholder="name@example.com">
                <label for="emailInput">{{trans('parent.email')}}</label>
                @error('email')
                <div class="alert alert-danger error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="password" class="form-control" wire:model="password" id="passwordInput" placeholder="name@example.com">
                <label for="passwordInput">{{trans('parent.password')}}</label>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @if($updateMode)
    <button class="btn btn-primary mt-4" wire:click="submitUpdateFirstStep">{{trans('parent.next')}}</button>
    @else
    <button class="btn btn-primary mt-4" wire:click="submitFirstStep">{{trans('parent.next')}}</button>
    @endif
</div>