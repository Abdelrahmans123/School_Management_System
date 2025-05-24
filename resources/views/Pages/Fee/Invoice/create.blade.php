@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.addFee'))


@section('headerTitle', trans('sidebar.addFee'))

@section('content')
    <div class="">
        <div class="">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form class=" row  needs-validation" novalidate action="{{ route('invoice.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="feesList">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col has-validation">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('student.studentName') }}</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="studentId" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                                @error('feesList.*.studentId')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col has-validation">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('fee.feeType') }}</label>
                                                <div class="box">
                                                    <select class="form-select feeTypeSelect"
                                                        aria-label="Default select example" name="feeType" required>
                                                        <option disabled value="" selected>
                                                            {{ trans('fee.selectFeeType') }}</option>
                                                        @foreach ($fee as $item)
                                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('feesList.*.feeType')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col has-validation">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('fee.amount') }}</label>
                                                <div class="box">
                                                    <select class="form-select amountSelect"
                                                        aria-label="Default select example" name="amount" required>
                                                        <option disabled value="" selected>
                                                            {{ trans('fee.selectAmount') }}</option>
                                                    </select>
                                                    @error('feesList.*.amount')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col has-validation">
                                                <label for="description"
                                                    class="mr-sm-2">{{ trans('fee.description') }}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description">
                                                </div>
                                                @error('feesList.*.description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('grade.gradeOperation') }}:</label>
                                                <br />
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                    value="{{ trans('grade.delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <input class="btn btn-success mt-3 addInputBtn" data-repeater-create type="button"
                                            value="{{ trans('grade.addInput') }}" />
                                    </div>
                                </div><br>
                                <input type="hidden" name="stageId" value="{{ $student->stage_id }}">
                                <input type="hidden" name="gradeId" value="{{ $student->grade_id }}">

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
        document.addEventListener('DOMContentLoaded', function() {
            // Selecting the parent element to delegate the event
            const form = document.querySelector('form');
            const feeTypeSelect = document.querySelector('.feeTypeSelect');
            // Event listener for changes in feeTypeSelect
            feeTypeSelect.addEventListener('change', function(event) {
                if (event.target.classList.contains('feeTypeSelect')) {
                    const feeId = event.target.value;
                    console.log("🚀 ~ form.addEventListener ~ feeId:", feeId)
                    const amountSelect = event.target.closest('.row').querySelector('.amountSelect');

                    // Creating an AJAX request
                    const xhttpRequest = new XMLHttpRequest();

                    xhttpRequest.onload = function() {
                        if (this.status === 200) {
                            const res = JSON.parse(this.responseText);
                            console.log("🚀 ~ form.addEventListener ~ res:", res)
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
