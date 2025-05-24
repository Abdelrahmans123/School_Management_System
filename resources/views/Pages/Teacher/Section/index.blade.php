{{-- start the blade extension and define the parent layout file --}}
@extends('layouts.master')
{{-- define any css or script files specific to this view --}}
@section('css')
@endsection
{{-- define the title for this view --}}
@section('title', trans('sidebar.SectionList'))

{{-- define the header title for this view --}}
@section('headerTitle', trans('sidebar.SectionList'))

{{-- start the main content for this view --}}
@section('content')
    {{-- include the datatable structure for displaying teacher data --}}
    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('section.sectionName') }}</th>
                        <th>{{ trans('section.gradeName') }}</th>
                        <th>{{ trans('section.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->grades->name }}
                            </td>
                            @if ($item->status == 1)
                                <td><span class="badge text-bg-success">{{ trans('section.active') }}</span>
                                </td>
                            @else
                                <td><span class="badge text-bg-danger">{{ trans('section.noActive') }}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- define any js or script files specific to this view --}}
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
