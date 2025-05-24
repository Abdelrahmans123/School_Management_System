@extends('layouts.master')
@section('css')
@endsection
@section('title',
trans('sidebar.StageList'))


@section('headerTitle',trans('sidebar.StageList'))

@section('content')
    <!-- row -->
    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                {{trans('stage.add')}}
            </button>
        </div>

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('stage.stageName')}}</th>
                    <th>{{trans('stage.stageNote')}}</th>
                    <th>{{trans('stage.stageOperation')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stage as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->Name}}</td>
                        @if($item->Notes!=null)
                            <td>{{$item->Notes}}</td>
                        @else
                            <td><span class="badge text-bg-danger">{{trans('message.noNotes')}}</span></td>

                        @endif
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{$item->id}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{$item->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('Pages.Stage.Modals.editModel')
                    @include('Pages.Stage.Modals.deleteModel')
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('Pages.Stage.Modals.addModel')

    <!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
        });
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
        closeBtn.addEventListener('click', function () {
            // Close the modal
            myModal.hide();
        });

    </script>
@endsection
