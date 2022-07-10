<div class="form-check">
    <input id="{{ $id }}" class="form-check-input" wire:model="isAvailableInLocation" wire:click="addLocation"
           type="checkbox">
    <label class="form-check-label" for="{{ $id }}">
        {{ $location }}
    </label>
</div>

