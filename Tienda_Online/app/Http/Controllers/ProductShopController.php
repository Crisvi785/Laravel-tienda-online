<?php

namespace App\Http\Controllers;

use App\Http\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductShopController extends Controller
{
    public function getProducto(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $searchTerm = $request->input('search');

        // Buscar el producto por nombre
        $product = Products::where('name', 'like', "%$searchTerm%")->first();

        // Si se encuentra un producto, mostrar la vista del producto
        if ($product) {
            return view('product_shop.producto', ['product' => $product]);
        } else {
            // Si no se encuentra el producto, puedes manejarlo de alguna manera, como mostrar un mensaje de error.
            return redirect()->back()->with('error', 'Producto no encontrado');
        }
    }
}
