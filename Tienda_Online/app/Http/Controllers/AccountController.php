<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Envio;
use App\Models\Pedido;

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
        if (Auth::check()) {
            $user = Auth::user(); // Obtiene el usuario autenticado
        
            // Obtén los pedidos asociados al usuario autenticado
            $pedidos = Pedido::where('user_id', $user->id)->get();
        
            $envio = Envio::where('user_id', $user->id)->first();
        
           // Calcula el total de cada pedido individualmente
             foreach ($pedidos as $pedido) {
                  $pedido->total = $pedido->total_price;
             }
                
             return view('account.pedidos', compact('pedidos', 'user', 'envio'));
            } else {
            return redirect()->route('home'); // Redirecciona a la página de inicio si el usuario no está autenticado
        }



       }
}
