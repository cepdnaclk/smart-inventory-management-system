@extends('backend.layouts.app')

@section('title', __('Raw Materials'))

@section('breadcrumb-links')
    @include('backend.raw_materials.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Raw Materials : Delete | {{ $rawMaterials->title  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $rawMaterials->title  }}</i></strong> ?
                    <br>
                    Note : You will not be able to delete if this raw material is being used in any fabrications.
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.raw_materials.destroy', compact('rawMaterials') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.raw_materials.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
