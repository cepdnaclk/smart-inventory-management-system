@extends('backend.layouts.app')

@section('title', __('Locations'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locations
            </x-slot>

            @if ($logged_in_user->hasInventoryAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.locations.create')"
                            :text="__('Create Location')"></x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">
                <livewire:backend.locations-table />
{{--                <div class="container table-responsive pt-3">--}}
{{--                    <table class="table table-striped">--}}
{{--                        <tr>--}}
{{--                            <th>Location Name</th>--}}
{{--                            <th>Actions</th>--}}
{{--                        </tr>--}}
{{--                        @foreach($locations as $loc)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loc->getFullLocationAddress() }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex px-0 mt-0 mb-0">--}}
{{--                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                            @if ($loc->location != "MakerSpace")--}}
{{--                                                <a href=" {{route('admin.locations.edit', $loc) }}"--}}
{{--                                                   class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="{{ route('admin.locations.delete', $loc) }}"--}}
{{--                                                   class="btn btn-danger btn-xs"><i class="fa fa-trash"--}}
{{--                                                                                    title="Delete"></i>--}}
{{--                                                </a>--}}
{{--                                            @else--}}
{{--                                                <p>[Not Editable]</p>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                </div>--}}
            </x-slot>
        </x-backend.card>
    </div>
@endsection
