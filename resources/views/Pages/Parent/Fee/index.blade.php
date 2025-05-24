@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('invoice.InvoiceList'))


@section('headerTitle', trans('invoice.InvoiceList'))

@section('content')
    <!-- row -->

    <div class="card">

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('student.studentName') }}</th>
                        <th>{{ trans('fee.type') }}</th>
                        <th>{{ trans('fee.amount') }}</th>
                        <th>{{ trans('fee.stageName') }}</th>
                        <th>{{ trans('fee.gradeName') }}</th>
                        <th>{{ trans('fee.description') }}</th>
                        <th>{{ trans('student.operation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->students->name }}</td>
                            <td>
                                @if ($item->fees->type == 1)
                                    {{ trans('fee.schoolFee') }}
                                @else
                                    {{ trans('fee.busFee') }}
                                @endif
                            </td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->stages->name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>
                                @if ($item->description == null)
                                    <span class="badge text-bg-danger">{{ trans('message.noNotes') }}</span>
                                @else
                                    {{ $item->description }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('parent.receipt', $item->student_id) }}"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fa-solid fa-file-invoice me-2" style="color:tomato"></i>
                                    <span>{{ trans('sidebar.receipt') }}</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



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


@endsection
