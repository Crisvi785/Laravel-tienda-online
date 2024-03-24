<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator; 


class UsersController extends Controller
{
    public function getUsers(){
        $users = User::orderBy('id', 'asc')->get();
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }


    public function getUserDelete($id){
        $users = User::find($id);
        if ($users->delete()) {

            return back();
        }


    }

    
    public function getUserEdit($id){
        $users = User::find($id);
        $data = ['users' => $users];
    return view('admin.users.edit', $data);
    }
    



    public function postUserEdit(Request $request, $id){
        $rules=[
            'name' => 'required',
            'lastname' => 'required',
            'email'=> 'required'
        ];
        $message = [
            'name.required' => 'El nombre del usuario es requerido',
            'lastname.required' => 'Ingrese el apellido del usuario',
            'email.required' => 'Ingrese un correo electrónico del usuario'

            ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        }else{
            $users = User::find($id);
            $users -> name= $request->input('name');
            $users -> lastname = $request->input('lastname');
            $users -> email = $request->input('email');

            if ($users->save()) {

                return back();
            }
        }

    }

    }




