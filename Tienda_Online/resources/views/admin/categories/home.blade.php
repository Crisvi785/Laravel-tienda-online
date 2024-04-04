@extends('admin.master')

@section('title', 'Categorías')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories')}}" class="a"><i class="fa-solid fa-list"></i> Categorías </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-plus"></i> Añadir Categoría </h2>
                </div>
                <div class="inside">
                    {{-- Formulario para agregar una nueva categoría --}}
                    {!! Form::open(['url' => '/admin/categories/add']) !!}
                    <label for="name"> Nombre: </label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {{-- Campo para seleccionar el tipo de categoría --}}
                    <label for="module"> Tipos: </label>
                    {!! Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
                    {{-- Botón para guardar la nueva categoría --}}
                    {!! Form::submit('Guardar', ['class '=> 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-plus"></i> Categorías </h2>
                </div>
                <div class="inside">
                    {{-- Lista de categorías existentes --}}
                    <nav class="nav">
                        @foreach (getModulesArray() as $m => $k)
                        <a class="nav-link" href="{{ url('/admin/categories/' .$m)}}">{{ $k }}</a>
                        @endforeach
                    </nav>
                    {{-- Tabla para mostrar las categorías --}}
                    <table class="table ">
                        <thead>
                             <tr>
                                <td>Nombre</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cats as $cat)
                             <tr>
                                 <td>{{ $cat->name }}</td>
                                 <td>
                                     <div class="opts">
                                         {{-- Enlaces para editar y eliminar categorías --}}
                                         <a href="{{ url('/admin/categories/' .$cat->id. '/edit')}}" class="a" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                         <a href="{{ url('/admin/categories/' .$cat->id. '/delete')}}" class="a" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                                     </div>
                                 </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
