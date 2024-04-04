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
        <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous">
        </script> 
    </head>
    <body>
        @section('content')
        @show

    </body>
</html>
