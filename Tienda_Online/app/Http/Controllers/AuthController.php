<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\User;
use App\Mail;
use App\Mail\UserSendRecover;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as FacadesMail;

class AuthController extends Controller
{

    
    // public function __construct(){
    //       $this->middleware('guest')->except(['getLogout']);
    //   }
    


    public function showFormLogin()
    {
        return view('connect.login');
    }

    public function postRegister(Request $request){
        $rules =[
            
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',  
            'email'=>'required|email|unique:users,email',  
            'password'=>'required|min:8',
            'confirm_password'=>'required|min:8|same:password']; 
        
        $message =[
            'name.required'=>'Es necesario introducir un nombre',
            'lastname.required' => 'Es necesario introducir un apellido',
            'email.required' => 'Es necesario introducir un email',
            'email.email' => 'El formato de email no es válido',
            'email.unique' => 'Ya existe un usuario con este correo electónico',
            'password' => 'Es obligatorio escribir una contraseña',
            'password.require' => 'Es obligatorio escribir la contraseña',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'confirm_password' => 'Es necesario confirmar la contraseña',
            'confirm_password.same' => 'Las contraseñas deben ser iguales',

        ];

        $validator = Validator::make($request->all(),$rules, $message);
        if ($validator->fails()) {
           return back()->withErrors($validator)->with('message','Se ha producido un error a la hora de introducir los datos', 'typealert', 'danger');
        }else{
            $user = new User();
            $user->name= e($request->input('name'));
            $user->lastname= e($request->input('lastname'));
            $user->email= e($request->input('email'));
            $user->password=bcrypt($request->input('password'));
            
            if($user->save()){
                
                return redirect('/login')->with('message', 'El usuario se ha creado correctamente')->with('typealert', 'success');


            }
        }

        
    }



    public function postLogin(Request $request){

        $rules =[
            'email'=>'required|email',  
            'password'=>'required|min:8',
        ];

        $message =[
            'email.required' => 'Es necesario introducir un email',
            'email.email' => 'El formato de email no es válido',
            'password' => 'Es obligatorio escribir una contraseña',
            'password.require' => 'Es obligatorio escribir la contraseña',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            
        ];

        $validator = Validator::make($request->all(),$rules, $message);
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message','Se ha producido un error a la hora de introducir los datos', 'typealert', 'danger');
         }else{
            
            if(Auth::attempt(['email' => $request ->input('email'), 'password' => $request->input('password')], true)){
                return redirect('/');



            }else{
                return back()->with('message','El correo electrónico o la contraseña son incorrectos.', 'typealert', 'danger');

            }


         }


    
    
    }


    public function getLogout(){
        Auth::logout() ;
        return redirect('/');
    }


    public function getRecover(){
        return view('connect.recover');
    }

    public function postRecover(Request $request){
        $rules=[
            'email'=>'required|email'
        ];
        $message=[
        'email.required'=>'Ingrese un correo electrónico',
        'email.email' => 'El formato del correo electrónico es inválido'
        ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) { 
            return redirect('/recover')->withErrors($validator->errors());
        } else {
            $user = User::where('email',$request->input('email'))->count();
            
            if($user == "1"){
                $user = User::where('email',$request->input('email'))->first();
                $code= random_int(1, 999999);
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $code,
                    'text' => 'Tu mensaje aquí' 
                ];
                // FacadesMail::to($user->email)->send(new UserSendRecover($data));
                // return view('emails.user-recover', $data);


            }else{

                return back()->with('message', 'El correo electónico introducido no existe')->with('typealert', 'danger');
            }
           
         }


}


}