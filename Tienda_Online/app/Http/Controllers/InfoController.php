<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function getAboutUs(){
        return view( 'info.about');
        
    }
    public function getFAQs(){
        return view('info.faqs');
    }
    public function getPrivacy(){
        return view('info.privacy');
    }
    public function getShippingPrv(){
        return view('info.shippingP');

    }

    public function getTerms(){
        return view('info.terms');
    }
}
