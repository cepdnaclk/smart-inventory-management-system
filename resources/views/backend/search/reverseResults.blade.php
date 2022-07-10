@extends('backend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Search by location
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">

                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{--  TODO: Add a back button or give an option to change the dropdown location like in Google  --}}

                <p>Items at {{$locationName}}</p>

                @if (!empty($status))
                    <div class="alert alert-danger" role="alert">
                        {{ $status }}
                    </div>
                @endif

                {{-- TODO: Suggest what are the child items with this location --}}
                {{-- Ex: http://localhost:8000/equipment/category/11 --}}
                <ul>
                    @foreach($allItems as $eachItem)
                        <li>
                            @if(class_basename($eachItem) == "EquipmentItem")
                                <a href="{{route("admin.equipment.items.show",$eachItem->id)}}">{{ $eachItem->title }}</a>
                            @elseif(class_basename($eachItem) == "ComponentItem")
                                <a href="{{route("admin.component.items.show",$eachItem->id)}}">{{ $eachItem->title }}</a>
                            @elseif(class_basename($eachItem) == "ConsumableItem")
                                <a href="{{route("admin.consumable.items.show",$eachItem->id)}}">{{ $eachItem->title }}</a>
                            @elseif(class_basename($eachItem) == "RawMaterials")
                                <a href="{{route("admin.raw_materials.show",$eachItem->id)}}">{{ $eachItem->title }}</a>
                            @elseif(class_basename($eachItem) == "Machines")
                                <a href="{{route("admin.machines.show",$eachItem->id)}}">{{ $eachItem->title }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>


            </x-slot>
        </x-backend.card>
    </div>
@endsection
