<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Envio;

class AccountController extends Controller
{
       // Método para obtener la página de la cuenta del usuario
       public function getAccount()
       {
           return view('account.account'); 
       }

       private function total()
       {
           $cart = session()->get('cart'); // Obtiene el carrito de la sesión
           $total = 0; // Inicializa el total en 0
           foreach ($cart as $item) { // Recorre cada producto en el carrito
               $total += $item->price * $item->quantity; // Calcula el total sumando el precio por la cantidad de cada producto
               $total += 3.90; //  Agrega los gastos de envío
           
            }
           return $total; // Retorna el total del carrito
       }

       public function getPedidos(){
        if (count(session()->get('cart')) <= 0) return redirect()->route('home'); // Redirecciona a la página de inicio si el carrito está vacío
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        $total = $this->total(); // Calcula el total del carrito
        $user = Auth::user(); // Obtiene el usuario autenticado
        $ship = session()->get('shippment'); // Obtiene el costo de envío
        $envio = Envio::where('user_id', Auth::id())->first();
        return view('account.pedidos', compact('cart', 'total', 'user', 'envio'));
       }
}
