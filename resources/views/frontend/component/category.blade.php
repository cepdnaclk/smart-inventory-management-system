@extends('frontend.layouts.app')

@section('title', $componentType->title )

@section('content')

<h1>HI</h1>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>{{ $componentType->title }}</h3>

                @if($componentType->children()->count() != 0)
                    <div class="container pt-2">Sub-Categories</div>
                    <div class="container pt-2">
                        @foreach($componentType->children() as $category)
                            <a class="btn btn-secondary byn-200 mx-1 mb-2"
                               href="{{ route('frontend.component.category', $category) }}">{{ $category->title }}</a>
                        @endforeach
                        <hr/>
                    </div>
                @else
                    {{-- No sub categories available--}}
                @endif

                @if($items->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach($items as $item)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.component.item', $item) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $item->thumbURL() }}"
                                                 alt="{{ $item->title }}"/>
                                            <div class="p-1">
                                                {{ $item->title }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="container pt-4">
                            {{ $items->links() }}
                        </div>

                        @elseif ($items->count() == 0 && $componentType->children()->count() == 0)
                            <p>No items listed under this category yet</p>
                        @else
                            {{-- No items available--}}
                        @endif

                    </div>
            </div>
            
            
        </div>
@endsection