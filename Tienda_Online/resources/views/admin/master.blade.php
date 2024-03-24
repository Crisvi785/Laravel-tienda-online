<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
        <title>
        @yield('title') - Online_Shop
        </title>
        <meta name="csrf-token" content=" {{ csrf_token() }}">        
        <meta name="routeName" content="{{ Route::currentRouteName() }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/static/css/admin.css?v=' .time())}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();

            });
        </script>
    </head>
    
    <body>

        <div class="wrapper">
            <div class="col1">@include('admin.sidebar')</div>
            <div class="col2"> 
                <nav class="navbar navbar-expand-lg shadow">
                    <div class="collapse navbar-collapse">
                        <ul class="nav-item">
                            <li class="nav-item">
                                <a href="{{ url('/admin')}}" class="a nav-link"><i class="fa-solid fa-house"></i> Dashboard 
                                </a>
                            </li>

                        </ul>

                    </div>

                </nav>

                <div class="page">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb shadow">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/admin')}}" class="a"><i class="fa-solid fa-house"></i> Dashboard
                                    </a> 
                                </li>
                                @section('breadcrumb')
                                @show
                            </ol>
                        </nav>
                    </div>
                    @if (Session::has('message'))
                     <div class="container-fluid">
                        <div class="alert alert-{{ Session::get('typealert') }}" style="display: :none;">
                          {{ Session::get('message')}}
                           @if ($errors -> any())
                             <ul>
                           @foreach ($errors->all() as $error )
                          <li>{{ $error }}</li>    
                               @endforeach
                             </ul>  
                        @endif
                             
                <script>
                    $('.alert').slideDown();
                    setTimeout(function(){ $ .('.alert').slideUp(); }, 10000);
                </script>
            </div>
            </div>

        @endif

        @section('content')
        @show



                </div>


            </div>
        </div>

    </body>
</html>
