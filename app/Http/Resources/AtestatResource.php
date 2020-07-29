<?php

namespace App\Http\Resources\Admin;

use App\Product;
use App\Region;
use App\Place;

use Illuminate\Http\Resources\Json\JsonResource;

class AtestatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'serie' => $this->serie,
            'number' => $this->number,
            'products' => Product::where('created_by_id', $this->created_by_id)
                ->select(['id', 'slug', 'name', 'description', 'price_starts', 'price_ends', 'category_id', 'subcategory_id'])
                ->with(['category', 'subcategory'])
                ->get(),
            'region' => [
                'id' => $this->region_id,
                'name' => Region::findOrFail($this->region_id)->denj
            ],
            'place' => [
                'id' => $this->place_id,
                'name' => Place::findOrFail($this->place_id)->denloc
            ],
            'user' => $this->created_by
        ];
    }
}