@extends('frontend.layouts.app')

@section('title', __('Orders'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Orders : Show | {{ $order->id  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $order->user->name }}</h4>
                     
                          
                      
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            Ordered-Date
                        </td>
                        <td>
                            {{$order->ordered_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td>
                            
                            @if($order->componentItems != null)
                            <div class="">
                                @foreach ($order->componentItems as $item)
                                
                                    <div class="d-flex align-items-center justify-content-between col-6">
                                        <div>
                                            <a href="{{ route('admin.orders.show', $item->title) }}">
                                                {{  $item->title }}
                                            </a>
                                        </div>
                                        <div>
                                           {{  $item->pivot->quantity }}
                                        </div>
                                    </div>
                                        
                                @endforeach
                            </div>

                                
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Picked up date</td>
                        @if ( $order->picked_date)
                            <td>{{ $order->picked_date }}</td>
                        @else
                            <td> Not picked up </td>
                        @endif
                        
                    </tr>
                    <tr>
                        <td>Due date to return</td>
                        @if ( $order->due_date_to_return)
                        <td>{{$order->due_date_to_return}} &nbsp; ({{$order->dueDays()}}  Days More!)</td>
                        @else
                            <td> Not Specified! </td>
                        @endif
                    </tr>
                    <tr>
                        <td>Returned date</td>

                        @if ($order->returned_date)
                            <td>{{$order->returned_date}} </td>
                        @else
                            <td> Not Returned Yet! </td>
                        @endif
                    </tr>
                    <tr>
                        <td>status </td>
                        <td>{{ $order->status }} 
                        </td>
                    </tr>
                    <tr>
                        <td> Lecturer Name  </td>
                        <td>{{$order->orderApprovals->lecturer->name}}</td>
                        
                    </tr>
                    <tr>
                        <td> TechnicalOfficer  Name  </td>
                        <td>{{$order->orderApprovals->technicalOfficer->name}}</td>
                        
                    </tr>         
                    
                    
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
