<div>
    @if (!empty($successMessage))
        <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
            {{ $successMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (!empty($errorMessage))
    <div class="alert alert-danger d-flex align-items-center errMsg" role="alert">
        {{ $errorMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($showTable)
@include('livewire.Table.index')
@else

    <div class="d-flex justify-content-around">
        <div class="paginations">
            <div class="ball {{ $step == 0 ? 'active' : '' }} {{ $step != 0 ? 'success' : '' }}"></div>
            <p>{{ trans('parent.generalInfo') }}</p>
        </div>
        <div class="paginations">
            <div class="ball {{ $step == 1 ? 'active' : '' }} {{ $step != 1 && $step != 0 ? 'success' : '' }}"></div>
            <p>{{ trans('parent.fatherInfo') }}</p>
        </div>
        <div class="paginations">
            <div class="ball {{ $step == 2 ? 'active' : '' }} {{ $step != 2 && $step != 1 && $step != 0 ? 'success' : '' }}"></div>
            <p>{{ trans('parent.motherInfo') }}</p>
        </div>
        <div class="paginations">
            <div class="ball {{ $step == 3 ? 'active' : '' }}"></div>
            <p>{{ trans('parent.uploads').' & '.trans('parent.infoConfirm') }}</p>
        </div>
    </div>
    @switch($step)
        @case(0)
            @include('livewire.Forms.securityForm')
        @break

        @case(1)
            @include('livewire.Forms.fatherForm')
        @break

        @case(2)
            @include('livewire.Forms.motherForm')
        @break

        @case(3)
            @include('livewire.Forms.confirmInformation')
        @break

        @default
            <!-- Handle default case here if needed -->
    @endswitch
@endif

</div>
