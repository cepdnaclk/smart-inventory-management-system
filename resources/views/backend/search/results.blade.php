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
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                {{-- <h1>Search</h1> --}}
                {{--  TODO: Add a back button or give an option to change the search text like in Google  --}}

                You are searching for '{{ $keywords }}'. <br>
                There are {{ $searchResults->count() }} results.

                @if ($searchResults->count() == 0)
                    <br> Please check your spellings
                @endif
                <br><br>
                @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                    @foreach ($modelSearchResults as $searchResult)
                        <ul>
                            <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                        </ul>
                    @endforeach
                @endforeach

            </x-slot>
        </x-backend.card>
    </div>

@endsection
