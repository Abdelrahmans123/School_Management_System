@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.editFee'))


@section('headerTitle', trans('sidebar.editFee'))

@section('content')
    <div class="">
        <div class="">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach

            @endif
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form class=" row " action="{{ route('invoice.update', 'test') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $feeInvoice->id }}">
                        <div class="card-body">
                            <div class="repeater">
                                <div>
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('student.studentName') }}</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="studentId">
                                                        <option value="{{ $feeInvoice->student_id }}">
                                                            {{ $feeInvoice->students->name }}</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('fee.feeType') }}</label>
                                                <div class="box">
                                                    <select class="form-select feeTypeSelect"
                                                        aria-label="Default select example" name="feeType">
                                                        <option disabled value="" selected>
                                                            {{ trans('fee.selectFeeType') }}</option>
                                                        @foreach ($fee as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $feeInvoice->fee_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('fee.amount') }}</label>
                                                <div class="box">
                                                    <select class="form-select amountSelect"
                                                        aria-label="Default select example" name="amount">

                                                        {{ trans('fee.selectAmount') }}</option>
                                                        <option value="{{ $feeInvoice->amount }}">
                                                            {{ $feeInvoice->amount }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description"
                                                    class="mr-sm-2">{{ trans('fee.description') }}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description"
                                                        value="{{ $feeInvoice->description }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="stageId" value="{{ $feeInvoice->stage_id }}">
                                <input type="hidden" name="gradeId" value="{{ $feeInvoice->grade_id }}">

                                <button type="submit" class="btn btn-primary mt-3">{{ trans('message.submit') }}</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Selecting the parent element to delegate the event
            const form = document.querySelector('form');

            // Event listener for changes in feeTypeSelect
            form.addEventListener('change', function(event) {
                if (event.target.classList.contains('feeTypeSelect')) {
                    const feeId = event.target.value;
                    const amountSelect = event.target.closest('.row').querySelector('.amountSelect');

                    // Creating an AJAX request
                    const xhttpRequest = new XMLHttpRequest();

                    xhttpRequest.onload = function() {
                        if (this.status === 200) {
                            const res = JSON.parse(this.responseText);
                            amountSelect.innerHTML = ''; // Clear existing options

                            const option = document.createElement('option');
                            option.value = res.amount;
                            option.textContent = res.amount;
                            amountSelect.appendChild(option);
                        } else {
                            console.error('Error fetching data');
                        }
                    };

                    xhttpRequest.open('GET', `{{ $url }}/${feeId}`);
                    xhttpRequest.send();
                }
            });

            // Adding new input rows
            const addInputBtn = document.querySelector('.addInputBtn');
            addInputBtn.addEventListener('click', function() {
                const newInputs = document.querySelectorAll('.feeTypeSelect');
                newInputs.forEach(input => {
                    input.addEventListener('change', function(event) {
                        const feeId = event.target.value;
                        const amountSelect = event.target.closest('.row').querySelector(
                            '.amountSelect');

                        const xhttpRequest = new XMLHttpRequest();

                        xhttpRequest.onload = function() {
                            if (this.status === 200) {
                                const res = JSON.parse(this.responseText);
                                amountSelect.innerHTML = '';

                                const option = document.createElement(
                                    'option');
                                option.value = res.amount;
                                option.textContent = res.amount;
                                amountSelect.appendChild(option);
                            } else {
                                console.error('Error fetching data');
                            }
                        };

                        xhttpRequest.open('GET', `{{ $url }}/${feeId}`);
                        xhttpRequest.send();
                    });
                });
            });
        });
    </script>


@endsection
