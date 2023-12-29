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


    return $menu; 
}



}