<!-- row -->

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach

@endif




<div class="card">
    <div class="container mt-3">
        <div class="row">
            <div class="col-4">
                <button type="button" class="btn btn-primary" wire:click="showAddForm">
                    {{ trans('sidebar.addParent') }}
                </button>
            </div>
        </div>
    </div>


    <div class="card-body">
        <h1 class="text-primary">{{ trans('parent.fatherInfo') }}</h1>
        <table id="fatherTable" class="display" style="width:100%;margin-bottom:10px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('parent.fatherName') }}</th>
                    <th>{{ trans('parent.fatherJob') }}</th>
                    <th>{{ trans('parent.IdNumber') }}</th>
                    <th>{{ trans('parent.PassportNumber') }}</th>
                    <th>{{ trans('parent.phone') }}</th>
                    <th>{{ trans('parent.address') }}</th>
                    <th>{{ trans('parent.processess') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guardians as $guardian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $guardian->fatherName }}</td>
                        <td>{{ $guardian->fatherJob }}</td>
                        <td>{{ $guardian->fatherIdNumber }}</td>
                        <td>{{ $guardian->fatherPassportNumber }}</td>
                        <td>{{ $guardian->fatherPhone }}</td>
                        <td>{{ $guardian->fatherAddress }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"
                                wire:click='editForm({{ $guardian->id }})'>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $guardian->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('livewire.Modals.deleteModal')
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <h1 class="text-primary">{{ trans('parent.motherInfo') }}</h1>

        <table id="motherTable" class="display" style="width:100%; ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('parent.motherName') }}</th>
                    <th>{{ trans('parent.motherJob') }}</th>
                    <th>{{ trans('parent.IdNumber') }}</th>
                    <th>{{ trans('parent.PassportNumber') }}</th>
                    <th>{{ trans('parent.phone') }}</th>
                    <th>{{ trans('parent.address') }}</th>
                    <th>{{ trans('parent.processess') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guardians as $guardian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $guardian->motherName }}</td>
                        <td>{{ $guardian->motherJob }}</td>
                        <td>{{ $guardian->motherIdNumber }}</td>
                        <td>{{ $guardian->motherPassportNumber }}</td>
                        <td>{{ $guardian->motherPhone }}</td>
                        <td>{{ $guardian->motherAddress }}</td>
                        <td> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





