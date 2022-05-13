@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Fabrications : Delete | Job #{{ $jobRequests->id  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>Job #{{ $jobRequests->id }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.jobs.student.destroy', compact('jobRequests') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.jobs.student.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>

                <div class="container pt-3">
                    @if( $jobRequests->thumb != null )
                        <img src="{{ $jobRequests->thumbURL() }}" class="img img-thumbnail">
                    @else
                        <span>[Not Available]</span>
                    @endif
                </div>

            </x-slot>
        </x-backend.card>
    </div>
@endsection
