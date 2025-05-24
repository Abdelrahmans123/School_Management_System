{{-- start the blade extension and define the parent layout file --}}
@extends('layouts.master')
{{-- define any css or script files specific to this view --}}
@section('css')
@endsection
{{-- define the title for this view --}}
@section('title',
trans('sidebar.teacherList'))

{{-- define the header title for this view --}}
@section('headerTitle',trans('sidebar.teacherList'))

{{-- start the main content for this view --}}
@section('content')
    {{-- include the datatable structure for displaying teacher data --}}
    <div class="card">
        <div class="d-grid gap-2 d-md-block m-3">
            <a href="{{ route('teacher.create') }}" class="btn btn-primary" >
                {{trans('teacher.add')}}
            </a>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('teacher.teacherName')}}</th>
                    <th>{{trans('teacher.gender')}}</th>
                    <th>{{trans('teacher.joinDate')}}</th>
                    <th>{{trans('teacher.specialize')}}</th>
                    <th>{{trans('teacher.operations')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->genders->name}}</td>
                        <td>{{$item->joiningDate}}</td>
                        <td>{{$item->specialize->name}}</td>
                        <td>
                            <a href="{{ route('teacher.edit',$item->id) }}" class="btn btn-primary btn-sm" >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{$item->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('Pages.Teacher.Modal.deleteModal') 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- define any js or script files specific to this view --}}
@section('js')
    <script>
        $(document).ready(function () {
            var lang = {!! json_encode($translations) !!};
            $('#example').DataTable({
                "language": lang,
            });
        });
    </script>

@endsection