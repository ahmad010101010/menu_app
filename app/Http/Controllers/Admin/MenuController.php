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





}
