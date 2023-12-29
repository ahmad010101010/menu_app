<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::where('id', Auth::id())->get();

        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }


    public function store(StoreMenuRequest $request)
    {
        if (Menu::count() >= 1) {
            return redirect()->back()->withErrors(['error' => 'Maximum of 1 menu allowed to One admin.']);
        }
    
        $menu = Menu::create([
            'admin_id' => Auth::id(),  
            'name' => $request->name,
            'discount' => $request->discount,
        ]);
    
        return redirect()->route('item.index')->with('message', 'item and discount added successfully!');
    }






    public function edit(Menu $menu)
    {

        return view('admin.menu.edit', compact('menu'));
    }






    public function update(StoreMenuRequest $request, Menu $menu)
    {
        $menu->update(['discount' => $request->discount]);

        return redirect()->route('menu.index');
    }

   
    function show($menuId)
    {
        $menu = Menu::with('categories.subcategories.items')->find($menuId);
    
        // Apply discounts recursively for nested items
        $this->applyDiscountsRecursive($menu);
    
        return $menu;
    }
    
    private function applyDiscountsRecursive($item)
    {
        if ($item instanceof Item) {
            $this->applyItemDiscount($item);
        } elseif ($item instanceof Subcategory || $item instanceof Category || $item instanceof Menu) {
            if (isset($item->items) && is_array($item->items)) {  // Added check
                foreach ($item->items as $childItem) {
                    $this->applyDiscountsRecursive($childItem);
                }
            }
        }
    }
    
    private function applyItemDiscount($item)
    {
        $discount = $this->getApplicableDiscount($item);
        if ($discount !== null) {
            $item->price = $item->price * (1 - $discount / 100);
        }
    }
    
    private function getApplicableDiscount($item)
    {
        $discount = $item->discount;
        if ($discount === null) {
            $discount = $this->getDiscountFromParent($item);
        }
        return $discount;
    }
    
    private function getDiscountFromParent($item)
    {
        if ($item instanceof Item) {
            $parent = $item->subcategory;
        } elseif ($item instanceof Subcategory) {
            $parent = $item->category;
        } elseif ($item instanceof Category) {
            $parent = $item->menu;
        } else {
            return null;
        }
    
        return $parent ? $parent->discount : null;
    }
    
    
}
