<?php

namespace App\Http\Livewire;

use App\Models\ItemLocations;
use Livewire\Component;

class LocationsToggler extends Component
{
    public $itemModel;
    public $locationID;
    public $locationTitle;
    public $isAvailableInLocation;
    public $isChecked = false;
    public $X = 0;
    public $Y = 0;
    public $Z = 0;


    public function addLocation()
    {
        $locations = ItemLocations::where('item_id', $this->itemModel->inventoryCode())->where('location_id', $this->locationID)->get();
        if ($locations->count() == 0) {
            ItemLocations::create([
                'location_id' => $this->locationID,
                'item_id' => $this->itemModel->inventoryCode()
            ]);
        } else {
            $locations[0]->delete();
        }
        $isChecked = true;
    }

    // Function to show the X, Y, Z input boxes once the user ticks the checkbox
    public function showXYZ()
    {
        $this->emit('showXYZ');
    }


    public function mount()
    {
    }

    public function render()
    {
        $this->isAvailableInLocation = ItemLocations::where('item_id', $this->itemModel->inventoryCode())->where('location_id', $this->locationID)->exists();
        return view('livewire.locations-toggler', ['id' => $this->locationID, 'location' => $this->locationTitle]);
    }
}
