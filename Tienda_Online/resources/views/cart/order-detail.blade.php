@extends('master')
@section('title', 'Detalles de la compra')
@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-shopping-cart"></i> Detalle Del Pedido</h1>
        </div>
<div class="row">
    <div class="col-md-6">
        @if(Auth::check())
        <h3>Datos del usuario</h3>
        <table class="table table-striped table-hover table-bordered">
            <tr><td>Nombre:</td><td>{{ Auth::user()->name . " " . Auth::user()->lastname }}</td></tr>
            <tr><td>Correo:</td><td>{{ Auth::user()->email }}</td></tr>
        </table>
    @else
        <div class="alert alert-danger">
            <p>No hay usuario registrado.</p>
            <p>Por favor, <a href="/login">inicia sesión</a>.</p>
        </div>
    @endif
    </div>
    <div class="col-md-6">
        <h3>Datos del Envío</h3>
        @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
        @endif

        <table class="table table-striped table-hover table-bordered">
            <form action="{{ route('guardar_datos_envio') }}" method="POST">
                @csrf
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" class="form-control" id="nombre" name="nombre" required></td>
                </tr>
                <tr>
                    <td><label for="direccion">Dirección:</label></td>
                    <td><input type="text" class="form-control" id="direccion" name="direccion" required></td>
                </tr>
                <tr>
                    <td><label for="codigo_postal">Código Postal:</label></td>
                    <td><input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required></td>
                </tr>
                <tr>
                    <td><label for="localidad">Localidad:</label></td>
                    <td><input type="text" class="form-control" id="localidad" name="localidad" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" class="btn btn-primary">Guardar</button></td>
                </tr>
            </form>
        </table>
    </div>
    {{-- <div class="col-md-6">
        <table class="table table-striped table-hover table-bordered">
            <tr><td>Dirección:</td><td>{{ $data['direccion'] }}</td></tr>
            <tr><td>Código Postal:</td><td>{{ $data['codigo_postal'] }}</td></tr>
            <tr><td>Localidad:</td><td>{{ $data['localidad'] }}</td></tr> 
        </table>
    </div> --}}
</div>
        
        
  
    </div>
        
        <div class="col-md-10 col-md-offset-1" style="text-align: center; margin-left: 100px">
            <h3>Datos del pedido</h3>
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            @foreach($cart as $item)
                <tr>
                 <td>{{$item->name}}</td>
                 <td>{{number_format($item->price,2)}}€</td>
                 <td>{{$item->quantity}}</td>
                 <td>{{number_format($item->price * $item->quantity,2)}}€</td>
                </tr>
            @endforeach
                <tr>
                    <td>
                        Gastos de envío
                    </td>
                    <td>3.90 €</td>
                </tr>
                <tr style="font-weight: bold;border-top: black 5px solid ">
                    <td>
                        <h3 style="font-weight: bold">Total</h3>
                    </td>
                    <td></td><td></td>
                    <td>
                        <h3>{{ number_format(3.90 + $total,2) }} €</h3>

                    </td>
                </tr>
            </table>
        </div>
    <hr>
    <div class="col-md-10 col-md-offset-1" style="text-align: center; margin-bottom: 50px; margin-left: 100px">
   
        <div id="paypal-button-container">

            <script>
                 paypal.Buttons({

                    style:{
                      
                        layout: 'horizontal',
                        color:  'gold',
                        shape:  'pill',
                        // height: '55',
                        disableMaxWidth: true

                     
                    },

                    //USUARIO PAYPAL: sb-xk10n29918380@personal.example.com
                    //CONTRASEÑA PAYPAL: &Dr0.p_Y


                    createOrder: function(data, actions){
                         return actions.order.create({
                            purchase_units:[{
                               amount:{
                                   value: '{{ $total}}'
                               }
                            }]
                         });
                     },

                     onApprove:function(data, actions){
                        actions.order.capture().then(function(details) {
                            console.log(details);
                            //Redirigir a Order-details o a compra realizada con éxito
                     });
                    },

                     onCancel: function(data){
                        alert("Pago cancelado");
                        console.log(data);
                     }
                    }).render('#paypal-button-container')
            </script>

        </div>
            <form action="{{route('checkout')}}" method="POST">
                @csrf          
                <button class="btn btn-primary" id="tjBtn" style="font-size: large; margin-bottom:10px">Pagar con Tarjeta <i class="fa fa-credit-card fa-x2"></i></button>
            </form>
          
          <div class="mtop16">
              <a href="{{ route('cart-show') }}" class="btn btn-primary" style="font-size: large;  margin-bottom:10px">
                    <i class="fa fa-chevron-circle-left fa-x2"></i> Volver al carrito</a>    
          </div>
    </div>
</div>
@endsection