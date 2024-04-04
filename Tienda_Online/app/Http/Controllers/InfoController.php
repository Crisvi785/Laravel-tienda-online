<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    // Método para mostrar la página "Sobre Nosotros"
    public function getAboutUs(){
        return view('info.about');
    }
    
    // Método para mostrar la página de Preguntas Frecuentes (FAQs)
    public function getFAQs(){
        return view('info.faqs');
    }
    
    // Método para mostrar la página de Política de Privacidad
    public function getPrivacy(){
        return view('info.privacy');
    }
    
    // Método para mostrar la página de Política de Envío
    public function getShippingPrv(){
        return view('info.shippingP');
    }

    // Método para mostrar la página de Términos y Condiciones
    public function getTerms(){
        return view('info.terms');
    }

     // Método para obtener la página de la cuenta del usuario
     public function getAccount()
     {
         return view('account.account'); 
     }
}
