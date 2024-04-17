@extends('frontend.layouts.app')

@section('title', 'All Components')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>All Components</h3>

                @if ($items->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach ($items as $item)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none" href="{{ route('frontend.component.item', $item) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $item->thumbURL() }}"
                                                alt="{{ $item->title }}" />
                                            <div class="p-1">
                                                {{ $item->title }}<br>({{ $item->inventoryCode() }})
                                            </div>
                                        </a>
                                        {{-- <a href="{{ route('frontend.component.category', $item->component_type) }}">
                                            ({{ $item->component_type->title }})
                                        </a> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="container pt-4">
                            {{ $items->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endsection
