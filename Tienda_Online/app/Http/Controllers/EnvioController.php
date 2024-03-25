<?php

namespace App\Http\Controllers;

use App\Http\Models\Envio;
use Illuminate\Http\Request;

use App\Models\User;
class EnvioController extends Controller
{
    public function guardarDatosEnvio(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'codigo_postal' => 'required|string',
            'localidad' => 'required|string',
        ]);

        $user = auth()->user();

        // Crear un nuevo registro de envío asociado con el usuario actual
        $envio = new Envio();
        $envio->user_id = $user->id;
        $envio->nombre = $request->input('nombre');
        $envio->direccion = $request->input('direccion');
        $envio->codigo_postal = $request->input('codigo_postal');
        $envio->localidad = $request->input('localidad');
        $envio->save();


        // Redireccionar a una página de confirmación o a otra parte de tu aplicación
        return redirect()->back()->with('success', 'Los datos de envío se han guardado correctamente.');
    }



    
}
