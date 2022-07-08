@extends('frontend.layouts.app')

@section('title', __('Consumable'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Browse Consumables by Category</h3>

                <div class="container">
                    <ul>
                        <li><a href="{{ route('frontend.consumable.index.all')  }}">All</a></li>
                        @foreach($consumableTypes as $type)
                            @if( $type->parent() == null )
                                <li>
                                    <a href="{{ route('frontend.consumable.category', $type) }}">{{ $type->title  }}</a>
                                    @if($type->children() != null)
                                        <ul>
                                            @foreach($type->children() as $child)
                                                <li>
                                                    <a href="{{ route('frontend.consumable.category', $child) }}">{{ $child->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
