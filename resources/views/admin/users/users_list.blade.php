@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>

        <div class="row pb-4">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="p-2"><h3>Users</h3></div>
                    <div class="p-2">
                        @permission('users-create')
                        <a href="{{ route('users.create')}}" class="btn btn-default-btn-xs btn-success">
                            <i class="glyphicon glyphicon-plus"></i>New User
                        </a>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    @foreach($user->roles as $r)
                                        {{ $r->display_name}}
                                        @if(! $loop->last) <br> @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @permission('users-update')
                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id)}}"
                                           class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Role"></i> </a>
                                        @endpermission

                                        @permission('users-delete')
                                        <a class="btn btn-danger" href="{{ route('users.destroy', $user->id)}}"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                        </a>
                                        @endpermission
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
