@extends('master')

@section('title', 'Inicio')
@section('content')

<div class="col-md-4 white-panel Mjgb">
  <div class="panel-body center">
    <a class="view-all-link" style="font-size:15px!important;font-weight:400!important">
      <img src="/static/images/ppimage/{{$product->image}}" alt="{{$product->name}}" style="height: 300px">
    </a>
  </div>
  <div class="product-container">

    <div class="panel-heading">
      <h4>{{ $product->name }}</h4>
    </div>
    <div class="panel-body" style="font-weight:bold; text-align: right">
      <p>{{$product->price}}€</p>
      <div class="panel-body" style="font-weight:bold; text-align: right">
        <p>{{ $product->content }}</p>
      <hr>
      <a href="{{ route('cart-add', $product->slug) }}" class="btn btn-add-to-cart btn-success"><i class="fa fa-cart-plus"></i> Añadir al carrito</a>
    </div>

  </div>
</div>


          
@endsection