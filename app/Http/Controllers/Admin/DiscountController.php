<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Models\Discount;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash\AutoExpireFlashBag;

class DiscountController extends Controller
{
    

 
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        
        $authUserId = auth()->id();
    
        $menu = Menu::where('user_id', $authUserId)->first();
    
        // If the menu exists, update the discount
        if ($menu) {
            $menu->discount()->update([
                'value' => $request->discount,
            ]);
         
        } else {
            $menu = Menu::create([
                'user_id' => $authUserId,
                'name' => auth()->user()->name . "'s Menu",
            ]);
            Discount::create([
                'value' => $request->discount,
                'menu_id' => $menu->id,
            ]);
        }
    
        return redirect()->route('menu.index')->with('message', 'Discount added successfully!');
    }


}
