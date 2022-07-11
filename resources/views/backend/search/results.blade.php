@extends('backend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Search
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
                            </ul>
                        @endforeach
                    @endforeach

            </x-slot>
        </x-backend.card>
    </div>

@endsection

