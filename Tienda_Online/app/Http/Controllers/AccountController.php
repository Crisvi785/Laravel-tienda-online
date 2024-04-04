<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
       // Método para obtener la página de la cuenta del usuario
       public function getAccount()
       {
           return view('account.account'); 
       }

       public function getPedidos(){

        return view('account.pedidos');
       }
}
