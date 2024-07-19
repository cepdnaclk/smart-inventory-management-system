@extends('frontend.layouts.app')

@section('title', $componentItem->title)

@push('after-styles')
    <style>
        td {
            padding: 1px 12px 1px 0;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 mb-4">
                <img src="{{ $componentItem->thumbURL() }}" alt="{{ $componentItem->title }}"
                    class="img img-thumbnail img-fluid mx-auto p-3">
            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">
                <div class="container-fluid row d-inline-flex">
                    <div class="col-10 p-0">
                        <h3>{{ $componentItem->title }} <br>
                            <small class="text-muted">
                                {{ $componentItem->inventoryCode() }}
                            </small>
                        </h3>
                    </div>
                    <div class="col-2">
                        @if (
                            $logged_in_user != null &&
                                ($logged_in_user->isAdmin() ||
                                    $logged_in_user->isLecturer() ||
                                    $logged_in_user->isTechOfficer() ||
                                    $logged_in_user->isMaintainer()))
                            <a target="_blank" href="{{ route('admin.component.items.edit', $componentItem) }}"
                                class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="pt-2">
                    <table>
                        <tr>
                            <td>Category</td>
                            <td>
                                : @if ($componentItem->component_type->parent()->first() != null)
                                    <a
                                        href="{{ route('frontend.component.category', $componentItem->component_type->parent()->first()) }}">
                                        {{ $componentItem->component_type->parent()->first()->title }}
                                    </a> &gt;
                                @endif

                                <a href="{{ route('frontend.component.category', $componentItem->component_type) }}">
                                    {{ $componentItem->component_type['title'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Product Code</td>
                            <td>
                                : <b>{{ $componentItem->productCode }}({{ $componentItem->brand }})</b>
                            </td>
                        </tr>

                        <tr>
                            <td>Available Quantity</td>
                            <td>
                                : <b>{{ $componentItem->quantity }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Dimensions</td>
                            <td>
                                : <b>
                                    @if ($componentItem->width != 0 && $componentItem->height != 0 && $componentItem->length != 0)
                                        {{ $componentItem->width }} x {{ $componentItem->height }}
                                        x {{ $componentItem->length }} cm <br>
                                    @else
                                        <span>[Not Available]</span> <br>
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>
                                : <b>
                                    @if ($componentItem->weight != null)
                                        {{ $componentItem->weight . ' g' }}
                                    @else
                                        <span>[Not Available]</span>
                                    @endif
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- Location info --}}
                @if ($locationCount > 1)
                    <div class="pt-3">
                        <u>Locations</u>
                        <ul>
                            @foreach ($locationStringArray as $eachLocation)
                                <li>{{ $eachLocation }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif ($locationCount == 1)
                    <div class="pt-3">
                        <u>Location</u>
                        <ul>
                            <li>{{ $locationStringArray[0] }}</li>
                        </ul>
                    </div>
                @endif

                @if ($componentItem->isElectrical && $componentItem->powerRating != null)
                    <div class="pt-3">
                        Power Rating: {{ $componentItem->powerRating . ' W' }}
                    </div>
                @endif

                @if ($componentItem->description !== null)
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", '<br>', $componentItem->description) !!}
                        </div>
                    </div>
                @endif

                @if ($componentItem->specifications !== null)
                    <div class="pt-3">
                        <u>Specifications</u>
                        <div class="pl-3">
                            {!! str_replace("\n", '<br>', $componentItem->specifications) !!}
                        </div>
                    </div>
                @endif


                @if ($componentItem->instructions !== null)
                    <div class="pt-3">
                        <u>Usage Instructions</u>
                        <div class="pl-3">
                            {!! str_replace("\n", '<br>', $componentItem->instructions) !!}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
