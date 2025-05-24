@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.Fee'))


@section('headerTitle', trans('sidebar.FeeList'))

@section('content')
    <!-- row -->

    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                {{ trans('fee.add') }}
            </button>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('fee.title') }}</th>
                        <th>{{ trans('fee.amount') }}</th>
                        <th>{{ trans('fee.stageName') }}</th>
                        <th>{{ trans('fee.gradeName') }}</th>
                        <th>{{ trans('fee.description') }}</th>
                        <th>{{ trans('fee.year') }}</th>
                        <th>{{ trans('fee.type') }}</th>
                        <th>{{ trans('stage.stageOperation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->stages->Name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>
                                @if ($item->description == null)
                                    <span class="badge text-bg-danger">{{ trans('message.noNotes') }}</span>
                                @else
                                    {{ $item->description }}
                                @endif
                            </td>
                            <td>{{ $item->year }}</td>
                            <td>
                                @if ($item->type == 1)
                                    {{ trans('fee.schoolFee') }}
                                @else
                                    {{ trans('fee.busFee') }}
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Pages.Fee.Modals.editModal')
                        @include('Pages.Fee.Modals.deleteModal')
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('Pages.Fee.Modals.addModal')

    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
        });
    </script>
    <script>
        let stageSelect = document.querySelectorAll('select[name="stageId"]');

        let gradeSelect = document.querySelectorAll('#grade');
        const direction = document.body;
        for (let i = 0; i < stageSelect.length; i++) {
            stageSelect[i].addEventListener('change', (event) => {

                let stageId = event.target.value;
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    let res = JSON.parse(this.response);
                    console.log(res)
                    for (let j = 0; j < gradeSelect.length; j++) {
                        $(gradeSelect[j]).empty();
                        for (let k = 0; k < res.length; k++) {
                            let option = document.createElement("option");
                            option.value = res[k].id;
                            let text;
                            @if (App::getLocale() == 'ar')
                                text = document.createTextNode(res[k].name.ar);
                            @else
                                text = document.createTextNode(res[k].name.en);
                            @endif
                            option.appendChild(text);
                            gradeSelect[j].appendChild(option);
                        }
                    }
                }
                xhttp.open("GET", `{{ $url }}/` + stageId);
                xhttp.send();
            })
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle form validation and modal display
            const handleModalValidation = (modalId) => {
                const modalElement = document.getElementById(modalId);
                const modal = new bootstrap.Modal(modalElement);
                const form = modalElement.querySelector('.needs-validation');
                const closeBtn = modalElement.querySelector('.btn-close');
                const invalidFeedback = modalElement.querySelector('.invalid-feedback');
                // Add event listener for close button
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        modal.hide();
                    });
                }

                // Handle form submission validation
                console.log("🚀 ~ form.addEventListener ~ invalidFeedback:", invalidFeedback)
                if (invalidFeedback) {
                    modal.show(); // Show the modal if there are validation errors
                    form.classList.add('was-validated');
                }
            };

            // Initialize validation for add modal
            handleModalValidation('addModal');

            // Initialize validation for each edit modal
            document.querySelectorAll('[id^="editModal"]').forEach(function(editModalElement) {
                handleModalValidation(editModalElement.id);
            });
        });
    </script>

@endsection
