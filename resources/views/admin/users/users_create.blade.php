@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>

        <div class="row">
            <div class="container">
                <div class="p-2"><h3>Add User</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <form method="post" action="{{ route('users.store') }}" data-parsley-validate
                      class="form-horizontal form-label-left">

                    <div class="form-group{{ $errors->has('honorific') ? ' has-error' : '' }} row">
                        <label class="col-sm-3 col-form-label" for="category_id">Honorific
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-5 col-xs-12">
                            <select class="form-control" id="honorific" name="honorific">
                               @foreach( \App\User::$honorificOptions as $row)
                                    <option value="{{$row}}"
                                        {{ ($row == old('honorific')) ? 'selected' : '' }}
                                    >{{$row}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('honorific'))
                                <span class="help-block">{{ $errors->first('honorific') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ Request::old('name') ?: '' }}" id="name" name="name"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ Request::old('email') ?: '' }}" id="email" name="email"
                                   class="form-control col-md-7 col-xs-12">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" value="{{ Request::old('password') ?: '' }}" id="password"
                                   name="password" class="form-control col-md-7 col-xs-12">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }} row">
                        <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" value="{{ Request::old('confirm_password') ?: '' }}"
                                   id="confirm_password" name="confirm_password"  class="form-control col-md-7 col-xs-12">
                            @if ($errors->has('confirm_password'))
                                <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} row">
                        <label class="col-sm-3 col-form-label" for="category_id">Account Type
                        </label>
                        <div class="col-md-6 col-sm-5 col-xs-12">
                            <select class="form-control" id="type" name="type">
                                @if(count($roles)) @foreach(\App\User::$roleOptions as $row)
                                    <option value="{{$row}}"
                                        {{ ($row == old('type')) ? 'selected' : '' }}
                                    >{{$row}}</option>
                                @endforeach @endif
                            </select>
                            @if ($errors->has('type'))
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }} row">
                        <label class="col-sm-3 col-form-label" for="category_id">Role (Permission Level)
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-5 col-xs-12">
                            <select class="form-control" id="role_id" name="role_id">
                                @if(count($roles)) @foreach($roles->reverse() as $row)
                                    <option value="{{$row->id}}"
                                        {{ ($row->id == old('role_id')) ? 'selected' : '' }}
                                    >{{$row->name}}</option>
                                @endforeach @endif
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="help-block">{{ $errors->first('role_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-5 col-xs-12 col-md-offset-3">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <button type="submit" class="btn btn-success">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
