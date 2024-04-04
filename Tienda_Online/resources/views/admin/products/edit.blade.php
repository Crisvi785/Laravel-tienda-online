@extends('admin.master')

@section('title', 'Editar Productos')

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
                <h2 class="title">
                    <i class="fa-solid fa-plus"></i> Editar Producto
                </h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/products/add', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-8">
                        <label for="name">Nombre del Producto:</label>
                        {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3">
                        <label for="category">Categoría:</label>
                        {!! Form::select('category', $cats, $p->category_id, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="col-md-3">
                        <label for="name">Imagen destacada:</label>
                        <div class="custom-file">
                            {!! Form::file('img', ['class' => 'custom-file-input', 'id' =>'customFile', 'accept' => 'image/*']) !!}
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="price">Precio:</label>
                        {!! Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                    </div>
                    <div class="col-md-3">
                        <label for="indiscount">¿En descuento?</label>
                        {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="col-md-3">
                        <label for="discount">Descuento:</label>
                        <div class="input-group">
                            {!! Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step'=>'any']) !!}
                        </div>
                    </div>
                </div>
                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="content">Descripción</label>
                        {!! Form::textarea('content', $p->content, ['class' => 'form-control']) !!}
                    </div>
                </div>
                {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
