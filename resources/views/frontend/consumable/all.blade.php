@extends('frontend.layouts.app')

@section('title', 'All Consumables' )

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>All Consumables</h3>

                @if($items->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach($items as $item)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.consumable.item', $item) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $item->thumbURL() }}"
                                                 alt="{{ $item->title }}"/>
                                            <div class="p-1">
                                                {{ $item->title }}
                                            </div>
                                        </a>
                                        <a href="{{ route('frontend.consumable.category', $item->consumable_type) }}">
                                            ({{ $item->consumable_type->title }})
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="container pt-4">
                            {{ $items->links() }}
                        </div>

                    </div>
            </div>
        </div>
@endsection
