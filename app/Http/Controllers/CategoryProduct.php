<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryProduct extends Controller
{
    //Route::get('/add-category-product','CategoryProduct@add_category_product' )
    
    public function add_category_product()
    {
        return view ('admin.add_category_product');
    }
    //Route::get('/all-category-product','CategoryProduct@all_category_product' )
    public function all_category_product()
    {
        return view ('admin.all_category_product');
    }
}
