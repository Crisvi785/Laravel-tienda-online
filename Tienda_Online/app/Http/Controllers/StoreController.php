<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category as ModelsCategory;
use App\Http\Models\Products;

class StoreController extends Controller
{
    // Método para mostrar la página principal de la tienda
    public function index()
    {
        // Seleccionar todos los productos de una categoría específica
        $category1 = ModelsCategory::having('id', '=', 1)->get();
        $category2 = ModelsCategory::having('id', '=', 2)->get();
        $cat1 = Products::having('category_id', '=', 1)->get();
        $cat2 = Products::having('category_id', '=', 2)->get();
        
        // Obtener la cantidad total de productos en el carrito
        $totalqty = $this->totalqty();

        // Pasar los datos a la vista
        return view('store.index', compact('cat1', 'cat2', 'category1', 'category2', 'totalqty'));
    }

    // Método para mostrar los detalles de un producto
    public function show($slug)
    {
        // Obtener todos los productos y el producto específico por su slug
        $products = Products::all();
        $product = Products::where('slug', $slug)->first();

        // Obtener la cantidad total de productos en el carrito
        $totalqty = $this->totalqty();

        // Pasar los datos a la vista
        return view('store.show', compact('product', 'products', 'totalqty'));
    }

    // Método para mostrar el slider de la tienda
    public function slide()
    {
        // Obtener todos los productos
        $products = Products::all();

        // Pasar los datos a la vista
        return view('store.partials.slider', compact('products'));
    }

    // Método para calcular la cantidad total de productos en el carrito
    public function totalqty()
    {
        $cart = session()->get('cart');
        $totalqty = 0;
        if ($cart != null) {
            foreach ($cart as $item) {
                $totalqty += $item->quantity;
            }
        }
        return $totalqty;
    }
}
