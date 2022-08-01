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
                            
                    <div class="container pt-2">
                    <div class="row equal">
                        @foreach($modelSearchResults as $searchResult)
                        <div class="col-3 col-sm-3 col-md-2 p-1 d-flex">
                            @if (get_class($searchResult->searchable) == 'App\Models\RawMaterials') 
                                <img class="img-fluid p-2 mx-auto" src="{{ $searchResult->searchable->thumbURL() }}"
                                    alt="{{ $searchResult->title }}"/>
                                {{ $searchResult->title }} <br>
                                Locations : <br>
                                    @foreach ( $searchResult->searchable->getLocation() as $eachLocation )
                                        {{  $eachLocation }} <br>
                                    @endforeach
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\Machines')
                                <img class="img-fluid p-2 mx-auto" src="{{ $searchResult->searchable->thumbURL() }}"
                                    alt="{{ $searchResult->title }}"/>
                                {{ $searchResult->title }} <br>
                                Locations : <br>
                                    @foreach ( $searchResult->searchable->getLocation() as $eachLocation )
                                        {{  $eachLocation }} <br>
                                    @endforeach
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\EquipmentItem') 
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.equipment.item', $searchResult->searchable) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $searchResult->searchable->thumbURL() }}"
                                                 alt="{{ $searchResult->title }}"/>
                                            <div class="p-1">
                                                {{ $searchResult->title }}<br>({{ $searchResult->searchable->inventoryCode() }})
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                
                                @if (get_class($searchResult->searchable) == 'App\Models\ConsumableItem')
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.consumable.item', $searchResult->searchable) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $searchResult->searchable->thumbURL() }}"
                                                 alt="{{ $searchResult->title }}"/>
                                            <div class="p-1">
                                                {{ $searchResult->title }}<br>({{ $searchResult->searchable->inventoryCode() }})
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                

                                @if (get_class($searchResult->searchable) == 'App\Models\ComponentItem')
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.component.item', $searchResult->searchable) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $searchResult->searchable->thumbURL() }}"
                                                 alt="{{ $searchResult->title }}"/>
                                            <div class="p-1">
                                                {{ $searchResult->title }}<br>({{ $searchResult->searchable->inventoryCode() }})
                                            </div>
                                        </a>
                                    </div>
                                @endif




                            </div>  
                        @endforeach
                        </div>
                    </div>
                        
                    @endforeach
                </div>
                </x-slot>
                </x-backend.card>
    </div>

@endsection

