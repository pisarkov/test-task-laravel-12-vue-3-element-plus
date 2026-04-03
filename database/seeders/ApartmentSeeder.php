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

        foreach ($this->getApartmentData() as $data) {
            Apartment::factory()->create(
                array_combine($apartmentProperties, $data)
            );
        }
    }

    protected function getApartmentData(): \Generator
    {
        $file = new \SplFileObject('storage/app/private/property-data.csv');
        $isFirstLine = true;
        while (! $file->eof()) {
            if ($isFirstLine) {
                $isFirstLine = false;

                continue; // skip first line with property names
            }

            $values = $file->fgetcsv(',');
            if ($values !== false) {
                yield $values;
            }
        }
    }
}
