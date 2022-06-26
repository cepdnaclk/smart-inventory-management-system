@extends('frontend.layouts.app')

@section('title', __('Equipment'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Browse Equipments by Category</h3>
 
                <div class="container">
                    <ul>
                        @foreach($eqTypes as $type)
                            @if( $type->parent() == null )
                                <li>
                                    <a href="{{ route('frontend.equipment.category', $type) }}">{{ $type->title  }}</a>
                                    @if($type->children() != null)
                                        <ul>
                                            @foreach($type->children() as $child)
                                                <li>
                                                    <a href="{{ route('frontend.equipment.category', $child) }}">{{ $child->title }}</a>
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
