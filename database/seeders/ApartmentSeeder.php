<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartment = new Apartment;
        $apartmentProperties = $apartment->getFillable();

        $file = new \SplFileObject('storage/app/private/property-data.csv');
        $isFirstLine = true;
        while (! $file->eof()) {
            $line = $file->fgetcsv(',');

            if ($isFirstLine) {
                $isFirstLine = false;

                continue; // skip first line with property names
            }

            if ($line !== false) {
                Apartment::factory()->create(
                    array_combine($apartmentProperties, $line)
                );
            }
        }
    }
}
