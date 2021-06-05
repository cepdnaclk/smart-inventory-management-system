@extends('layouts.app')

@push('styles')
    <link href="/css/home.css" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" style="">
        @if (\Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong> {!! \Session::get('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @role(['superadministrator','administrator'])
        <div class="container pt-4">
            <h5>Access Control</h5>
            <div class="d-flex flex-wrap">
                <div class="p-2 home-card card m-1">
                    <a href="{{ route('users.index') }}" class="stretched-link text-decoration-none">
                        <div class="text-center">
                            <i class="fa fa-users fa-3x tile-icon"></i><br>
                            <span class="tile-text">Users</span>
                        </div>
                    </a>
                </div>

                <div class="p-2 home-card card m-1">
                    <a href="{{ route('roles.index') }}" class="stretched-link text-decoration-none">
                        <div class="text-center">
                            <i class="fa fa-user-secret fa-3x tile-icon"></i><br>
                            <span class="tile-text">Roles</span>
                        </div>
                    </a>
                </div>

                <div class="p-2 home-card card m-1">
                    <a href="{{ route('permission.index') }}" class="stretched-link text-decoration-none">
                        <div class="text-center">
                            <i class="fa fa-id-card fa-3x tile-icon"></i><br>
                            <span class="tile-text">Permissions</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endrole
    </div>

@endsection
<script>
    import Timetable from "../js/components/Timetable/Timetable";

    export default {
        components: {Timetable}
    }
</script>
