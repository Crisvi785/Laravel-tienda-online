<?php
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;

class ClearCartOnLogout
{
    public function handle(Logout $event)
    {
        // Elimina el carrito actual de la sesión
        session()->forget('cart');
    }
}
