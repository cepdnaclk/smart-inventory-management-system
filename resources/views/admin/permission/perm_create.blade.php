@extends('layouts.app')

@section('content')
    <div class="container" style="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>

        <div class="row">
            <div class="container">
                <div class="p-2"><h3>Add Permission</h3></div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <form method="post" action="{{ route('permission.store') }}" data-parsley-validate
                      class="form-horizontal form-label-left">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ Request::old('name') ?: '' }}" id="name" name="name"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }} row">
                        <label for="display_name" class="col-sm-2 col-form-label">Display Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ Request::old('display_name') ?: '' }}" id="display_name"
                                   name="display_name"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('display_name'))
                                <span class="help-block">{{ $errors->first('display_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} row">
                        <label for="description" class="col-sm-2 col-form-label">description</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ Request::old('description') ?: '' }}" id="description"
                                   name="description"
                                   class="form-control col-md-7 col-xs-12"> @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <button type="submit" class="btn btn-success">Create Permission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
