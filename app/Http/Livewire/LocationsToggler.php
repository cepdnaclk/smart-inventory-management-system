<?php

namespace App\Http\Livewire;

use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use Livewire\Component;

class LocationsToggler extends Component
{
    public $itemModel;
    public $locationID;
    public $isAvailableInLocation;

    public function addLocation()
    {
        $locations = ItemLocations::where('item_id', $this->itemModel->inventoryCode())->where('location_id',$this->locationID)->get();
        if ($locations->count() == 0) {
            ItemLocations::create([
                'location_id' => $this->locationID,
                'item_id' => $this->itemModel->inventoryCode()
            ]);
        } else {
            $locations[0]->delete();
        }
    }

    public function mount()
    {
    }

    public function render()
    {
        $this->isAvailableInLocation = ItemLocations::where('item_id', $this->itemModel->inventoryCode())->where('location_id', $this->locationID)->exists();
        return view('livewire.locations-toggler');
    }
}
