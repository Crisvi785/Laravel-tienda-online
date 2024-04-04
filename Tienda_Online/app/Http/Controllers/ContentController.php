<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Products;

class ContentController extends Controller
{
    // Método para obtener la página de inicio
    public function getHome()
    {
        // Obtiene una lista de productos ordenados por ID de forma descendente y paginados
        $products = Products::orderBy('id', 'desc')->paginate(12);

        // Crea un arreglo de datos que contiene la lista de productos
        $data = ['products' => $products];

        // Retorna la vista 'home' junto con los datos de los productos
        return view('home', $data);
    }
}
