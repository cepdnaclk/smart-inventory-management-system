@extends('backend.layouts.app')

@section('title', __('Station'))


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station : Show | {{ $stations->stationName  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $stations->stationName }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ url('/addstationadmin/' . $stations->id . '/edit') }}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" stationName="Edit"></i>
                            </a>
                            <a href="{{ url('/addstationadmin/' . $stations->id . '/delete') }}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                               stationName="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">

                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $stations->description) !!}</td>
                    </tr>

                    <tr>
                        <td>Capacity</td>
                        <td>{{ $stations->capacity }}</td>
                    </tr>
                    

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $stations->thumb != null )
                                <img src="{{ $stations->thumbURL() }}" alt="{{ $stations->stationName }}"
                                     class="img img-thumbnail">
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
