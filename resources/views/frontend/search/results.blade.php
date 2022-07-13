@extends('frontend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>
        
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    {{--<h1>Search</h1>--}}


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
                                <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                                {{get_class($searchResult->searchable)}}

                                @if (get_class($searchResult->searchable) == 'App\Models\RawMaterials') 
                                    @foreach ( $searchResult->searchable->getLocation() as $eachLocation )
                                        {{  $eachLocation }} <br>
                                    @endforeach
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\EquipmentItem') 
                                    
                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\ConsumableItem')

                                @endif

                                @if (get_class($searchResult->searchable) == 'App\Models\ComponentItem')

                                @endif




                            </ul>
                        @endforeach
                    @endforeach

          
    </div>

@endsection

