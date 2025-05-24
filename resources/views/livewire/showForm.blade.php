@extends('layouts.master')
@section('css')
    @livewireStyles
@endsection
@section('title', trans('sidebar.parentList'))
@section('headerTitle', trans('sidebar.parentList'))
@section('content')
    <!-- row -->

    <div class="card">
        <div class="card-body">
            <livewire:add-parent />
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')
    @livewireScripts
    <script>
        $(document).ready(function() {
            var lang = {!! json_encode($translations) !!};
            $('#fatherTable').DataTable({
                "language": lang,
            });
            $('#motherTable').DataTable({
                "language": lang,
            });
        });
    </script>
@endsection
