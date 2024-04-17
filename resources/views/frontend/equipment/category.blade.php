@extends('frontend.layouts.app')

@section('title', $equipmentType->title)

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>{{ $equipmentType->title }}</h3>

                @if ($equipmentType->children()->count() != 0)
                    <div class="container pt-2">Sub-Categories</div>
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach ($equipmentType->children() as $category)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                            href="{{ route('frontend.equipment.category', $category) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $category->thumbURL() }}"
                                                alt="{{ $category->title }}" />
                                            <div class="p-1">
                                                {{ $category->title }}<br>({{ $category->inventoryCode() }})
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($items->count() != 0)
                        <hr />
                    @endif
                @else
                    {{-- No sub categories available --}}
                @endif

                @if ($items->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach ($items as $item)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                            href="{{ route('frontend.equipment.item', $item) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $item->thumbURL() }}"
                                                alt="{{ $item->title }}" />
                                            <div class="p-1">
                                                {{ $item->title }}<br>({{ $item->inventoryCode() }})
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="container pt-4">
                            {{ $items->links() }}
                        </div>
                    @elseif ($items->count() == 0 && $equipmentType->children()->count() == 0)
                        <p>No items listed under this category yet</p>
                    @else
                        {{-- No items available --}}
                @endif

            </div>
        </div>
    </div>
@endsection
