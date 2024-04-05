<?php

namespace App\Http\Controllers;

use App\Http\Models\Cart;
use App\CartItem;
use App\Http\Models\Products;
use Illuminate\Http\Request;
use Dompdf\Dompdf; // Importa la clase Dompdf

use App\Product;
use App\Http\Requests;
use App\Models\Pedido;
use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // Constructor para inicializar el carrito de la sesión y el costo de envío
    public function __construct()
    {
        $ship = 15; // Costo de envío predeterminado
        if (!session()->has('cart')) {
            session()->put('cart', []); // Inicializa el carrito de la sesión si no existe
        }
        if (!session()->has('shipment')) {
            session()->put('shipment', $ship); // Establece el costo de envío en la sesión si no está definido
        }
    }

    // Método para mostrar los detalles del carrito
    public function show()
    {
        $cart = session()->get('cart'); // Obtén el carrito de la sesión
        $total = $this->total(); // Calcula el total del carrito
        $totalqty = $this->totalqty(); // Calcula la cantidad total de productos en el carrito
        $ship = session()->get('shipment'); // Obtiene el costo de envío
        return view('cart.cart', compact('cart', 'total', 'totalqty', 'ship')); // Retorna la vista con los datos del carrito
    }
    
    // Método para agregar un producto al carrito
    public function add($slug)
    {
        $product = Products::where('slug', $slug)->firstOrFail(); // Busca el producto por el slug
        
        $cart = session()->get('cart', []); // Obtiene el carrito de la sesión
        $product->quantity = 1; // Establece la cantidad del producto a 1
        $cart[$product->slug] = $product; // Agrega el producto al carrito
        session()->put('cart', $cart); // Actualiza el carrito en la sesión
        return redirect()->route('cart-show'); // Redirecciona a la página del carrito
    }

    // Método para eliminar un producto del carrito
    public function delete($slug)
    {
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        unset($cart[$slug]); // Elimina el producto del carrito
        session()->put('cart', $cart); // Actualiza el carrito en la sesión
        return redirect()->route('cart-show'); // Redirecciona a la página del carrito
    }

    // Método para actualizar la cantidad de un producto en el carrito
    public function update($slug)
    {
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        $cart[$slug]['quantity'] = request()->input('num'); // Actualiza la cantidad del producto
        session()->put('cart', $cart); // Actualiza el carrito en la sesión
        return redirect()->route('cart-show'); // Redirecciona a la página del carrito
    }

    // Método para calcular el total del carrito
    public function total()
    {
        $ship = session()->get('shippment'); // Obtiene el costo de envío
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        $total = 0; // Inicializa el total en 0
        foreach ($cart as $item) { // Recorre cada producto en el carrito
            $total += $item->price * $item->quantity; // Calcula el total sumando el precio por la cantidad de cada producto
        }
        return $total; // Retorna el total del carrito
    }

    // Método para calcular la cantidad total de productos en el carrito
    public function totalqty()
    {
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        $totalqty = 0; // Inicializa la cantidad total en 0
        if ($cart != null) { // Verifica si el carrito no está vacío
            foreach ($cart as $item) { // Recorre cada producto en el carrito
                $totalqty += $item->quantity; // Calcula la cantidad total sumando la cantidad de cada producto
            }
        }
        return $totalqty; // Retorna la cantidad total de productos en el carrito
    }

    // Método para mostrar el detalle del pedido
    public function orderDetail()
    {
        if (count(session()->get('cart')) <= 0) return redirect()->route('home'); // Redirecciona a la página de inicio si el carrito está vacío
        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
        $total = $this->total(); // Calcula el total del carrito
        $user = Auth::user(); // Obtiene el usuario autenticado
        $ship = session()->get('shippment'); // Obtiene el costo de envío
        $totalqty = $this->totalqty(); // Calcula la cantidad total de productos en el carrito

        return view('cart.order-detail', compact('cart', 'total', 'user', 'totalqty', 'ship')); // Retorna la vista con los detalles del pedido
    }

    // Método para guardar el carrito en la base de datos
    public function saveCart()
    {
        $cartIn = Cart::create([
            'user_id' => auth()->user()->id // Guarda el ID del usuario autenticado en la tabla Cart
        ]);
       

        $cart = session()->get('cart'); // Obtiene el carrito de la sesión
         // Itera sobre cada producto en el carrito y guarda los detalles en la tabla de elementos del carrito
         foreach ($cart as $product) {
            $this->saveCartItem($product, $cartIn->id);
        }

        return redirect()->back(); // Redirecciona de vuelta a la página anterior
    }

    /**
     * Guarda un elemento del carrito en la base de datos.
     *
     * @param  mixed  $product
     * @param  int  $cartIn_id
     * @return void
     */
    public function saveCartItem($product, $cartIn_id)
    {
        // Crea un nuevo registro de elemento del carrito en la base de datos
        CartItem::create([
            'quantity' => $product->quantity,
            'product_slug' => $product->slug,
            'product_id' => $product->id,
            'cart_id' => $cartIn_id
        ]);
    }

    /**
     * Obtiene un carrito específico y lo establece como el carrito actual en la sesión.
     *
     * @param  int  $cart_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCart($cart_id)
    {
        $cartMe = Cart::find($cart_id); // Busca un carrito específico en la base de datos

        // Verifica si el carrito no está vacío y pertenece al usuario autenticado
        if (!count($cartMe) || $cartMe->user_id != Auth::user()->id) {
            return redirect()->route('home')->with(['status' => "Carrito equivocado"]); // Redirecciona a la página de inicio con un mensaje de error
        } else {
            $this->trash(); // Vacía el carrito actual en la sesión

            // Obtiene los elementos del carrito específico desde la base de datos y los agrega al carrito en la sesión
            $cartItems = CartItem::having('cart_id', '=', $cart_id)->get();
            foreach ($cartItems as $item) {
                $product = Products::findOrFail($item->product_id);
                $quantity = $item->quantity;
                $product->quantity = $quantity;
                $cart[$product->slug] = $product;
                session()->put('cart', $cart);
            }

            return redirect()->route('cart-show'); // Redirecciona a la página del carrito
        }
    }

    /**
     * Elimina un carrito de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Cart::destroy($id); // Elimina un carrito específico de la base de datos
        return redirect()->back(); // Redirecciona de vuelta a la página anterior
    }

    /**
     * Procesa el pago utilizando Stripe.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        // Configura la clave secreta de Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Obtiene el carrito de la sesión
        $cart = session()->get('cart', []);

        // Inicializa una matriz para almacenar los elementos de la línea del carrito
        $lineItems = [];

        // Recorre cada elemento en el carrito y agrega un elemento de línea para cada producto
        foreach ($cart as $slug => $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100 + 390, // Convierte el precio a centavos y suma 390 para el envío
                ],
                'quantity' => $product->quantity,
            ];
        }

        // Crea una sesión de pago en Stripe con los elementos de la línea del carrito
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'), // URL de redirección en caso de éxito
            'cancel_url' => route('order-detail'), // URL de redirección en caso de cancelación
        ]);

        return redirect($session->url); // Redirecciona a la URL de la sesión de pago de Stripe
    }

    /**
     * Método para manejar la redirección después del éxito del pago.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
            // Obtiene el carrito de la sesión
        $cart = session()->get('cart', []);

        // Obtiene el user_id del usuario autenticado o establece 1 si no hay ninguno
        $user_id = auth()->id() ?? 1;

        // Inicializa una matriz para almacenar los datos del pedido
        $pedidoData = [];

        // Recorre cada elemento en el carrito y agrega los datos del pedido
        foreach ($cart as $slug => $product) {
            $pedidoData[] = [
                'user_id'  => $user_id,
                'product_slug' => $slug,
                'quantity' => $product->quantity,
                'total_price' => $product->price * $product->quantity,
                // Agrega más datos del pedido si es necesario
            ];
        }

        // Guarda los datos del pedido en la tabla de pedidos
        Pedido::insert($pedidoData);


        // Limpia el carrito de la sesión después de completar el pedido
            
        session()->forget('cart');
        
        return redirect('/'); // Redirecciona a la página de inicio
    }
}
