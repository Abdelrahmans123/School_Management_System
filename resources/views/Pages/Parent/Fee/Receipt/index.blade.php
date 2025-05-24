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
