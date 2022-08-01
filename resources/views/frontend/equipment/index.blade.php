@extends('frontend.layouts.app')

@section('title', __('Equipment'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Browse Equipments by Category</h3>

                <div class="container">
                    <ul>
                        <li><a href="{{ route('frontend.equipment.index.all')  }}">All</a></li>
                        {{--  Level 1 --}}
                        @foreach($eqTypes as $type)
                            @if( $type->parent() )
                                <li>
                                    <a href="{{ route('frontend.equipment.category', $type) }}">{{ $type->title  }}</a>
                                    @if($type->children() != null)
                                        <ul>
                                            {{--  Level 2 --}}
                                            @foreach($type->children() as $child)
                                                <li>
                                                    <a href="{{ route('frontend.equipment.category', $child) }}">{{ $child->title }}</a>
                                                    @if($child->children() != null)
                                                        <ul>
                                                            {{--  Level 3 --}}
                                                            @foreach($child->children() as $child2)
                                                                <li>
                                                                    <a href="{{ route('frontend.equipment.category', $child2) }}">{{ $child2->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

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
