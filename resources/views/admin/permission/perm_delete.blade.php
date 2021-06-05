@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete</li>
            </ol>
        </nav>

        <div class="row">
            <div class="container">
                <div class="p-2"><h3>Delete Permission</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container pl-4">
                <div class="clearfix"></div>
                <p>Are you sure you want to delete the permission
                    <strong>'{{$permission->name}}'</strong> ?
                </p>

                <form method="POST" action="{{ route('permission.destroy',$permission->id) }}">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-danger">Yes I'm sure. Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
