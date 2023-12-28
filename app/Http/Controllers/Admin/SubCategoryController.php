<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Subcategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subctegories = Subcategory::all();
        return view('admin.subcategory.index',compact('subctegories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {   

    $category = Category::find($request->category_id); 

    if ($category->subcategories()->count() >= 4) {
        return redirect()->back()
        ->withErrors(['error' => 'Maximum of 4 subcategories allowed per category.']);;
    }

    $subcategory = Subcategory::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'discount' => $request->discount,
    ]);
   
    return redirect()->route('subcategory.index')->with('message', 'Subcategory created successfully!');
}

 
}
