@extends('admin.master')

@section('title', 'Editar Categoría')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories/0')}}" class="a"><i class="fa-solid fa-list"></i> Categorías </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-plus"></i> Editar Categoría </h2>
                </div>
                <div class="inside">
                    {{-- Formulario para editar una categoría --}}
                    {!! Form::open(['url' => '/admin/categories/'.$cat->id.'/edit']) !!}
                    
                    {{-- Campo para el nombre de la categoría --}}
                    <label for="name"> Nombre: </label>
                    {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                    
                    {{-- Campo para seleccionar el tipo de categoría --}}
                    <label for="module"> Tipos: </label>
                    {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'custom-select']) !!}
                    
                    {{-- Botón para guardar los cambios --}}
                    {!! Form::submit('Guardar', ['class '=> 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
