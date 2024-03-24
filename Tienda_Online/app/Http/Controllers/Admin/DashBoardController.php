<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Products;
use Illuminate\Http\Request;
use App\Models\User;

class DashBoardController extends Controller
{
    //  public function __Construct(){
    //      $this->middleware('auth');
    //      $this->middleware('IsAdmin');
        
    //  }

     public function getDashBoard(){
        $users = User::count();
        $products = Products::count();
        $data = ['users' => $users, 'products' => $products];
         return view('admin.dashboard', $data);
     }


    
}
