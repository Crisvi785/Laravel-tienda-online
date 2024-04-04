<?php

namespace App\Http\Controllers;

use App\Http\Models\Envio;
use App\CartItem;
use App\Http\Models\Cart;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\User;

class EnvioController extends Controller
{
    // Método para guardar los datos de envío
    public function guardarDatosEnvio(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'codigo_postal' => 'required|string',
            'localidad' => 'required|string',
        ]);

        // Obtener el usuario autenticado actualmente
        $user = auth()->user();

        // Crear un nuevo registro de envío asociado con el usuario actual
        $envio = new Envio();
        $envio->user_id = $user->id;
        $envio->nombre = $request->input('nombre');
        $envio->direccion = $request->input('direccion');
        $envio->codigo_postal = $request->input('codigo_postal');
        $envio->localidad = $request->input('localidad');
        
        // Guardar el registro de envío en la base de datos
        if ($envio->save()) {
            // Redireccionar con éxito y los datos de envío como parte de la URL
            return redirect()->back()->withInput($request->all())->with('success', 'Los datos de envío se han guardado correctamente.');
        } else {
            // Si hubo un error al guardar, manejarlo aquí
            return redirect()->back()->withErrors(['error' => 'Hubo un error al guardar los datos de envío. Por favor, inténtalo de nuevo.']);
        }
    }
    
    // Método para generar una factura en formato PDF
    public function generarFactura() {
        $cart = Cart::all(); // Obtener todos los elementos del carrito desde el modelo

        // Renderizar la vista 'cart.doc' con los datos del carrito
        $html = view('cart.doc', compact('cart'))->render(); // Reemplazar 'ruta.a.tu.plantilla' con la ruta real de tu plantilla HTML
    
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
    
        // Configuraciones adicionales, como tamaño de página y orientación
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderizar el HTML en PDF
        $dompdf->render();
    
        // Descargar o mostrar el PDF generado
        return $dompdf->stream("factura_pedido.pdf");
    }
}
