<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator; 

class UsersController extends Controller
{
    // Método para obtener todos los usuarios y mostrarlos en la vista 'admin.users.home'
    public function getUsers(){
        $users = User::orderBy('id', 'asc')->get();
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }

    // Método para eliminar un usuario específico por su ID
    public function getUserDelete($id){
        $user = User::find($id);
        if ($user->delete()) {
            return back();
        }
    }

    // Método para obtener y mostrar los detalles de un usuario para su edición
    public function getUserEdit($id){
        $user = User::find($id);
        $data = ['users' => $user];
        return view('admin.users.edit', $data);
    }

    // Método para procesar la edición de un usuario
    public function postUserEdit(Request $request, $id){
        // Reglas de validación para los campos del formulario
        $rules=[
            'name' => 'required',
            'lastname' => 'required',
            'email'=> 'required|email'
        ];
        // Mensajes de error personalizados para las reglas de validación
        $message = [
            'name.required' => 'El nombre del usuario es requerido',
            'lastname.required' => 'Ingrese el apellido del usuario',
            'email.required' => 'Ingrese un correo electrónico del usuario',
            'email.email' => 'Ingrese un correo electrónico válido'
        ];

        // Validar los datos del formulario
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            // Si la validación falla, redireccionar de vuelta con errores y mensajes de error
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        } else {
            // Si la validación es exitosa, actualizar los datos del usuario
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');

            // Guardar los cambios en la base de datos
            if ($user->save()) {
                return back();
            }
        }
    }
}
