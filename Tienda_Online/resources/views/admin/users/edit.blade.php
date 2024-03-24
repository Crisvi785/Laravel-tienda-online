@extends('admin.master')

@section('title', 'Categorías')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/users')}}" class="a"><i class="fa-solid fa-list"></i> Usuarios </a>
</li>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-plus"></i> Editar Ususario </h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/users/'.$users->id.'/edit']) !!}
                    <label for="name"> Nombre: </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            
                          </div>
                    </div>
                    {!! Form::text('name', $users->name, ['class' => 'form-control']) !!}
                </div>

                <label for="name"> Apellidos: </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        
                      </div>
                </div>
                {!! Form::text('lastname', $users->lastname, ['class' => 'form-control']) !!}
                
                
                <label for="name"> Correo electónico: </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        
                    </div>
                </div>
                {!! Form::text('email', $users->email, ['class' => 'form-control']) !!}
                
                
                
                
                
                {!! Form::submit('Guardar', ['class '=> 'btn btn-success mtop16']) !!}
                {!! Form::close() !!}
                
            </div>
                
            </div>
        </div>


    </div>
</div>

@endsection
