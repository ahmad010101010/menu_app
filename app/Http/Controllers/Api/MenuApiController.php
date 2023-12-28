<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResources;
use App\Models\Category;
use App\Models\Discount;
use App\Services\MenuService;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Subcategory;
use App\Services\MenuService as ServicesMenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuApiController extends Controller
{
    // Assuming you have necessary model relationships defined (e.g., Menu hasMany Categories, etc.)

 
  
        private  $menuService;
    

        public function __construct(MenuService $menuService)
        {

            $this->menuService = $menuService;

        }


        public function showTheMenu(Menu $menu)
        {

            $menu = $this->menuService->getMenuWithDiscounts($menu);
            return new MenuResources($menu);

        }



}