@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.studentList'))


@section('headerTitle', trans('sidebar.studentList'))


@section('content')
    <!-- row -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

    @endif




    <div class="card">


        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('student.studentName') }}</th>
                        <th>{{ trans('student.stageName') }}</th>
                        <th>{{ trans('student.gradeName') }}</th>
                        <th>{{ trans('student.sectionName') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stages->Name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>{{ $item->sections->name }}</td>
                            <td>
                                {{-- <div class="dropdown-center">
                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ trans('student.operation') }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('student.edit', $item->id) }}"
                                                class="d-flex align-items-center  dropdown-item">
                                                <i class="fa-solid fa-pen-to-square me-2" style="color:blue"></i>
                                                <span>{{ trans('student.edit') }}</span>
                                            </a></li>
                                        <li><button type="button" class="d-flex align-items-center dropdown-item"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="fa-solid fa-trash me-2" style="color:red"></i>
                                                <span>{{ trans('student.deleteStudent') }}</span>
                                            </button></li>
                                        <li> <a href="{{ route('student.show', $item->id) }}"
                                                class="d-flex align-items-center dropdown-item">
                                                <i class="fa-solid fa-eye me-2" style="color:orange"></i>
                                                <span>{{ trans('student.showStudent') }}</span>
                                            </a></li>
                                        <li> <a href="{{ route('invoice.show', $item->id) }}"
                                                class="d-flex align-items-center dropdown-item">
                                                <i class="fa-solid fa-receipt me-2" style="color: aqua"></i>
                                                <span>{{ trans('student.addInvoice') }}</span>
                                            </a></li>
                                        <li> <a href="{{ route('receipt.show', $item->id) }}"
                                                class="d-flex align-items-center dropdown-item">
                                                <i class="fa-solid fa-file-invoice me-2" style="color:tomato"></i>
                                                <span>{{ trans('student.addReceipt') }}</span>
                                            </a></li>
                                        <li> <a href="{{ route('processing.show', $item->id) }}"
                                                class="d-flex align-items-center dropdown-item">
                                                <i class="fa-solid fa-circle-minus me-2" style="color:red"></i>
                                                <span>{{ trans('student.feeExemption') }}</span>
                                            </a></li>
                                        <li> <a href="{{ route('payment.show', $item->id) }}"
                                                class="d-flex align-items-center dropdown-item">
                                                <i class="fas fa-credit-card me-2" style="color:#007bff"></i>
                                                <span>{{ trans('sidebar.payment') }}</span>
                                            </a></li>
                                    </ul>
                                </div> --}}
                            </td>
                        </tr>
                        {{-- @include('Pages.Student.Modal.deleteModal') --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

@endsection
