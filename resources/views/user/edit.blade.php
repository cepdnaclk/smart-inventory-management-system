@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
        </nav>

        <div class="row">
            <div class="container">
                <div class="p-2"><h3>Settings</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <form method="POST" action="{{ route('user.settings', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::label('name', 'User Name', ['class' => ' col-form-label']) !!}
                                {!! Form::text('name', $value = $user->name, ['class' => 'form-control', 'required']) !!}
                                @error('name')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::label('honorific', 'Honorific', ['class' => ' col-form-label']) !!}
                                {!! Form::select('honorific', \App\User::$honorificOptions, $user->honorific ?? old('honorific'),
                                    ['class' => 'form-control', 'required']) !!}
                                @error('honorific')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="container">
                                    <div class="row">
                                        <div class="col sm-3">
{{--                                            {{ $user->profileImage()  }}--}}
                                            <img src="{{ $user->profileImage()  }}" alt="" class="w-100" />
                                        </div>

                                        <div class="col col-sm-9">
                                            {!! Form::label('avatar', 'Profile', ['class' => ' col-form-label']) !!}
                                            <input type="file" class="form-control-file" id="avatar" name="avatar">

                                            @error('avatar')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary">Update Settings</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="row pt-5">
            <div class="container">
                <div class="p-2"><h3>Password</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <form method="POST" action="{{ route('user.password', $user) }}">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-8">

                            <div class="form-group">
                                <label for="current-password" class=" col-form-label">Current Password</label>
                                <input id="current-password" type="password" class="form-control"
                                       name="current_password"
                                       autocomplete="current-password" required>
                                @error('current-password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password" class=" col-form-label">New Password</label>
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                       autocomplete="current-password" required>
                                @error('new_password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_confirm_password" class="col-form-label">New Confirm Password</label>

                                <input id="new_confirm_password" type="password" class="form-control"
                                       name="new_confirm_password" autocomplete="current-password" required>
                                @error('new_confirm_password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-primary">Update Password</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
