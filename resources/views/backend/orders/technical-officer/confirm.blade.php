@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.orders.officer.mail',
                   compact('approvedOrder')),
                   'method' => 'put',
                   'class' => 'container',
                   'files'=>true,
                   'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Orders : Confirm | Order #{{ $approvedOrder->id  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Order #{{ $approvedOrder->id }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            {!! Form::submit('Confirm and Email to Student', ['class'=>'btn btn-primary btn-xs me-2']) !!}
                        </div>
                    </div>

                </div>
                </div>
                
                <table class="table">
                    <tr>
                        <td>Status</td>
                        <td><b>{{ $approvedOrder->status}}</b></td>
                    </tr>

                    <tr>
                        <td>
                            Components
                        </td>
                        <td>
                            @foreach($approvedOrder->componentItems as $componentItem)
                                    <a href="{{ route('admin.component.items.show', $componentItem) }}">
                                        {{ $componentItem->title }}
                                    </a>
                                    @if($componentItem->pivot_quantity == null)
                                        - 0
                                    @else
                                        - {{ $componentItem ->pivot_quantity }}
                                    @endif
                                    <br>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td>Approved Lecture</td>
                        <td>
                            @if($approvedOrder->orderApprovals != null)
                                {{ $approvedOrder->orderApprovals->lecturer_id['name'] }}
                                ( {{ $approvedOrder->orderApprovals->lecturer_id['email'] }} )
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Order Requested at</td>
                        @if( $approvedOrder->ordered_date != null )
                            <td>{{ $approvedOrder->ordered_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Picked at</td>
                        @if( $approvedOrder->picked_date != null )
                            <td>{{ $approvedOrder->picked_date }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                    <tr>
                        <td>Order Return at</td>
                        @if( $approvedOrder->due_date_to_return != null )
                            <td>{{ $approvedOrder->due_date_to_return }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>

                </table>
            </x-slot>

            <x-slot name="footer">
                <div class="form-group row">
                    <!-- Select Locker -->
                    {!! Form::label('locker_id', 'Select Locker', ['class' => 'col-md-3 col-form-label']) !!}

                    <div class="col-md-3">
                        {!! Form::select('locker_id', $availableLockers, '', ['class'=>'form-control', 'placeholder' => '', 'required'=>true]) !!}
                        @error('locker_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- select due date -->
                    {!! Form::label('due_date_to_return', 'Order Due Date', ['class' => 'col-md-3 col-form-label']) !!}

                    <div class="col-md-3">
                        {!! Form::date('due_date_to_return', '', ['class'=>'form-control', 'required'=>true]) !!}
                        @error('due_date_to_return')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </x-slot>
        </x-backend.card>
        {!! Form::close() !!}
    </div>
@endsection
