<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Products;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Controlador para el panel de administración.
 */
class DashBoardController extends Controller
{
    /**
     * Construye una nueva instancia del controlador.
     *
     * Este método es opcional y se utiliza para definir middleware global para el controlador.
     * En este caso, se establecen los middleware 'auth' e 'IsAdmin'.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('IsAdmin');
    // }

    /**
     * Muestra el panel de administración.
     *
     * Obtiene el conteo de usuarios y productos y los pasa a la vista 'admin.dashboard'.
     *
     * @return \Illuminate\View\View La vista del panel de administración con los datos.
     */
    public function getDashboard()
    {
        // Obtiene el conteo de usuarios y productos
        $users = User::count();
        $products = Products::count();

        // Prepara los datos para pasar a la vista
        $data = ['users' => $users, 'products' => $products];

        // Retorna la vista del panel de administración con los datos
        return view('admin.dashboard', $data);
    }
}
