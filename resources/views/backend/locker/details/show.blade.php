@extends('backend.layouts.app')

@section('title', __('Locker Details'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locker Detail : ID - {{ $lockerDetail->id }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>Locker-{{ $lockerDetail->id }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.locker.details.edit', $lockerDetail)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.locker.details.delete', $lockerDetail)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <td>Status</td>
                        <td>
                            @if( $lockerDetail->is_available == 0)
                                <h4><span class="badge badge-sm bg-gradient-success">Available</span></h4>
                            @else
                                <h4><span class="badge badge-sm bg-gradient-secondary">Not<br>Available</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $lockerDetail->notes }}</td>
                    </tr>
                    <tr>
                        
                        <td>Order Id<br>(placed)</td>
                        <td>
                            @if( $lockerDetail->order_id !== NULL)
                                {{-- <a href="{{ route('admin.order.show', $lockerDetail->order_id) }}"> --}}
                                    {{ $lockerDetail->order_id }}
                                {{-- </a> --}}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
