@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>

        <div class="row pb-4">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="p-2"><h3>Roles</h3></div>
                    <div class="p-2">
                        <a href="{{ route('roles.create')}}" class="btn btn-default-btn-xs btn-success">
                            <i class="glyphicon glyphicon-plus"></i>New Role</a>
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
                            <th>Role Display</th>
                            <th>Role Description</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id)}}"
                                           class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a class="btn btn-danger" href="{{ route('roles.destroy', $role->id)}}"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
