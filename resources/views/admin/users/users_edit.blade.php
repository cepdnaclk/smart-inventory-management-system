@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="row">
            <div class="container">
                <div class="p-2"><h3>Edit User</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container pl-4">
                <form method="post" action="{{ route('users.update', $user->id) }}" data-parsley-validate
                      class="form-horizontal form-label-left">

                    <div class="form-group{{ $errors->has('honorific') ? ' has-error' : '' }} row">
                        {!! Form::label('honorific', 'Honorific', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('honorific', \App\User::$honorificOptions, $user->honorific ?? old('honorific'),
                                ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                            <span class="help-block">{{ $errors->first('honorific') }}</span>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$user->name}}" id="name" name="name"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$user->email}}" id="email" name="email"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} row">
                        {!! Form::label('type', 'User Type', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('type', \App\User::$roleOptions, $user->type ?? old('type'),
                                ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                            <span class="help-block">{{ $errors->first('type') }}</span>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }} row">
                        <label class="col-sm-2 col-form-label" for="category_id">Access Level (One or Multiple)
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="role_id" name="roles[]" multiple>
                                @if(count($roles))
                                    @foreach($roles->reverse() as $row)
                                        <option value="{{ $row->id }}"
                                                @foreach($user->roles as $r)  @if($r->id == $row->id) selected @endif @endforeach
                                        >{{ $row->display_name  }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="help-block">{{ $errors->first('role_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <input name="_method" type="hidden" value="PUT">
                            <button type="submit" class="btn btn-success">Save User Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
