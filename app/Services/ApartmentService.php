<?php

namespace App\Services;

class ApartmentService
{
    public static function search(array $params): ?array
    {
        return \App\Models\Apartment::query()
            ->when($params['name'], function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })
            ->when($params['priceFrom'], function ($query, $priceFrom) {
                $query->where('price', '>=', $priceFrom);
            })
            ->when($params['priceTo'], function ($query, $priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->when($params['bedrooms'], function ($query, $bedrooms) {
                $query->where('bedrooms', $bedrooms);
            })
            ->when($params['bathrooms'], function ($query, $bathrooms) {
                $query->where('bathrooms', $bathrooms);
            })
            ->when($params['storeys'], function ($query, $storeys) {
                $query->where('storeys', $storeys);
            })
            ->when($params['garages'], function ($query, $garages) {
                $query->where('garages', $garages);
            })
            ->get()
            ->toArray();
    }
}
