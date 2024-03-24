@extends('admin.master')

@section('title', 'Categorías')
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
                    {!! Form::open(['url' => '/admin/categories/'.$cat->id.'/edit']) !!}
                    <label for="name"> Nombre: </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            
                          </div>
                    </div>
                    {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                </div>

                <label for="name"> Tipos: </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        
                      </div>
                      {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'custom-select']) !!}

                </div>
         

                    {!! Form::submit('Guardar', ['class '=> 'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
    
                
            </div>
        </div>


    </div>
</div>

@endsection

