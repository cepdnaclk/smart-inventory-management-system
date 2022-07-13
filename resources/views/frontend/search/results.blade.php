@extends('frontend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>

        <x-backend.card>
            <div class='p-3'> 
            <x-slot name="header">
                Search
            </x-slot>
        </div>
        
        
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    {{--<h1>Search</h1>--}}

                    <x-slot name="body">
                        <div class='container'> 
                    You are searching for '{{$keywords}}'. <br>
                    There are {{ $searchResults->count() }} results.

                    @if($searchResults->count() == 0)
                        <br> Please check your spellings
                    @endif
                    <br><br>
                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
{{--                        <h2>{{ $type }}</h2>--}}
                            
                        @foreach($modelSearchResults as $searchResult)
                            <ul>
                                @if (get_class($searchResult->searchable) == 'App\Models\RawMaterials') 
                                {{ $searchResult->title }} <br>
                                Locations : <br>
                                    @foreach ( $searchResult->searchable->getLocation() as $eachLocation )
                                        {{  $eachLocation }} <br>
                                    @endforeach
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\Machines')
                                {{ $searchResult->title }} <br>
                                Locations : <br>
                                    @foreach ( $searchResult->searchable->getLocation() as $eachLocation )
                                        {{  $eachLocation }} <br>
                                    @endforeach
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\EquipmentItem') 
                                    <li><a href="{{route('frontend.equipment.item',$searchResult->searchable)}}">{{ $searchResult->title }}</a></li>
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\ConsumableItem')
                                    <li><a href="{{route('frontend.consumable.item',$searchResult->searchable)}}">{{ $searchResult->title }}</a></li>
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\ComponentItem')
                                    <li><a href="{{route('frontend.component.item',$searchResult->searchable)}}">{{ $searchResult->title }}</a></li>
                                @endif




                            </ul>
                        @endforeach
                    @endforeach
                </div>
                </x-slot>
                </x-backend.card>
    </div>

@endsection

