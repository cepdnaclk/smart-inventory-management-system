@extends('backend.layouts.app')

@section('title', __('Lockers'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Ready Orders
            </x-slot>

            {{--            @if ($logged_in_user->hasAllAccess())--}}
                <x-slot name="headerActions">
                    <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.locker.details.create')"
                    :text="__('Create Locker Detail')"></x-utils.link>
                </x-slot>
            {{--            @endif--}}

            <x-slot name="body">

                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>Locker Id</th>
                            <th>Order Id</th>
                            <th>Components<br/>& Quantity</th>
                            <th>Stauts</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.locker.details.show', $order) }}">
                                    {{ $order->locker_id }}</td>
                                    </a>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}">
                                        {{ $order->id }}
                                    </a>
                                </td>

                                <td>
                                    @foreach($order->componentItems as $componentItem)
                                        <a href="{{ route('admin.component.items.show', $componentItem) }}">
                                            {{ $componentItem->title }}
                                        </a>

                                        @if($componentItem->pivot_quantity == null)
                                           - 0
                                        @else
                                           - {{ $componentItem ->pivot_quantity }}
                                        @endif
                                        <br/>
                                    @endforeach

                                </td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.orders.show', $order)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $orders->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
