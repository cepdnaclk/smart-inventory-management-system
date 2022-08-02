@extends('backend.layouts.app')

@section('title', __('Reservation'))

@section('breadcrumb-links')
    @include('backend.reservation.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.reservation.update',
                      compact('reservation')),
                      'method' => 'put',
                      'class' => 'container',
                      'files'=>true,
                      'enctype'=>'multipart/form-data'
          ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Reservation : Edit
            </x-slot>

            <x-slot name="body">

                <!-- Comments -->
                <div class="form-group row">
                    {!! Form::label('comments', 'Comments', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('comments', $reservation->comments, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('comments')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>    

                <!-- Status -->
                <div class="form-group row">
                    {!! Form::label('status', 'Status*', ['class' => 'col-md-2 form-check-label']) !!}
                    <div class="col-md-10">
                        <select name="status" id="status" $reservation->status>
                            <option value="approved" >Approve</option>
                            <option value="rejected" >Reject</option>
                        </select>
                        @error('status')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Save', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>


        </x-backend.card>
        </form>
    </div>
@endsection
