@extends('frontend.layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Category: {{ $equipmentType->title }}</h3>

                @if($equipmentType->children()->count() != 0)
                    <h4>Sub Categories</h4>
                    <div class="container pt-2">
                        <ul>
                            @foreach($equipmentType->children() as $category)
                                <li>
                                    <a href="{{ route('frontend.equipment.category', $category) }}">{{ $category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    {{-- No sub categories available--}}
                @endif

                @if($items->count() != 0)
                    <h4>Items</h4>
                    <div class="container pt-2">
                        <ul>
                            @foreach($items as $item)
                                <li><a href="{{ route('frontend.equipment.item', $item) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="container pt-4">
                        {{ $items->links() }}
                    </div>

                @elseif ($items->count() == 0 && $equipmentType->children()->count() == 0)
                    <p>No items listed under this category yet</p>
                @else
                    {{-- No items available--}}
                @endif

            </div>
        </div>
    </div>
@endsection
