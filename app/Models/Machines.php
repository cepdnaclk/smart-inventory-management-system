<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Machines extends Model implements  Searchable
{
    use HasFactory;

    protected $guarded = [];

    public function inventoryCode()
    {
        return sprintf("MC/%03d",$this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/machines/' . $this->thumb;
        return null;
    }

    // Types of the machines
    public static function types()
    {
        return [
            'CNC' => 'CNC Milling Machine',
            'FDM_3D_PRINTER' => '3D Printer (FDM)',
            'LASER_CUTTER' => 'Laser Cutter',
            'PCB_MILL' => 'PCB Milling Machine'
        ];
    }

    // Machine availability options
    public static function availabilityOptions()
    {
        return [
            'AVAILABLE' => 'Available',
            'NOT_AVAILABLE' => 'Not Available',
            'CONDITIONALLY_AVAILABLE' => 'Conditionally Available'];
    }

    // Lifespan of the machine in hour and minute format
    public function lifespanString()
    {
        return (intdiv($this->lifespan,60)) . " hours " . ($this->lifespan % 60) . " minutes";
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.search.index', $this->slug);
        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}
