<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
          Online_Shop - @yield('title')
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/static/css/connect.css?v='.time())}}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- CSS de Bootstrap -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- JS de Bootstrap (requiere jQuery) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
        <script src="{{ url('/static/js/site.js?v='.time() )}}"></script>
        <script src="{{ url('/static/js/slider.js?v='.time() )}}"></script>
    </head>
    <body>
     
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">SHOP</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    COLLECTIONS
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">ABOUT US</a>
                </li>
              </ul>
              <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url("/static/images/logo.png")}}"></a>
        
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="" placeholder="" aria-label=""><i class="fa-solid fa-magnifying-glass"></i>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
        
            
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a href="{{ url('/login')}} " class="nav-link btn"><i class="fas fa-user"></i>  </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cart')}} " class="nav-link btn"><i class="fa-solid fa-cart-shopping"></i><span class="carnumber">0 </span>  </a>
                    </li>
                    
                </ul>
            </div>
          </nav> 
        


        @section('content')
        @show

    </body>
</html>
