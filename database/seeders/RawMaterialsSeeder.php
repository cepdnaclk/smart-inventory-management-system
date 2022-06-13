<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialsSeeder extends Seeder
{

    protected $data = [
        array('id' => '1', 'code' => '', 'title' => 'eSUN PLA+ Gray Printer Filament', 'color' => 'Gray', 'description' => '1.75mm diameter, 1kg, Gray', 'specifications' => 'Printing Temperature 210-230 ℃\nBase Plate Temperature 45-60 ℃\nPrinting Speed 40-100 mm/s\nDensity 1.23 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083181.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:19:41', 'updated_at' => '2022-06-13 01:19:41'),
        array('id' => '2', 'code' => '', 'title' => 'eSUN PLA+ White Printer Filament', 'color' => 'White', 'description' => '1.75mm diameter, 1kg, White', 'specifications' => 'Printing Temperature 210-230 ℃\nBase Plate Temperature 45-60 ℃\nPrinting Speed 40-100 mm/s\nDensity 1.23 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083181.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:19:41', 'updated_at' => '2022-06-13 01:19:41'),
        array('id' => '3', 'code' => '', 'title' => 'eSUN PLA+ Black Printer Filament', 'color' => 'Black', 'description' => '1.75mm diameter, 1kg, Black', 'specifications' => 'Printing Temperature 210-230 ℃\nBase Plate Temperature 45-60 ℃\nPrinting Speed 40-100 mm/s\nDensity 1.23 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083113.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:18:33', 'updated_at' => '2022-06-13 01:18:33'),
        array('id' => '4', 'code' => '', 'title' => 'eSUN ABS+ Black Printer Filament', 'color' => 'Black', 'description' => '1.75mm diameter, 1kg, Black', 'specifications' => 'Printing Temperature 230-270 ℃\nBase Plate Temperature 95-110 ℃\nPrinting Speed 40-100 mm/s\nDensity 1.06 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655082906.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:15:06', 'updated_at' => '2022-06-13 01:15:19'),
        array('id' => '5', 'code' => '', 'title' => 'eSUN PETG White Printer Filament', 'color' => 'White', 'description' => '1.75mm diameter, 1kg, White', 'specifications' => 'Printing Temperature 250-270 ℃\nBase Plate Temperature 75-90 ℃\nPrinting Speed 40-100 mm/s\nDensity 1.27 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083506.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:25:07', 'updated_at' => '2022-06-13 01:25:07'),
        array('id' => '6', 'code' => '', 'title' => 'CCTREE TPU Flexible White Printer Filament', 'color' => 'White', 'description' => '1.75mm diameter, 1kg, White', 'specifications' => 'Printing Temperature 220-240 ℃\nBase Plate Temperature 0-50 ℃\nPrinting Speed 40-100 mm/s\nDensity 0.98 g/cm^3', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083736.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:28:56', 'updated_at' => '2022-06-13 01:28:56'),
        array('id' => '7', 'code' => '', 'title' => 'Polymaker PolyTerra PLA Sapphire Blue', 'color' => 'Sapphire Blue', 'description' => '1.75mm diameter, 1kg, Black', 'specifications' => 'Printing Temperature 190-230 ℃\nBase Plate Temperature 25-60 ℃\nPrinting Speed 30-70 mm/s\nDensity 1.31 g/cm^3\n\nDatasheet: https://drive.google.com/file/d/1Ipd_VlIfrb0HWdApJCzp25moxtQBFrpT/view', 'quantity' => '1.00', 'unit' => 'kg', 'thumb' => '1655083390.jpg', 'availability' => 'AVAILABLE', 'notes' => NULL, 'created_at' => '2022-06-13 01:22:38', 'updated_at' => '2022-06-13 01:23:10'),
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('raw_materials')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to raw_materials table');
    }
}
