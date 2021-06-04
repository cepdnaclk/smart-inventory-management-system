@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permission</li>
            </ol>
        </nav>

        <div class="row pb-4">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="p-2"><h3>Permission</h3></div>
                    <div class="p-2">
                        <a href="{{ route('permission.create')}}" class="btn btn-default-btn-xs btn-success">
                            <i class="glyphicon glyphicon-plus"></i>New Permission</a>
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
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->display_name }}</td>
                                <td>{{ $row->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{route('permission.edit', $row->id)}}"
                                           class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a class="btn btn-danger" href="{{route('permission.destroy', $row->id)}}"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
