@extends('account.master')

@section('title', 'Cuenta')

@section('content')


    <!-- Content -->
    <div class="container">
        <h1>Tu cuenta</h1>
        <p>En el apartado "Perfil" puedes ver tus últimas actividades, editar la información de tu cuenta de usuario.</p>
        <a href="{{ url('/')}}">
        <button type="button">Volver a la tienda</button>
        </a>
 
      <div class="row">
          <div class="col-md-4">
              <div class="panel shadow">
                  <div class="header">
                      <h2 class="title"><i class="fa-solid fa-plus"></i> Editar Usuario </h2>
                  </div>
                  <div class="inside">
                      {!! Form::open(['url'  => '/account']) !!}
                      <label for="name"> Nombre: </label>
                      {!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
                      
                      <label for="name"> Apellidos: </label>
                      {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
                      
                      <label for="name"> Correo electrónico: </label>
                      {!! Form::text('email', Auth::user()->email, ['class' => 'form-control']) !!}
                      
                      {!! Form::submit('Guardar', ['class '=> 'btn btn-success mtop16']) !!}
                      {!! Form::close() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>





@endsection
