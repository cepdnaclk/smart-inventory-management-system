@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Machines : Show | {{ $machines->title  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $machines->title }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.machines.edit', $machines)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('admin.machines.delete', $machines)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Code (to be finalized)</td>
                        <td>{{ $machines->inventoryCode() }}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>
                            @if(count($locations_array) > 0)
                                @foreach(array_reverse($locations_array) as $eachLocation)
                                    {{ $eachLocation }}
                                    @if(!($loop->last))
                                        ->
                                    @endif
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>{{ \App\Models\Machines::types()[$machines->type] }}
                        </td>
                    </tr>
                    <tr>
                        <td>Build Size (W x L x H)</td>

                        <td>
                        @if($machines->build_width != null && $machines->build_length != null && $machines->build_height!= null )
                            {{ $machines->build_width }} x {{ $machines->build_length }} x {{ $machines->build_height }} mm
                        @else
                            N/A
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Power</td>
                        <td>{{ ($machines->power) ? $machines->power." W" : "N/A" }}</td>
                    </tr>

                    <tr>
                        <td>Specifications</td>
                        <td>{!! str_replace("\n", "<br>", $machines->specifications) !!}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ \App\Models\Machines::availabilityOptions()[$machines->status] }}</td>
                    </tr>

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $machines->thumb != null )
                                <img src="{{ $machines->thumbURL() }}" alt="{{ $machines->title }}"
                                     class="img img-thumbnail">
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Notes</td>
                        <td>{!! str_replace("\n", "<br>", $machines->notes) !!}</td>
                    </tr>

                    <tr>
                        <td>Lifespan</td>
                        <td>{{ $machines->lifespanString() }}</td>
                    </tr>

                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
