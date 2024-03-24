<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use App\Category;
use App\Http\Models\Category as ModelsCategory;
use App\Http\Models\Products;

class StoreController extends Controller
{
    public function index()
    {
        //Seleccionar todos los productos de una categoria:
        $category1 = ModelsCategory::having('id', '=', 1)->get();
        $category2 = ModelsCategory::having('id', '=', 2)->get();
        $cat1 = Products::having('category_id', '=', 1)->get();
        $cat2 = Products::having('category_id', '=', 2)->get();
        //$products = Product::orderBy('category_id')->get();
        $totalqty = $this->totalqty();
          return view('store.index', compact('cat1', 'cat2', 'category1', 'category2', 'totalqty'));
    }
    public function show($slug)
    {
        $products = Products::all();
        $product = Products::where('slug', $slug)->first(); //el ->first indica que utilice el primero que encuentre.
        $totalqty = $this->totalqty();
        return view ('store.show', compact('product', 'products','totalqty'));
    }
    public function slide()
    {
        $products=Products::all();
        return view('store.partials.slider', compact('products'));
    }

    public function totalqty(){
        $cart = session()->get('cart');
        $totalqty = 0;
        if ($cart!= null) {
            foreach ($cart as $item) {
                $totalqty += $item->quantity;
            }
        }
        return $totalqty;
    }
}
