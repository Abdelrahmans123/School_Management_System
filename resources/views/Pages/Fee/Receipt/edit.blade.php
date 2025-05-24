@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('student.editReceipt'))


@section('headerTitle', trans('student.editReceipt'))

@section('content')
    <div class="">
        <div class="">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form class=" row  needs-validation" novalidate action="{{ route('receipt.update', 'test') }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $receipt->id }}">
                        <div class="card-body">
                            <div class="repeater">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3 has-validation">
                                            <input type="number" class="form-control" id="validationCustom03"
                                                name="amount" min="1" value="{{ $receipt->debit }}" required>
                                            <label for="validationCustom03">{{ trans('fee.amount') }}</label>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 has-validation">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description">{{ $receipt->description }}</textarea>
                                            <label for="floatingTextarea">{{ trans('fee.description') }}</label>
                                        </div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')
    <script>
        const form = document.querySelector('.needs-validation')
        let text = document.querySelector('.invalid-feedback');
        if (text) {
            form.classList.add('was-validated')
        } else {
            form.classList.remove('was-validated')
        }
    </script>

@endsection
