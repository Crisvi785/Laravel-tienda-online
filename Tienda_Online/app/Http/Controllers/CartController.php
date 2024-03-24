<?php

namespace App\Http\Controllers;

use App\Http\Models\Cart;
use App\CartItem;
use App\Http\Models\Products;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;

use App\Product;
use App\Http\Requests;
use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $ship = 15;
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        if (!session()->has('shipment')) {
            session()->put('shipment', $ship);
        }
    }
    // Mostrar detalles del producto
    public function show()
    {
        $cart = session()->get('cart');
        $total = $this->total();
        $totalqty = $this->totalqty();
        $ship = session()->get('shipment');
        return view('cart.cart', compact('cart', 'total', 'totalqty', 'ship'));
    }
    
    // añadir al carrito
    public function add($slug)
    {
    $product = Products::where('slug', $slug)->firstOrFail();
    $cart = session()->get('cart', []);
    $product->quantity = 1; 
    $cart[$product->slug] = $product;
    session()->put('cart', $cart);
    return redirect()->route('cart-show');
    }

  public function delete($slug)
{
    $cart = session()->get('cart');
    unset($cart[$slug]);
    session()->put('cart', $cart);

    return redirect()->route('cart-show');
}

public function trash()
{
    session()->forget('cart');
    return redirect()->route('cart-show');
}

public function update($slug)
{
    $cart = session()->get('cart');
    $cart[$slug]['quantity'] = request()->input('num');
    session()->put('cart', $cart);

    return redirect()->route('cart-show');
}

    public function total(){
        $ship = session()->get('shippment');
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $item){
            $total+= $item->price * $item->quantity;
        }

        return $total;
    }
    public function totalqty(){
        $cart = session()->get('cart');
        $totalqty = 0;
        if ($cart!= null) {
            foreach ($cart as $item) {
                $totalqty += $item->quantity;
            }
        }
        return $totalqty;
    }
    public function orderDetail()
    {
        if(count(session()->get('cart'))<=0) return redirect()->route('home');
        $cart = session()->get('cart');
        $total = $this->total();
        $user = Auth::user();
        $ship = session()->get('shippment');
        $totalqty = $this->totalqty();

        return view('cart.order-detail', compact('cart', 'total', 'user', 'totalqty', 'ship'));
    }
    public function destroyUser($id)
    {
        $user = ModelsUser::findOrFail($id);
        $user->delete();
        $this->trash();

        return redirect() ->route('home');
    }
    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $idUser = $user->id;
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->address = $request['address'];
        $user->postal =$request['postal'];
        $user->locality = $request['locality'];
        $user->update;

        if ($user->update) {
            $message = 'Perfil actualizado';
        }
        return redirect() ->route('perfil',compact('idUser'))->with(['message' => $message]);
    }
    public function updateShipping(Request $request)
    {
        $user = Auth::user();
        $user->name2 = $request['name2'];
        $user->last_name2 = $request['last_name2'];
        $user->address2 = $request['address2'];
        $user->postal2 =$request['postal2'];
        $user->locality2 = $request['locality2'];
        $user->update;

        return redirect() ->route('order-detail');
    }
    public function keep()
    {

        $user = Auth::user();
        $user->name2 = $user->name;
        $user->last_name2 =  $user->last_name;
        $user->address2 =  $user->address;
        $user->postal2 = $user->postal;
        $user->locality2 = $user->locality;
        $user->update;

        return redirect() ->route('order-detail');
    }
    public function saveCart()
    {
        $cartIn = Cart::create([
          'user_id' => auth()->user()->id
        ]);

        $cart = session()->get('cart');
        foreach($cart as $product){
            $this->saveCartItem($product, $cartIn->id);
        }
        return redirect()->back();
    }
    public function saveCartItem($product, $cartIn_id)
    {
        CartItem::create([
            'quantity' => $product->quantity,
            'product_slug' => $product->slug,
            'product_id' => $product->id,
            'cart_id' => $cartIn_id
        ]);

    }
    public function getCart($cart_id)
    {
        $cartMe = Cart::find($cart_id);


        if(!count($cartMe) || $cartMe->user_id != Auth::user()->id ){
            return redirect()->route('home')->with(['status' => "Carrito equivocado"]);
        }else{
            $this->trash();
            $cartItems = CartItem::having('cart_id', '=', $cart_id)->get();
            foreach($cartItems as $item) {
            $product = Products::findOrFail($item->product_id);
            $quantity = $item->quantity;
            $product -> quantity = $quantity;
            $cart[$product ->slug] = $product;
            session()->put('cart', $cart);
        }
            return redirect() ->route('cart-show');
        }
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }


}
