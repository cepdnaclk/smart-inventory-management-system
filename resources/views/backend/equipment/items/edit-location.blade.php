@extends('backend.layouts.app')

@section('title', __('Equipment Locations'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Locations
            </x-slot>
            <x-slot name="body">
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
               <p> Change locations for {{$equipmentItem->title}}</p>
               @for($i = 1; $i < count($locations)+1; $i++)
                    <div>
                        <table>
                            <tr>
                                <td class="p-1" style="text-align: center; vertical-align: middle;">@livewire('locations-toggler', ['locationID' => $i, 'itemModel' => $equipmentItem])</td>
                                <td style="text-align: center; vertical-align: middle;">{{ $locations[$i] }}</td>
                            </tr>
                        </table>
                    </div>
                @endfor
                   <br>
                   <a href="{{route('admin.equipment.items.show',$equipmentItem)}}" class="btn btn-primary">Save</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection