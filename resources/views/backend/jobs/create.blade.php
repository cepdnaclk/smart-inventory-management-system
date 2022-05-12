@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')

@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.jobs.store'),
            'method' => 'post',
            'class' => 'container',
            'files'=>true,
            'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Fabrications : Place a new Job Request
            </x-slot>

            <x-slot name="body">
                <!-- Machine -->
                <div class="form-group row">
                    {!! Form::label('machine', 'Machine*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('machine', $machines, '', ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('machine')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Material -->
                <div class="form-group row">
                    {!! Form::label('material', 'Material*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('material', $materials, '', ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('material')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Supervisor -->
                <div class="form-group row">
                    {!! Form::label('supervisor', 'Supervisor*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('supervisor', $lecturers, '', ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('supervisor')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description (student notes) -->
                <div class="form-group row">
                    {!! Form::label('student_notes', 'Description*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('student_notes', '', ['class'=>'form-control', 'required'=>true, 'rows'=>3 ]) !!}
                        @error('student_notes')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- File -->
                <div class="form-group row">
                    {!! Form::label('file', 'File*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10 ">
                        {!! Form::file('file', ["accept"=>".zip", 'required'=>true]);  !!} (Max: 50MB, zip file contain all design documents)

                        @error('file')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10 ">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg", 'required'=>true]);  !!} (Max: 2MB, a clear image on what you hope to fabricate)

                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Create', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
