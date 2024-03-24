<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class ProductShopController extends Controller
{
    public function getProducto($id){
        $products = Products::find($id);
        $data = ['products' => $products];
        return view('product_shop.producto', $data);
    }
}
