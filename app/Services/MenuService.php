<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Subcategory;

class MenuService
{

    public function getMenuWithDiscounts(Menu $menu)
{
    $menu = $menu->load(['categories.subcategories.items']);

    $this->applyDiscounts($menu);

    return $menu; 
}

private function applyDiscounts($item)
{
    if ($item instanceof Menu || $item instanceof Category || $item instanceof Subcategory) {
        if (isset($item->items) && is_array($item->items)) { 
            foreach ($item->items as $childItem) {
                $this->applyDiscounts($childItem);
            }
        }
    } else {
        // Apply discounts for item
        $item->price = $this->calculateDiscountedPrice($item);
    }
}

private function calculateDiscountedPrice($item)
{
    $discount = $item->discount ?? $item->subcategory->discount ?? $item->subcategory->category->discount ?? $item->subcategory->category->menu->discount ?? null;

    return $discount ? $item->price * (1 - $discount) : $item->price;
}


}