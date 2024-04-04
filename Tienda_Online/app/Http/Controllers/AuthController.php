<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador para la autenticación de usuarios.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View La vista del formulario de inicio de sesión.
     */
    public function showFormLogin()
    {
        return view('connect.login');
    }

    /**
     * Procesa el formulario de registro de usuario.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse Una redirección a la página de inicio de sesión con un mensaje de éxito o error.
     */
    public function postRegister(Request $request)
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',  
            'email' => 'required|email|unique:users,email',  
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]; 
        
        // Mensajes de validación personalizados
        $message = [
            'name.required' => 'Es necesario introducir un nombre',
        ];

        // Validar los datos del formulario
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error a la hora de introducir los datos')->with('typealert', 'danger');
        } else {
            // Crear un nuevo usuario
            $user = new User();
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = $request->input('email');
            $user->password = $request->input('password');



            
            
            if ($user->save()) {
                return redirect('/login')->with('message', 'El usuario se ha creado correctamente')->with('typealert', 'success');
            }
        }
    }

    /**
     * Procesa el formulario de inicio de sesión.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse Una redirección a la página principal o al formulario de inicio de sesión con un mensaje de éxito o error.
     */
    public function postLogin(Request $request)
    {
        // Reglas de validación
        $rules = [
            'email' => 'required|email',  
            'password' => 'required|min:8',
        ];

        // Mensajes de validación personalizados
        $message = [
            // Mensajes personalizados aquí...
        ];

        // Validar los datos del formulario
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error a la hora de introducir los datos')->with('typealert', 'danger');
        } else {
            // Intentar iniciar sesión
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
                return redirect('/');
            } else {
                return back()->with('message', 'El correo electrónico o la contraseña son incorrectos.')->with('typealert', 'danger');
            }
        }
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse Una redirección a la página principal.
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Muestra el formulario de recuperación de contraseña.
     *
     * @return \Illuminate\View\View La vista del formulario de recuperación de contraseña.
     */
    public function getRecover()
    {
        return view('connect.recover');
    }

    /**
     * Procesa el formulario de recuperación de contraseña.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse Una redirección al formulario de recuperación de contraseña con un mensaje de éxito o error.
     */
    public function postRecover(Request $request)
    {
        // Reglas de validación
        $rules = [
            'email' => 'required|email'
        ];

        // Mensajes de validación personalizados
        $message = [
            'email.required' => 'Ingrese un correo electrónico',
            // Otros mensajes de validación aquí...
        ];

        // Validar los datos del formulario
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect('/recover')->withErrors($validator->errors());
        } else {
            // Buscar si el correo electrónico existe en la base de datos
            $user = User::where('email', $request->input('email'))->count();
            if ($user == "1") {
                $user = User::where('email', $request->input('email'))->first();
                // Generar un código de recuperación
                $code = random_int(1, 999999);
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $code,
                    'text' => 'Tu mensaje aquí' 
                ];
                // Otros procesos de recuperación de contraseña aquí...
            } else {
                return back()->with('message', 'El correo electónico introducido no existe')->with('typealert', 'danger');
            }
        }
    }
}
