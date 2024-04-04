@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products')}}" class="a">
        <i class="fa-solid fa-boxes-stacked"></i> Listado de productos
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-boxes-stacked"></i>Listado de Productos</h2>
        </div>
        <div class="inside">
            <div class="btns">
                <a href="{{ url('/admin/products/add')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Añadir producto</a>
            </div>
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td></td>
                        <td>Nombre</td>
                        <td>Categoría</td>
                        <td>Precio</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td></td>
                        <td>{{ $p->name }}</td>
                        <td>
                            {{ $p->categories->name }}
                        </td>
                        <td>{{ $p->price }}</td>
                        <td>
                            <div class="opts">
                                <a href="{{ url('/admin/products/' .$p->id. '/edit')}}" class="a" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ url('/admin/products/' .$p->id. '/delete')}}" class="a" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
