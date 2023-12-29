<?php

namespace App\Http\Resources;

use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        $discount = $this->determineDiscount();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'original_price'=>$this->price,
            'price' => $discount ? ($this->price * (1 - ($discount / 100))) : $this->price,
            'discount' => $discount,
        ];
    }

    private function determineDiscount(): ?float
    {
        // Check for discount in item itself
        if (!is_null($this->discount)) {
            return $this->discount;
        }

        // Fetch subcategory and category relationships
        $this->loadMissing('subcategory.category.menu');

        // Check for discount in subcategory
        if (!is_null($this->subcategory->discount)) {
            return $this->subcategory->discount;
        }

        // Check for discount in category
        if (!is_null($this->subcategory->category->discount)) {
            return $this->subcategory->category->discount;
        }

        // Check for discount in menu
        if (!is_null($this->subcategory->category->menu->discount)) {
            return $this->subcategory->category->menu->discount;
        }

        // No discount found
        return null;
    }
}
