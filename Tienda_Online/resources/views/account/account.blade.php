@extends('account.master')

@section('title', 'Cuenta')

@section('content')


    <!-- Content -->
    <div class="container">
        <h1>Tu cuenta</h1>
        <p>En el apartado "Perfil" puedes ver tus últimas actividades, revisar tus pedidos y cerrar sesión si no eres tú.</p>
        <a href="{{ url('/')}}">
        <button type="button">Volver a la tienda</button>
        </a>
 
      
      </div>






@endsection
