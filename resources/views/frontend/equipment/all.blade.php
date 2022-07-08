@extends('frontend.layouts.app')

@section('title', 'All Equipment' )

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>All Equipment</h3>

                @if($items->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach($items as $item)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">
                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.equipment.item', $item) }}">
                                            <img class="img-fluid p-2 mx-auto" src="{{ $item->thumbURL() }}"
                                                 alt="{{ $item->title }}"/>
                                            <div class="p-1">
                                                {{ $item->title }}<br>
                                                ({{ $item->inventoryCode() }})
                                            </div>
                                        </a>
                                        {{-- <a class="btn btn-primary btn-sm" href="{{ route('frontend.equipment.category', $item->equipment_type) }}">--}}
                                        {{--    {{ $item->equipment_type->title }}--}}
                                        {{-- </a>--}}
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
