@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.AttendanceList'))


@section('headerTitle', trans('sidebar.AttendanceList'))

@section('content')
    <!-- row -->

    {{-- @if ($errors->any())
	@foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif --}}



    <div class="card">
        <div class="card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($stages as $stage)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $loop->iteration }}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                {{ $stage->name }}
                            </button>
                        </h2>
                        <div id="{{ $loop->iteration }}" class="accordion-collapse collapse  my-4"
                            data-bs-parent="#accordionFlushExample">
                            <table id="example{{ $loop->iteration }}" class="display" style="width:100%">
                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('section.sectionName') }}</th>
                                        <th>{{ trans('section.gradeName') }}</th>
                                        <th>{{ trans('section.status') }}</th>
                                        <th>{{ trans('section.stageOperation') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stage->section as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                {{ $item->grades->name }}
                                            </td>

                                            @if ($item->status == 1)
                                                <td><span
                                                        class="badge text-bg-success">{{ trans('section.active') }}</span>
                                                </td>
                                            @else
                                                <td><span
                                                        class="badge text-bg-danger">{{ trans('section.noActive') }}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('teacher.attendance.show', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa-solid fa-users-rectangle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    {{-- @include('Pages.Section.Modals.addModel') --}}

    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            @foreach ($stage as $item)
                $('#example{{ $loop->iteration }}').DataTable({
                    "language": lang,
                });
            @endforeach


        });
    </script>
    {{-- <script>
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
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const form = document.querySelector('#addModal .needs-validation')
        let text = document.querySelector('.invalid-feedback');
        const myModal = new bootstrap.Modal(document.getElementById('addModal'));
        const closeBtn = document.getElementById('closeBtn');
        // Loop over them and prevent submission


        if (text) {
            console.log(form)
            myModal.show();
            form.classList.add('was-validated')
        } else {
            form.classList.remove('was-validated')
        }
        closeBtn.addEventListener('click', function() {
            // Close the modal
            myModal.hide();
        });
    </script> --}}
@endsection
