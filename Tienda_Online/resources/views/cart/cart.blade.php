@extends('master')
@section('title', 'Carrito')

@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-shopping-cart"></i> Carrito de la Compra</h1>
        </div>

        @if(count($cart))
          
        <div class="table-responsive" style="margin-bottom: 50px">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Quitar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td><img src="/static/images/ppimage/{{$item->image}}" style="width: 10em"> </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price,2) }}</td>
                        <td><form class="form-horizontal" role="form" method="post" action="{{ route('cart-update', $item->slug)}}"> 
                                {{ csrf_field() }}
                            <input type="number" min="1" max="100"
                                   value="{{ $item->quantity }}" name="num">
                                 <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-refresh"></i> Actualiza
                                </button>
                            </form>
                        </td>
                        {{--Falta implementar el numero de elementos--}}
                        <td>{{ number_format($item->price * $item->quantity,2) }}</td>
                        <td>
                            <form action="{{ route('cart-delete', $item->slug) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr style="font-weight: bold;border-top: black 5px solid ">
                        <td>
                            <h3 style="font-weight: bold">Total</h3>
                        </td>
                        <td></td><td></td><td></td><td></td>
                        <td>
                            <h3>{{ number_format($total,2) }} €</h3>
                        </td>

                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
            <a href="{{ url('/') }}" class="btn btn-primary" style="font-size: larger; margin:2%">
                <i class="fa fa-chevron-circle-left"></i> Seguir comprando</a>
            <a href="{{ route('order-detail') }}" class="btn btn-primary marginBottom" style="font-size: larger">
                Procesar pedido <i class="fa fa-chevron-circle-right"></i></a>
            {{-- <a href="{{ route('saveCart') }}" class="btn btn-primary marginBottom" style="font-size: larger">
                Guardar Carrito para después <i class="fa fa-chevron-circle-down"></i></a>    --}}

              
                
                @else
                <div style="margin-bottom: 200px">
                    <h3 class="mensaje-alerta span label label-warning">Tu carrito está vacío.</h3>
                </div>
                @endif
            </div>
          

        
            
            
      
            
       
@endsection