@extends('frontend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>

        <div class="container py-4">
            <div class="row justify-content-center">
                {!! Form::open(['route' => 'frontend.frontSearch.results', 'method' => 'GET'], ['class' => 'searchBar']) !!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="search" id="keywords" class="form-control form-control" placeholder="Search"
                                name="keywords" value="{{ $keywords }}" required />
                            <div class="input-group-append">
                                <button id="search-button" type="submit" class="btn btn-primary px-3 form-control">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-2">
                            You are searching for <i>'{{ $keywords }}'</i>. There are {{ $searchResults->count() }}
                            results.
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <div name="body">
                <div class='container'>
                    @if ($searchResults->count() == 0)
                        <div class="p-5 text-center text-muted">No search results. Please try again with different
                            keyword</div>
                    @endif
                    <br><br>
                    @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                        <div class="container pt-2">
                            <div class="row equal">
                                @foreach ($modelSearchResults as $searchResult)
                                    <div class="col-3 col-sm-3 col-md-2 p-1 d-flex">
                                        @if (get_class($searchResult->searchable) == 'App\Models\RawMaterials')
                                            <img class="img-fluid p-2 mx-auto"
                                                src="{{ $searchResult->searchable->thumbURL() }}"
                                                alt="{{ $searchResult->title }}" />
                                            {{ $searchResult->title }} <br>
                                            Locations : <br>
                                            @foreach ($searchResult->searchable->getLocation() as $eachLocation)
                                                {{ $eachLocation }} <br>
                                            @endforeach
                                        @endif

                                        @if (get_class($searchResult->searchable) == 'App\Models\Machines')
                                            <img class="img-fluid p-2 mx-auto"
                                                src="{{ $searchResult->searchable->thumbURL() }}"
                                                alt="{{ $searchResult->title }}" />
                                            {{ $searchResult->title }} <br>
                                            Locations : <br>
                                            @foreach ($searchResult->searchable->getLocation() as $eachLocation)
                                                {{ $eachLocation }} <br>
                                            @endforeach
                                        @endif

                                        @if (get_class($searchResult->searchable) == 'App\Models\EquipmentItem')
                                            <div class="text-center card">
                                                <a class="text-decoration-none"
                                                    href="{{ route('frontend.equipment.item', $searchResult->searchable) }}">
                                                    <img class="img-fluid p-2 mx-auto"
                                                        src="{{ $searchResult->searchable->thumbURL() }}"
                                                        alt="{{ $searchResult->title }}" />
                                                    <div class="p-1">
                                                        {{ $searchResult->title }}
                                                        <br>({{ $searchResult->searchable->inventoryCode() }})
                                                    </div>
                                                </a>
                                            </div>
                                        @endif

                                        @if (get_class($searchResult->searchable) == 'App\Models\ConsumableItem')
                                            <div class="text-center card">
                                                <a class="text-decoration-none"
                                                    href="{{ route('frontend.consumable.item', $searchResult->searchable) }}">
                                                    <img class="img-fluid p-2 mx-auto"
                                                        src="{{ $searchResult->searchable->thumbURL() }}"
                                                        alt="{{ $searchResult->title }}" />
                                                    <div class="p-1">
                                                        {{ $searchResult->title }}
                                                        <br>({{ $searchResult->searchable->inventoryCode() }})
                                                    </div>
                                                </a>
                                            </div>
                                        @endif


                                        @if (get_class($searchResult->searchable) == 'App\Models\ComponentItem')
                                            <div class="text-center card">
                                                <a class="text-decoration-none"
                                                    href="{{ route('frontend.component.item', $searchResult->searchable) }}">
                                                    <img class="img-fluid p-2 mx-auto"
                                                        src="{{ $searchResult->searchable->thumbURL() }}"
                                                        alt="{{ $searchResult->title }}" />
                                                    <div class="p-1">
                                                        {{ $searchResult->title }}
                                                        <br>({{ $searchResult->searchable->inventoryCode() }})
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
            </div>

        </div>

    @endsection
