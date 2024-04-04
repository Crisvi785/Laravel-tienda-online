<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;

class ClearCartOnLogin
{
    public function handle(Login $event)
    {
        // Elimina el carrito actual del usuario (si lo hay)
        if ($event->user) {
            $event->user->cart->delete();
        }
    }
}
