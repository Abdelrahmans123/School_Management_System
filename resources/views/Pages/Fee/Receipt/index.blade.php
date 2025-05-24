@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.receipt'))


@section('headerTitle', trans('sidebar.receiptList'))

@section('content')
    <!-- row -->

    <div class="card">

        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('student.studentName') }}</th>
                        <th>{{ trans('fee.amount') }}</th>
                        <th>{{ trans('fee.description') }}</th>
                        <th>{{ trans('stage.stageOperation') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipt as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->students->name }}</td>
                            <td>{{ $item->debit }}</td>
                            <td>
                                @if ($item->description == null)
                                    <span class="badge text-bg-danger">{{ trans('message.noNotes') }}</span>
                                @else
                                    {{ $item->description }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('receipt.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Pages.Fee.Receipt.Modals.deleteModal')
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
