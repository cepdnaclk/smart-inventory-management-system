<div class="pb-1">
    <div class="row d-flex">
        <div class="col d-flex">
            <input class="me-2" id="{{ $id }}" class="form-check-input" style="width: 20px; height: 20px;"
                wire:model="isAvailableInLocation" wire:click="addLocation" type="checkbox">
            <label class="form-check-label align-self-center ms-1 for="{{ $id }}">

                {{ $location }}
            </label>
        </div>
        {{-- This is not fully implemented --}}
        {{-- ----------------------------- --}}
        {{-- <div class="" style="width: 90px;">
            <input class="form-control form-control-sm" placeholder="X" type="number" id="X" name="X"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Relative coordinate through X axis">
        </div>
        <div class="" style="width: 90px;">
            <input class="form-control form-control-sm" placeholder="Y" type="number" id="Y" name="Y"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Relative coordinate through Y axis">
        </div>
        <div class="" style="width: 90px;">
            <input class="form-control form-control-sm" placeholder="Z" type="number" id="Z" name="Z"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Relative coordinate through Z axis">
        </div> --}}
    </div>
</div>
