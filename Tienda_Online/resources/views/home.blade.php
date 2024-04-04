@extends('master')

@section('title', 'Inicio')
@section('content')

 
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="/static/images/front/slider1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/static/images/front/slider2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/static/images/front/slider3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

<div class="panel-body">
  <div class="product-list CustomProductList cf product-list--rows mob-two-col grid--uniform" data-result-count="545" data-infinite-scroll-results="">
    @foreach ($products as $product)
    <div class="col-md-4 white-panel Mjgb">
      <div class="panel-body center">
          <img src="/static/images/ppimage/{{$product->image}}" style="height: 300px">
        </a>
      </div>
      <div class="product-container">

        <div class="panel-heading">
          <h4>{{ $product->name }}</h4>
        </div>
        <div class="panel-body" style="font-weight:bold; text-align: right">
          <p>{{$product->price}}€</p>
          
          <hr>
          <a href="{{ route('cart-add', $product->slug) }}" class="btn btn-add-to-cart btn-success"><i class="fa fa-cart-plus"></i> Añadir al carrito</a>
        </div>

      </div>
    </div>
    @endforeach
  </div>
</div>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="/static/images/front/BEST_SELLERS_ALARGADO.png" class="d-block w-100" alt="...">
    </div>
  </div>
</div>
 
  <div class="panel shadow">
    <div class="NewFooter">
        <ul class="section-footer">
          <li>
            <a data-cc-animate-click="" href="/faqs" class="MenuFooter__FontSize no-wrap">FAQS</a>
          </li>
        
          <li>
            <a data-cc-animate-click="" href="/privacy" class="MenuFooter__FontSize no-wrap">PRIVACY POLICY</a>
          </li>
            
          <li>
            <a data-cc-animate-click="" href="/shippingPrv" class="MenuFooter__FontSize no-wrap">SHIPPING POLICY</a>
          </li>
            
          <li>
            <a data-cc-animate-click="" href="/terms" class="MenuFooter__FontSize no-wrap">TERMS &amp; CONDITIONS</a>
          </li>
            
          </ul>
    </div>
    
          <div class="NewFooter__Brand-Wrapper">
            <div>
              <p class="NewFooter__Brand-Heading">EVERYDAY URBAN<br>AESTHETICS</p>
            </div>
            <div>
              <img src="/static/images/with-love-logo.jpg" alt="" style="width: 45px; height:auto;">
            </div>
          </div>
        </div>
    
      </div>
    
    
  </div>
 


  
  @endsection

