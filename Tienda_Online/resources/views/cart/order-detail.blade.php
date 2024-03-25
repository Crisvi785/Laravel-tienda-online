@extends('master')
@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-shopping-cart"></i> Detalle Del Pedido</h1>
        </div>

        <div class="col-md-6">
            <h3>Datos del usuario</h3>
            <table class="table table-striped table-hover table-bordered">
                <tr><td>Nombre:</td><td>{{Auth::user()->name . " " . Auth::user()->lastname}}</td></tr>
                <tr><td>Usuario:</td><td>{{Auth::user()->user}}</td></tr>
                <tr><td>Correo:</td><td>{{Auth::user()->email}}</td></tr>
                <tr><td>Dirección:</td><td>{{Auth::user()->direccion }}</td></tr>
                <tr><td>Código Postal:</td><td>{{Auth::user()->codigo_postal }}</td></tr>
                <tr><td>Localidad:</td><td>{{Auth::user()->localidad }}</td></tr>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Datos del Envío</h3>
            <form action="{{ route('guardar_datos_envio') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                </div>
                <div class="form-group">
                    <label for="localidad">Localidad:</label>
                    <input type="text" class="form-control" id="localidad" name="localidad" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
        
        <div class="col-md-10 col-md-offset-1" style="text-align: center">
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
                    <td>{{$ship}} €</td>
                </tr>
                <tr style="font-weight: bold;border-top: black 5px solid ">
                    <td>
                        <h3 style="font-weight: bold">Total</h3>
                    </td>
                    <td></td><td></td>
                    <td>
                        <h3>{{ number_format($ship+$total,2) }} €</h3>

                    </td>
                </tr>
            </table>
        </div>
    <hr>
    <div class="col-md-10 col-md-offset-1" style="text-align: center; margin-bottom: 50px">
   
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
        <a href="{{ route('cart-show') }}" class="btn btn-primary" style="font-size: large;  margin-bottom:10px">
            <i class="fa fa-chevron-circle-left fa-x2"></i> Volver al carrito</a>
            
            <form name="form" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST">
                <input type="hidden" name="Ds_SignatureVersion" value="HMAC_SHA256_V1"/>
                <input type="hidden" name="Ds_MerchantParameters" value="eyJEU19NRVJDSEFOVF9BTU9VTlQiOiAiMTQ1IiwiRFNfTUVSQ0hBTlRfQ1VSUkVOQ1kiOiAiOTc4IiwiRFNfTUVSQ0hBTlRfTUVSQ0hBTlRDT0RFIjogIjk5OTAwODg4MSIsIkRTX01FUkNIQU5UX01FUkNIQU5UVVJMIjogImh0dHA6Ly93d3cucHJ1ZWJhLmNvbS91cmxOb3RpZmljYWNpb24ucGhwIiwiRFNfTUVSQ0hBTlRfT1JERVIiOiAiMTQ0NjA2ODU4MSIsIkRTX01FUkNIQU5UX1RFUk1JTkFMIjogIjEiLCJEU19NRVJDSEFOVF9UUkFOU0FDVElPTlRZUEUiOiAiMCIsIkRTX01FUkNIQU5UX1VSTEtPIjogImh0dHA6Ly93d3cucHJ1ZWJhLmNvbS91cmxLTy5waHAiLCJEU19NRVJDSEFOVF9VUkxPSyI6ICJodHRwOi8vd3d3LnBydWViYS5jb20vdXJsT0sucGhwIn0="/>
                <input type="hidden" name="Ds_Signature" value="PqV2+SF6asdasMjXasKJRTh3UIYya1hmU/igHkzhC+R="/>
                <button class="btn btn-primary" id="tjBtn" style="font-size: large; margin-bottom:10px">Pagar con Tarjeta <i class="fa fa-credit-card fa-x2"></i></button>
            </form>
            
          
            
        <a href="{{ URL('/pdf') }}" class="btn btn-primary" style="font-size: larger; margin-bottom:10px">
            Descargar comprobante <i class="fa fa-download fa-x2"></i></a>
    </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content col-xs-10 col-xs-offset-1 col-md-12">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cambiar datos de envío</h4>
                    </div>
                    <div class="row">
                    <div class="modal-body col-md-6 col-md-offset-3">
                        <form action="{{ route('updateShipping') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group {{ $errors->has('name2') ? 'has-error' : '' }}">
                                <label for="name2">Nombre</label>
                                <input type="text" name="name2" class="form-control" value="{{ $user->name2 }}" id="name">
                            </div>
                            <div class="form-group {{ $errors->has('last_name2') ? 'has-error' : '' }}">
                                <label for="last_name2">Apellidos</label>
                                <input type="text" name="last_name2" class="form-control" value="{{ $user->last_name2 }}" id="last_name">
                            </div>

                            <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
                                <label for="address2">Dirección de envío</label>
                                <input type="text" name="address2" class="form-control" value="{{ $user->address2 }}" id="address">
                            </div>
                            <div class="form-group {{ $errors->has('postal2') ? 'has-error' : '' }}">
                                <label for="postal2">Código Postal</label>
                                <input type="text" pattern="[0-9]{5}" name="postal2" class="form-control" value="{{ $user->postal2 }}" id="address">
                            </div>
                            <div class="form-group {{ $errors->has('locality2') ? 'has-error' : '' }}">
                                <label for="locality2">Localidad</label>
                                <input type="text" name="locality2" class="form-control" value="{{ $user->locality2 }}" id="address">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <input type="hidden" value="{{ Session::token() }}" name="_token">
                            <br>
                        </form>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="tjModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pago con tarjeta</h4>
                    </div>
                    <div id="card-form" />
                    <form name="datos">
                        <input type="hidden" id="token"></input>
                        <input type="hidden" id="errorCode"></input>
                        <a href="javascript:alert(document.datos.token.value + '--' + document.datos.errorCode.value)"> ver</a>
                    </form>
                
                    <script>
                        function merchantValidationEjemplo() {
                            //Insertar validaciones…
                            alert("Esto son validaciones propias");
                            return true;
                        }
                 
                
                    < !--Listener de recepción de ID de operación-- >
                            window.addEventListener("message", function receiveMessage(event) {
                                storeIdOper(event, "token", "errorCode", merchantValidationEjemplo);
                            });
                
                
                
                        function pedido() {
                            return "pedido" + Math.floor((Math.random() * 1000) + 1);
                        }
                        
                        var insiteJSON = {
                            "id" : "card-form",
                            "fuc" : "999008881",
                            "terminal" : "1",
                            "order" : pedido(),
                            "estiloInsite" : "twoRows"
                        }
                        
                        getInSiteFormJSON(insiteJSON);
                
                    </script>
                
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>


    </div>




@endsection