<?php

namespace App\Http\Resources\Admin;

use App\Category;
use App\Subcategory;
use App\Region;
use App\Place;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'product' => [
                'id' => $this->id,
                'slug' => $this->slug,
                'name' => $this->name,
                'description' => $this->description,
                'price' => [
                    'starts' => $this->price_starts,
                    'ends' => $this->price_ends
                ],
                'image' => [
                    'name' => $this->images->first()->name,
                    'file_name' => $this->images->first()->file_name,
                    'url' => $this->images->first()->url,
                    'thumbnail' => $this->images->first()->thumbnail,
                    'preview' => $this->images->first()->preview,
                ]
            ],
            'region' => [
                'id' => $this->region_id,
                'name' => Region::findOrFail($this->region_id)->denj
            ],
            'place' => [
                'id' => $this->place_id,
                'name' => Place::findOrFail($this->place_id)->denloc
            ],
            'category' => [
                'id' => $this->category_id,
                'name' => Category::findOrFail($this->category_id)->name
            ],
            'subcategory' => [
                'id' => $this->subcategory_id,
                'name' => Subcategory::findOrFail($this->subcategory_id)->name
            ],
            'user' => [
                'id' => $this->created_by->id,
                'name' => $this->created_by->name,
                'phone' => $this->created_by->phone,
                'email' => $this->created_by->email,
            ]
            // 'images' => $this->images
        ];
    }
}