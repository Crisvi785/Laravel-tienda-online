<?php

namespace App\Http\Controllers;

use App\Http\Models\Envio;
use App\CartItem;
use App\Http\Models\Cart;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

use App\Models\User;
use PHPUnit\Event\Test\ComparatorRegistered;

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
        if ($envio->save()) {
            // Redireccionar con éxito y los datos de envío como parte de la URL
            return redirect()->back()->withInput($request->all())->with('success', 'Los datos de envío se han guardado correctamente.');
        } else {
            // Si hubo un error al guardar, manejarlo aquí
            return redirect()->back()->withErrors(['error' => 'Hubo un error al guardar los datos de envío. Por favor, inténtalo de nuevo.']);
        }
    }
    
    public function generarFactura() {
        $cart = Cart::all(); // Por ejemplo, obtén todos los elementos del carrito desde tu modelo

        $html = view('cart.doc', compact('cart'))->render(); // Reemplaza 'ruta.a.tu.plantilla' con la ruta real de tu plantilla HTML
    
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
    
        // (Opcional) Configuraciones adicionales, como tamaño de página y orientación
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderiza el HTML en PDF
        $dompdf->render();
    
        // Descarga o muestra el PDF generado
        return $dompdf->stream("factura_pedido.pdf");
    }



    
}
