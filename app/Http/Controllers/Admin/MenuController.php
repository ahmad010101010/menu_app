<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
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
       $menus = Menu::where('id',Auth::id())->get();
         
        return view('admin.menu.index',compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }
    

    public function store(Request $request)
    {
        $menu = Menu::all();
        if ($menu->count()  >= 1) {
            return redirect()->back()
            ->withErrors(['error' => 'Maximum of 1 menu allowed to One admin.']);;
        }
        Menu::create([
            'id'=>Auth::id(),
            'name'=>$request->name,
            'discount'=>$request->discount,
        ]);

        return redirect()->route('item.index')->with('message', 'item and discount added successfully!');
    }

    public function edit(Menu $menu)
    {

        return view('admin.menu.edit',compact('menu'));
    }

    public function update(Request $request , Menu $menu)
    {
        $menu->update(['discount'=>$request->discount]);

        return redirect()->route('menu.index');
    }



    public function show(Menu $menu)
{
    $menu = $menu->load(['categories.subcategories.items']);

    // Apply discounts recursively
    $this->applyDiscounts($menu);

    return response()->json($menu);
}

private function applyDiscounts($item)
{
    if ($item instanceof Menu || $item instanceof Category || $item instanceof Subcategory) {
        if (isset($item->items) && is_array($item->items)) { // Check if items exist and are an array
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
