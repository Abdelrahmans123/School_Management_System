@extends('layouts.master')
@section('css')
@endsection
@section('title', trans('sidebar.OnlineSessionList'))


@section('headerTitle', trans('sidebar.OnlineSessionList'))

@section('content')
    <!-- row -->

    <div class="card">

        <div class="d-grid gap-2 d-md-block m-3">
            @if(auth()->guard('admin')->check())

            <a href="{{ route('sessions.create') }}" class="btn btn-primary">
                {{ trans('session.addOnlineSessionDirect') }}
            </a>
            <a href="{{ route('sessions.indirectSession') }}" class="btn btn-warning">
                {{ trans('session.addOnlineSessionIndirect') }}
            </a>
            @elseif(auth()->guard('teacher')->check())
            <a href="{{ route('teacher.sessions.create') }}" class="btn btn-primary">
                {{ trans('session.addOnlineSessionDirect') }}
            </a>
            <a href="{{ route('teacher.sessions.indirectSession') }}" class="btn btn-warning">
                {{ trans('session.addOnlineSessionIndirect') }}
            </a>
            @endif
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('session.topic') }}</th>
                        <th>{{ trans('session.startTime') }}</th>
                        <th>{{ trans('session.duration') }}</th>
                        <th>{{ trans('student.stageName') }}</th>
                        <th>{{ trans('student.gradeName') }}</th>
                        <th>{{ trans('student.sectionName') }}</th>
                        <th>{{ trans('session.userName') }}</th>
                        <th>{{ trans('session.startUrl') }}</th>
                        <th>{{ trans('session.joinUrl') }}</th>
                        <th>{{ trans('grade.gradeOperation') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sessions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->topic }}</td>
                            <td>{{ $item->start_at }}</td>
                            <td>{{ $item->duration }}</td>
                            <td>{{ $item->stages->name }}</td>
                            <td>{{ $item->grades->name }}</td>
                            <td>{{ $item->sections->name }}</td>
                            <td>{{ $userName[app()->getLocale()] }}</td>
                            <td><a href="{{ $item->start_url }}" class="btn btn-success btn-sm" target="_blank"><i
                                        class="fas fa-play"></i>
                                </a></td>
                            <td><a href="{{ $item->join_url }}" class="btn btn-info btn-sm" target="_blank"><i
                                        class="fas fa-user-plus"></i>
                                </a></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Pages.Session.Modals.deleteModel')
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
