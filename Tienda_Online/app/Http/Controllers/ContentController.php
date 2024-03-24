<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Products;

class ContentController extends Controller
{
 
     public function getHome()
    {
        $products = Products::orderBy('id', 'desc')->paginate(12);
        $data = ['products' => $products];
        return view('home', $data);
        
    }
}
